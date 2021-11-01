@extends('layouts.adminLayout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Brand</h1>
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
                                <h3 class="card-title">Create a new Brand</h3>
                            </div>
                            <form id="brand-form" action="{{route('brands.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Enter Brand Name</label>
                                        <input type="text" name="brand_name" placeholder="Enter the name for a new category" id="brand_name" class="form-control" >
                                        @if($errors->has('brand_name'))
                                            <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_logo">Choose a logo for your brand</label>
                                        <input type="file" name="brand_logo" class="form-control">
                                        @if($errors->has('brand_logo'))
                                            <span class="text-danger">{{ $errors->first('brand_logo') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category_select">Select a category for the brand</label><br>
                                        <select  class="form-floating form-select mb-4 w-50 p-2" name="categoryID" id="">
                                            <option selected>Select a category</option>
                                            @foreach($category as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('categoryID'))
                                            <span class="text-danger">{{ $errors->first('categoryID') }}</span>
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

@section('javascripts')
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $.validator.setDefaults({--}}
{{--                submitHandler: function () {--}}
{{--                    alert("Form submitted successfully!");--}}
{{--                }--}}
{{--            });--}}
{{--            $('#category-form').validate({--}}
{{--                rules: {--}}
{{--                    category_name: {--}}
{{--                        required: true,--}}
{{--                    },--}}
{{--                    category_image: {--}}
{{--                        required: true,--}}
{{--                        extension: "jpg,png,jpeg",--}}
{{--                        filesize : 6,--}}
{{--                    }--}}
{{--                },--}}
{{--                messages: {--}}
{{--                    category_name : {--}}
{{--                        required: "Category name is required"--}}
{{--                    },--}}
{{--                    category_image : {--}}
{{--                        required: "Category image is mandatory",--}}
{{--                        extension : "The file extension besides .jpg, .png, or .jpeg is not allowed",--}}
{{--                        filesize : "Files must not exceed more than 6 MB."--}}
{{--                    }--}}
{{--                },--}}
{{--                errorElement : 'span',--}}
{{--                errorPlacement: function (error, element) {--}}
{{--                    error.addClass('invalid-feedback');--}}
{{--                    element.closest('.form-group').append(error);--}}
{{--                },--}}
{{--                highlight: function (element, errorClass, validClass) {--}}
{{--                    $(element).addClass('is-invalid');--}}
{{--                },--}}
{{--                unhighlight: function (element, errorClass, validClass) {--}}
{{--                    $(element).removeClass('is-invalid');--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}

@endsection
