@extends('layouts.adminLayout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Brand</h1>
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
                                <h3 class="card-title">Edit a Brand</h3>
                            </div>
                            <form id="brand-form" action="{{route('brands.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Edit Brand Name</label>
                                        <input type="text" name="brand_name" placeholder="Edit the name for a new category" id="brand_name" class="form-control" value="{{$brand->name}}" >
                                        @if($errors->has('brand_name'))
                                            <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category_image">Choose a logo for your brand</label>
                                        <input type="file" name="brand_logo" class="form-control">
                                        @if($errors->has('brand_logo'))
                                            <span class="text-danger">{{ $errors->first('category_image') }}</span>
                                        @endif
                                        <img src="{{asset('images/brand_images/'.$brand->logo)}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_select">Select a category for the brand</label><br>
                                        <select  class="form-floating form-select mb-4 w-50 p-2" name="categoryID" id="">
                                            @foreach($category as $item)
                                                @if($item->id == $brand->category->id)
                                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                    @continue
                                                @endif
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('categoryID'))
                                            <span class="text-danger">{{ $errors->first('categoryID') }}</span>
                                        @endif
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


