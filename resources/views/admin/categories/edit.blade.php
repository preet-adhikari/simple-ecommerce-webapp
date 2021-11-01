@extends('layouts.adminLayout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
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
                                <h3 class="card-title">Create a new Category</h3>
                            </div>
                            <form id="category-form" action="{{route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Edit Category Name</label>
                                        <input type="text" name="category_name" placeholder="Edit the name for a new category" id="category_name" class="form-control" value="{{$category->name}}" >
                                        @if($errors->has('category_name'))
                                            <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category_image">Choose an image for your category</label>
                                        <input type="file" name="category_image" class="form-control">
                                        @if($errors->has('category_image'))
                                            <span class="text-danger">{{ $errors->first('category_image') }}</span>
                                        @endif
                                        <img src="{{asset('images/category_images/'.$category->image)}}" alt="" class="img-fluid">
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


