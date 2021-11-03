@extends('layouts.adminLayout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Edit a Product</h3>
                            </div>
                            <form id="brand-form" action="{{route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Edit Product Name</label>
                                        <input type="text" name="product_name" placeholder="Edit the name for a product" id="product_name" class="form-control" value="{{$product->name}}" >
                                        @if($errors->has('product_name'))
                                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Edit Product Stock</label>
                                        <input type="text" name="product_stock" placeholder="Edit the number of product stock" id="product_name" class="form-control" value="{{$product->stock}}" >
                                        @if($errors->has('product_stock'))
                                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Edit Product Price</label>
                                        <input type="text" name="product_price" placeholder="Edit the price for a product" id="product_price" class="form-control" value="{{$product->price}}" >
                                        @if($errors->has('product_name'))
                                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="brandID">Edit Product Brand</label>
                                        <select name="brandID" id="" class="form-control">
                                            @foreach($brands as $item)
                                                @if($item->id == $product->brand->id)
                                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @continue
                                                @endif
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_image">Choose an image for your product</label>
                                        <input type="file" name="product_image" class="form-control">
                                        @if($errors->has('product_image'))
                                            <span class="text-danger">{{ $errors->first('product_image') }}</span>
                                        @endif
                                        <img src="{{asset('images/product_images/'.$product->image)}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-info">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


