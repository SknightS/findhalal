@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Edit OrderItem
                    </div>

                    <div class="panel-options">
                        {{--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>--}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        {{--<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>--}}
                    </div>
                </div>

                <div class="panel-body">

                    @foreach($orderItem as $orderItem)

                    <form role="form" class="form-horizontal form-groups-bordered" method="post" action="{{route('orderItem.update',$orderItem->orderItemId)}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Resturant Name</label>
                            <div style="margin-top: 8px" class="col-sm-5">
                                @foreach($resName as $ResName)
                                    <b>{{$ResName->resName}}</b>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Item Category<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemCategory" id="itemCategory" required>

                                    <option selected value="">Select Item Type</option>
                                    @foreach($categories as $category)
                                        <option @if($category->categoryId == $orderItem->categoryId) selected @endif value="{{$category->categoryId}}">{{$category->CategoryName}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemName" id="itemName" required>

                                    <option selected value="{{$orderItem->itemId}}">{{$orderItem->itemName}}</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Size<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemSize" id="itemSize" required>
                                    <option selected value="">Select Item Size</option>
                                    <option selected value="{{$orderItem->itemsizeId}}">{{$orderItem->itemsizeName}}</option>
                                </select>
                            </div>
                        </div>


                        <div id = "Item_price" class="form-group">
                            <label class="control-label col-sm-3"> Item Quantity<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="itemQuantity" min="1" onkeypress="return isNumberKey(event)" placeholder="Item Quantity" id="itemQuantity" value="{{$orderItem->quantity}}" class="form-control input-height" required >
                                @if ($errors->has('itemQuantity'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('itemQuantity')}}</strong>

                                    </span>
                                @endif
                            </div>

                        </div>



                        <div id = "Item_price" class="form-group">
                            <label class="control-label col-sm-3"> Item Price</label>
                            <div style="margin-top: 8px" class="col-sm-5">
                                <input type="hidden" readonly name="itemPrice" placeholder="Item Price" id="itemPrice" value="{{$orderItem->price}}" class="form-control input-height">
                                <span id="itemTotalPrice">{{$orderItem->price}}</span>

                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <a class="btn btn-info" href="{{route('order.show')}}">Back</a>
                                <button  type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </form>
                @endforeach

                </div>

            </div>

        </div>
    </div>

@endsection

@section('foot-js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        var quantity=$("#itemQuantity").val();
        var TotalPrice=(quantity*$("#itemPrice").val());
        $("#itemTotalPrice").html(TotalPrice);

        $("#itemQuantity").bind('input',function(){
            quantity=$(this).val();
            TotalPrice = ( quantity * $("#itemPrice").val());
            $("#itemTotalPrice").html(TotalPrice);
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
                $("#itemSize").html(
                    "<option selected value=\"\">Select Item Size</option>"
                );

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
                $("#itemTotalPrice").html(data);

            }
        });
    });

</script>

@endsection
