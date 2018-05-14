@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Edit ItemSize
                    </div>

                    <div class="panel-options">
                        {{--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>--}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        {{--<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>--}}
                    </div>
                </div>

                <div class="panel-body">



                        <form role="form" class="form-horizontal form-groups-bordered" method="post" action="{{route('itemSize.update',$itemSize->itemsizeId)}}}">
                            {{csrf_field()}}


                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Size Name<span style="color: red" class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="field-1" name="itemSizeName" placeholder="EnterItem Size Name" value="{{$itemSize->itemsizeName}}" required>
                                    @if ($errors->has('itemSizeName'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('itemSizeName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div id = "Item_price" class="form-group">
                                <label class="control-label col-sm-3"> Item Price(€)<span style="color: red" class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" name="itemPrice" placeholder="Item Price" id="itemPrice" value="{{$itemSize->price}}" class="form-control input-height" required >
                                    @if ($errors->has('itemPrice'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('itemPrice') }}</strong>

                                    </span>
                                    @endif
                                </div>

                            </div>



                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status <span style="color: red" class="required">*</span> </label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="itemSizeStatus" required>
                                        <option  value="">Select Status</option>
                                        @for($i=0;$i<count(Status);$i++)
                                            <option @if ($itemSize->status == Status[$i]) selected @endif value="{{Status[$i]}}">{{Status[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <a class="btn btn-info" onclick="itemShowBack()">Back</a>
                                    <button  type="submit" class="btn btn-info">Update</button>
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

        function itemShowBack() {

            var itemSizeId= '{{$itemSize->itemsizeId}}'

            $.ajax({
                type : 'post' ,
                url : '{{route('item.showBack')}}',
                data : {'itemSizeId':itemSizeId,} ,
                success : function(data){
                    window.location.href = '{{route('item.show')}}';

                }
            });



        }
    </script>


@endsection

