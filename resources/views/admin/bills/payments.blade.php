@extends('layouts.app')

@section('content')
{{--Bill form--}}
<section class="p-5">
    <div class="container">
{{--        form--}}

        <div class="row text-white">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Enter bill name</label>
                    <input type="text" placeholder="Bill's name" class="form-control form-control-sm" name="bill_name[]" id="bill_name" value="">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p>{{$errors->first('bill_name')}}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="billCategory">Select a bill category</label>
                    <select  id="billCategorySelect" name="billCategorySelect" class="form-control form-control-sm">
                            <option value="">Select bill type</option>
                        @foreach($billCategory as $item)
                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Enter Price</label>
                    <input type="number" placeholder="Enter the price" class="form-control form-control-sm" name="price[]" id="price" value="">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p>{{$errors->first('price')}}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <button id="addMore" class="btn btn-outline-success">Add More</button>
                </div>
            </div>
            <form action="{{ route('billAdd') }}" method="POST">
                @csrf

                <table class="table table-sm table-bordered " id="addRemove" style="display: none;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Bill Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody id="addRow" class="addRow">
                    </tbody>
                    <tbody>
                    <tr>
                        <td colspan="1" class="text-right">
                            <strong>Total:</strong>
                        </td>
                        <td>
                            <input type="number" id="estimated_amount" class="estimated_amount" value="0" readonly>
                        </td>
                    </tr>
                    </tbody>

                </table>
                <input type="submit" value="Submit" class="btn btn-success">
            </form>
        </div>

    </div>
</section>


@endsection

@section('javascripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
{{--    Handlebars js--}}
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">

            <td>
                <input type="text" name="bill_name[]" value="@{{ bill_name }}">
            </td>
            <td>
                <select name="billCategorySelect[]" id="billCategorySelect">
                    <option selected>@{{ billCategorySelect }}</option>
                    @foreach($billCategory as $item)
                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" class="price" name="price[]" value="@{{ price }}">
            </td>
            <td>
                <i class="removeaddmore" style="cursor:pointer;color:red;">Remove</i>
            </td>

        </tr>
    </script>
    <script>
        function total_amount_price() {
            var sum = 0;
            $('.price').each(function(){
                var value = $(this).val();
                if(value.length !== 0){
                    sum += parseFloat(value);
                }
            });
            $('#estimated_amount').val(sum);
        }

        $(document).on('click','#addMore',function(){
            $('.table').show();
            var bill_name = $('#bill_name').val();
            var bill_category_id = $('#billCategorySelect').val();
            var price = $('#price').val();
            var source = $("#document-template").html();
            var template = Handlebars.compile(source);

            var data = {
                bill_name : bill_name,
                bill_category_id : bill_category_id,
                price : price
            }
            var html = template(data);
            $("#addRow").append(html)

            total_amount_price();
        });

        $(document).on('click','.removeaddmore',function(event){
            $(this).closest('.delete_add_more_item').remove();
            total_ammount_price();
        });


    </script>

@endsection
