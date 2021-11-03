@extends('layouts.adminLayout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Product</h1>
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
                                <h3 class="card-title">Create a new Product</h3>
                            </div>
                            <form id="category-form" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Enter Product Name</label>
                                        <input type="text" name="product_name" placeholder="Enter the name for a new product" id="product_name" class="form-control" >
                                        @if($errors->has('product_name'))
                                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Enter Product Stock</label>
                                        <input type="number" name="product_stock" placeholder="Enter the amount of product in the inventory" id="product_stock" class="form-control" >
                                        @if($errors->has('product_stock'))
                                            <span class="text-danger">{{ $errors->first('product_stock') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Enter Product Price</label>
                                        <input type="number" name="product_price" placeholder="Enter the price of the product" id="product_price" class="form-control" >
                                        @if($errors->has('product_price'))
                                            <span class="text-danger">{{ $errors->first('product_price') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_select">Select a brand for the product</label><br>
                                        <select  class="form-floating form-select mb-4 w-50 p-2" name="brandID" id="">
                                            <option selected>Select a brand</option>
                                            @foreach($brands as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('brandID'))
                                            <span class="text-danger">{{ $errors->first('brandID') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category_image">Choose an image for your product</label>
                                        <input type="file" name="product_image" class="form-control">
                                        @if($errors->has('product_image'))
                                            <span class="text-danger">{{ $errors->first('product_image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-outline-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

