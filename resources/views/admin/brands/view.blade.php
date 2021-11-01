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
                        <h1>Brands</h1>
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
                                <h3 class="card-title">View and Edit Brands</h3>
                            </div>
                            <div class="card-body">
                                <table id="brandTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Logo</th>
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

    <!-- small modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('javascripts')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        jQuery(document).ready(function ($){
            let table = $('#brandTable').DataTable({
                "processing":true,
                "serverSide":true,
                "ajax": "{{route('brands.get')}}",
                "columns": [
                    {"data" : "id"},
                    {"data" : "name"},
                    {"data" : "logo"},
                    {"data" : "created_at"},
                    {"data" : "updated_at"},
                    {"data" : "action"}
                ],
                "search" : {
                    "regex": true
                }
            });
            //Edit and Delete
            $('#brandTable').on('click','.edit',function (){
                let id = $(this).attr('data-id');
                location.href = '/admin/brands/'+id+'/edit';
            });
            // $('#brandTable').on('click','.delete',function (){
            //     let id = $(this).attr('data-id');
            //     location.href = '/admin/deleteBrand/'+id;
            // });
            $(document).on('click', '#smallButton', function(event){
                event.preventDefault();
                let href = $(this).attr('data-attr');
                $.ajax({
                    url: href
                    , beforeSend: function() {
                        $('#loader').show();
                    },
                    // return the result
                    success: function(result) {
                        $('#smallModal').modal("show");
                        $('#smallBody').html(result).show();
                    }
                    , complete: function() {
                        $('#loader').hide();
                    }
                    , error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    }
                    , timeout: 8000
                })
            })
        });
    </script>
@endsection
