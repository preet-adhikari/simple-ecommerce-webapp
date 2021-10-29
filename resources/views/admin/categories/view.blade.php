@extends('layouts.adminLayout')

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
{{--    Page content--}}
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
        </section>

{{--        Table--}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">View and Edit Categories</h3>
                            </div>
                            <div class="card-body">
                                <table id="categoryTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection

@section('javascripts')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        jQuery(document).ready(function ($){
            let table = $('#categoryTable').DataTable({
                "processing":true,
                "serverSide":true,
                "ajax": "{{route('categories.get')}}",
                "columns": [
                    {"data" : "id"},
                    {"data" : "name"},
                    {"data" : "image"},
                    {"data" : "created_at"},
                    {"data" : "updated_at"},
                    {"data" : "action"}
                ],
                "search" : {
                    "regex": true
                }
            });
            //Edit and Delete
            $('#categoryTable').on('click','.edit',function (){
                let id = $(this).attr('data-id');
                location.href = '/admin/category/'+id+'/edit';
            });
            $('#categoryTable').on('click','.delete',function (){
                let id = $(this).attr('data-id');
                console.log('value ',id);
                location.href = '/admin/destroyCategory/'+id;
            });
        });
    </script>
@endsection
