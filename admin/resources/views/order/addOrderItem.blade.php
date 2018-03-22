@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Add Items To Order
                    </div>

                    <div class="panel-options">
                        {{--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>--}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        {{--<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>--}}
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data" method="post" action="{{route('orderItem.insert',$orderId)}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Resturant Name</label>
                            <div style="margin-top: 8px" class="col-sm-5">
                                @foreach($orders as $order)
                                <b>{{$order->resName}}</b>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Item Category<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemCategory" id="itemCategory" required>

                                    <option selected value="">Select Item Type</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->categoryId}}">{{$category->CategoryName}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemName" id="itemName" required>

                                    <option selected value="">Select Item</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Size<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemSize" id="itemSize" required>
                                    <option selected value="">Select Item Size</option>
                                </select>
                            </div>
                        </div>

                        <div id = "Item_quantity" class="form-group">
                            <label class="control-label col-md-3"> Item Quantity<span style="color: red" class="required">*</span></label>
                            <div class="col-md-5">
                                <input type="number" min="1" name="itemQuantity"  onkeypress="return isNumberKey(event)" placeholder="Item Quantity" id="itemQuantity"  class="form-control input-height" required >
                            </div>


                        </div>

                        <div id = "Item_price" class="form-group">
                            <label class="control-label col-md-3"> Item Price<span style="color: red" class="required">*</span></label>
                            <div style="margin-top: 8px" class="col-md-5">
                                <input type="hidden" name="itemPrice" placeholder="Item Price" id="itemPrice"  class="form-control input-height" required >
                                <span id="itemPriceTotal"></span>
                            </div>


                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button  type="submit" class="btn btn-info">Create</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>






@endsection
@section('foot-js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{url('assets/js/bootstrap-timepicker.min.js')}}"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            $("#itemQuantity").bind('input',function(){

                if ($("#itemSize").val() !="") {

                    var price = $("#itemPrice").val();
                    var quantity = $(this).val();
                    var TotalPrice = ( quantity * price);
                    $("#itemPriceTotal").html(TotalPrice);
                }else {
                    alert("Please Select a Item Size First");
                }
            });
        });

        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }

            return true;
        }

        $("#itemCategory").change(function() {

            var catId=$(this).val();

            $.ajax({
                type : 'post' ,
                url : '{{route('order.itemByCategory')}}',
                data : {'catId':catId} ,
                success : function(data){
                    document.getElementById("itemName").innerHTML = data;

                }
            });
        });
        $("#itemName").change(function() {

            var itemId=$(this).val();

            $.ajax({
                type : 'post' ,
                url : '{{route('order.itemSizeByCategory')}}',
                data : {'itemId':itemId} ,
                success : function(data){
                    document.getElementById("itemSize").innerHTML = data;


                }
            });
        });
        $("#itemSize").change(function() {

            var sizeId=$(this).val();

            $.ajax({
                type : 'post' ,
                url : '{{route('order.priceByItemSize')}}',
                data : {'sizeId':sizeId} ,
                success : function(data){
                    $("#itemQuantity").val("1");
                    $("#itemPrice").val(data);
                    $("#itemPriceTotal").html(data);

                }
            });
        });

    </script>


@endsection