<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.view');
    }

    public function create()
    {
        $brands = Brands::all();
        return view('admin.products.create',compact('brands'));
    }

    public function store(Request $request){
        $request->validate([
           'product_name' => 'required|max:155|unique:products,name',
           'product_stock' => 'required|numeric|min:0|not_in:0',
            'product_price' => 'required|numeric|min:0|not_in:0',
            'product_image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '-' . $request->product_name . '.' . $request->product_image->extension();

        $request->product_image->move(public_path('images/product_images'),$newImageName);

        $product = new Product();
        $product->name = $request->product_name;
        $product->brand_id = $request->brandID;
        $product->stock = $request->product_stock;
        $product->price = $request->product_price;
        $product->image = $newImageName;
        $product->save();
        return redirect('/admin/product');

    }

    public function edit($id){
        $product = Product::find($id);
        $brands = Brands::all();
        return view('admin.products.edit',compact('product','brands'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'product_name' => 'required|max:155',
            'product_stock' => 'required|numeric|min:0|not_in:0',
            'product_price' => 'required|numeric|min:0|not_in:0',
            'product_image' => 'mimes:jpg,png,jpeg|max:5048'
        ]);

        $product = Product::where('id','=',$id)->first();
        if ($request->hasFile('product_image')){
            $imageName = public_path('images\product_images\\') . $product->image;
            if(File::exists($imageName)){
                File::delete($imageName);
            }
            $file = $request->file('product_image');
            $filename = time() . '-' . $request->product_name . '.' . $request->product_image->extension();
            $file->move(public_path('images\product_images'),$filename);
            $product->image = $filename;
        }
        $product->name = $request->product_name;
        $product->stock = $request->product_stock;
        $product->price = $request->product_price;
        $product->brand_id = $request->brandID;
        $product->save();
        return redirect('/admin/product');
    }

    public function destroy($id){
        $product = Product::where('id','=',$id)->first();
        $product->delete();
        return redirect('/admin/product');
    }

    //View products
    public function viewProduct($name,$id){
        $products = Product::where('brand_id','=',$id)->get();
        $brand_name = $name;
        return view('ecommerce.products',compact('products','brand_name'));

    }

    //Add To cart
    public function getAddToCart(Request $request,$id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);
        Session::put('cart',$cart);
        return back();
    }

    //Reduce from cart
    public function getReduceFromCart(Request $request,$id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduce($product,$product->id);
        Session::put('cart',$cart);
        return back();
    }

    //Remove cart
    public function getRemoveFromCart(Request $request,$id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($product,$product->id);
        Session::put('cart',$cart);
        if (Session::get('cart')->items == null){
            Session::get('cart')->totalPrice = 0;
        }
        return back();
    }

    //View Shopping Cart
    public function shoppingCart(){
        if (!Session::has('cart')){
            return view('ecommerce.shoppingCart');
        }
        $oldCart =  Session::get('cart');
        $cart = new Cart($oldCart);
        return view('ecommerce.shoppingCart',[
           'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
        ]);
    }

    //Get Checkout
    public function getCheckout(){
        if (!Session::has('cart')){
            return view('ecommerce.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('ecommerce.checkout',['total' => ($total * 1.13)]);
    }
    //After Checkout
    public function postCheckout(Request $request){
        if (!Session::has('cart')){
            return redirect()->route('ecommerce.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart =   new Cart($oldCart);

        Stripe::setApiKey('sk_test_51JQUhrJ20uYlh3SGK8zCvucvZI3Ia2ZiPOikbZxU0MOODwvRyAdvaGbSqEmQF6ou5o2DpVyhPGEE9DXOWpNIKhWO007pCPxCHv');
//        dd($request->input('stripeToken'));
        try{
            $charge = Charge::create(array(
                "amount" => ($cart->totalPrice * 100)* 1.13,
                "currency" => "usd",
                "source" => "tok_mastercard",
                "description" => "Test Charge"
            ));
            $payment = new Payment();
            $customer = Customer::where('email','=',Session::get('customer_logged_in'))->first();
            $payment->customer_id = $customer->id;
            $payment->payment_type = 'card';
            $payment->provider = 'Stripe';
            $payment->cart = serialize($cart);
            $payment->address = $request->input('address');
            $payment->name = $request->input('name');
            $payment->payment_id = $charge->id;
            $payment->save();
//            \Stripe\PaymentIntent::create([
//               'amount' => ($cart->totalPrice)*1.13,
//               'currency' => 'usd',
//                'payment_method_types' => [
//                    'card'
//                ]
        }catch(\Exception $e){
            return redirect()->route('checkout')->with('error',$e->getMessage());
        }

//        dd($customer->id);
        Session::forget('cart');
        return redirect('/')->with('success','Payment has been successfully made');
    }
}
