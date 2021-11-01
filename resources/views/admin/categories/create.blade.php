@extends('layouts.adminLayout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Category</h1>
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
                            <form id="category-form" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Enter Category Name</label>
                                        <input type="text" name="category_name" placeholder="Enter the name for a new category" id="category_name" class="form-control" >
                                        @if($errors->has('category_name'))
                                            <span class="text-danger">{{ $errors->first('category_image') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="category_image">Choose an image for your category</label>
                                        <input type="file" name="category_image" class="form-control">
                                        @if($errors->has('category_image'))
                                            <span class="text-danger">{{ $errors->first('category_image') }}</span>
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
    <script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    alert("Form submitted successfully!");
                }
            });
            $('#category-form').validate({
                rules: {
                    category_name: {
                        required: true,
                    },
                    category_image: {
                        required: true,
                        extension: "jpg,png,jpeg",
                        filesize : 6,
                    }
                },
                messages: {
                    category_name : {
                        required: "Category name is required"
                    },
                    category_image : {
                        required: "Category image is mandatory",
                        extension : "The file extension besides .jpg, .png, or .jpeg is not allowed",
                        filesize : "Files must not exceed more than 6 MB."
                    }
                },
                errorElement : 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            })
        })
    </script>

@endsection
