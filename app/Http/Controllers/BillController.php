<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BillController extends Controller
{
    public function show(){
        $billCategory = BillCategory::latest()->get()->toArray();
        return view('admin.bills.payments',[
            'billCategory' => $billCategory
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
           'bill_name' => 'required',
            'price' => 'required'
        ]);
//        dd($request);
        $length = count($request->bill_name);
//        foreach ($request->approver as $approver){
//            $approve = new Approve();
//            $approve->approver_id  = $approver;
//            $approver->save();
//        }

//        foreach($request->bill_name as $billName){;
//            $bill = new Bill();
//            $bill->bill_name = $billName;
//            $bill->bill_category_id = $request->billCategorySelect['$loop->iteration'];
//            $bill->price = $request->price['$loop->iteration'];
//            $bill->save();
//        }

        for ($i = 0; $i < $length; $i++){
            $bill = new Bill();
            $bill->bill_name = $request->bill_name[$i];
            $bill->bill_category_id = $request->billCategorySelect[$i];
            $bill->price = $request->price[$i];
            $bill->save();
        }
        return redirect()->back();
    }
}
