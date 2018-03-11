@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Edit Item
                    </div>

                    <div class="panel-options">
                        {{--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>--}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        {{--<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>--}}
                    </div>
                </div>

                <div class="panel-body">

                    @foreach($items as $itemInfo)

                    <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data" method="post" action="{{route('item.update',$itemInfo->itemId)}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Resturant Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="resturantName" id="resturantName" required>

                                    <option value="">Select Resturant Name</option>
                                    @foreach($resName as $rName)
                                        <option @if($itemInfo->fkresturantId == $rName->resturantId )selected @endif value="{{$rName->resturantId}}">{{$rName->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Item Type<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemCategory" id="itemCategory" required>

                                    <option value="">Select Item Type</option>
                                    <option selected value="{{$itemInfo->fkcategoryId}}">{{$itemInfo->catName}}</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" name="itemName" placeholder="EnterItem Name" value="{{$itemInfo->itemName}}" required>
                                @if ($errors->has('itemName'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('itemName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"> Item Details </label>

                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" name="itemDetails" placeholder="ItemDetails">{{$itemInfo->itemDetails}}</textarea>
                                @if ($errors->has('ItemDetails'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ItemDetails') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Picture </label>
                            <div class="col-sm-5">
                                <input type="file" name="ItemPicture"  value="upload Image" accept=".jpg, .jpeg" id="ItemPicture">
                                @if ($errors->has('ItemPicture'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ItemPicture') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <img height="50px" src="{{url('public/ItemImages')."/".$itemInfo->image}}" width="50px" id="ItemPicture">
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status <span style="color: red" class="required">*</span> </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemStatus" required>
                                    <option  value="">Select Status</option>
                                    @for($i=0;$i<count(Status);$i++)
                                        <option @if ($itemInfo->status == Status[$i]) selected @endif value="{{Status[$i]}}">{{Status[$i]}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
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
    <script src="{{url('assets/js/bootstrap-timepicker.min.js')}}"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("#resturantName").change(function() {

            var resId=$(this).val();

            $.ajax({
                type : 'post' ,
                url : '{{route('item.categoryByRes')}}',
                data : {'resId':resId} ,
                success : function(data){
                    document.getElementById("itemCategory").innerHTML = data;

                }
            });
        });



        function ItemPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#ItemPicture').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }



        $("#ItemPicture").change(function(){
            ItemPicture(this);
        });

    </script>


@endsection