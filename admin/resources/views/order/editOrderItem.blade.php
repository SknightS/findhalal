@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        edit OrderItem
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
                            <label for="field-1" class="col-sm-3 control-label">Item Name</label>
                            <div style="margin-top: 8px" class="col-sm-5">
                                {{$orderItem->itemName}}

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Size</label>
                            <div style="margin-top: 8px"class="col-sm-5">
                               {{$orderItem->itemsizeName}}

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
<script>

    $(document).ready(function(){

        var quantity=$("#itemQuantity").val();
        var TotalPrice=(quantity*'{{$orderItem->price}}');
        $("#itemTotalPrice").html(TotalPrice);

        $("#itemQuantity").bind('input',function(){
            quantity=$(this).val();
            TotalPrice = ( quantity * '{{$orderItem->price}}');
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
</script>

@endsection
