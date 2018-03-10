@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                       Add Items
                    </div>

                    <div class="panel-options">
                        {{--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>--}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        {{--<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>--}}
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data" method="post" action="{{route('item.insert')}}">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Resturant Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="resturantName" id="resturantName" required>

                                    <option value="">Select Resturant Name</option>
                                    @foreach($resName as $rName)
                                        <option @if(old('resturantName')==$rName->resturantId )selected @endif value="{{$rName->resturantId}}">{{$rName->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Item Type<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemCategory" id="itemCategory" required>

                                    <option value="">Select Item Type</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" name="itemName" placeholder="EnterItem Name" required>
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
                                <textarea class="form-control" id="field-ta" name="ItemDetails" placeholder="ItemDetails"></textarea>
                                @if ($errors->has('ItemDetails'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ItemDetails') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-3">If you want to add any Size click </label>
                            <div class="col-md-5">
                                <input class="btn btn-success" type="button" name = 'add' value='Add' onclick="selectid2()">
                            </div>
                        </div>

                        <div id="showattr" style="display: none">
                            <div id='TextBoxesGroup'>
                                <div id="TextBoxDiv1" >
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Size/Extra #1 : </label>
                                        <div class="col-md-5">
                                            <input class="form-control input-height" type='textbox' id='textbox1' name="textbox[]" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Price #1 : </label>
                                        <div class="col-md-5">
                                            <input class="form-control input-height" type='textbox' id='textimage1' name="textprice[]">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Status #1: </label>
                                        <div class="col-md-5">
                                            <select class="form-control input-height"  name="itemsizeStatus[]">
                                                <option value="">Select...</option>
                                                <option >Active</option>
                                                <option >Inactive</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="add_remove_button" class="form-group" style="margin-left: 230px">
                                <input class="btn btn-success" type='button' value='Add More' id='addButton'>
                                <input class="btn btn-danger" type='button' value='Remove' id='removeButton'>
                            </div>

                        </div>

                        <div id = "Item_price" class="form-group">
                            <label class="control-label col-md-3"> Item Price<span style="color: red" class="required">*</span></label>
                            <div class="col-md-5">
                                <input type="text" name="itemPrice" placeholder="Item Price" id="itemPrice"  class="form-control input-height" required >
                            </div>


                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Item Picture <span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <input type="file" name="ItemPicture"  value="upload Image" accept=".jpg, .jpeg" id="ItemPicture" required>
                                @if ($errors->has('ItemPicture'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ItemPicture') }}</strong>
                                    </span>
                                @endif
                                <img height="50px" width="50px" id="ItemPicture">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status <span style="color: red" class="required">*</span> </label>
                            <div class="col-sm-5">
                                <select class="form-control" name="itemStatus" required>
                                    <option selected value="">Select Status</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
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

            var counter = 2;
            $("#addButton").click(function () {
                if(counter>10){
                    alert("Only 10 textboxes allow");
                    return false;
                }
                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("id", 'TextBoxDiv' + counter);

                newTextBoxDiv.after().html('<div class="form-group">'+
                    '<label class="control-label col-md-3">Size/Extra #'+ counter + ' : </label>'+
                    '<div class="col-md-5">'+
                    '<input class="form-control input-height" type="textbox" id="textbox1" name="textbox[]" >'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                    '<label class="control-label col-md-3">Price #'+ counter + ' : </label>'+
                    '<div class="col-md-5">'+
                    '<input class="form-control input-height" type="textbox" id="textimage1" name="textprice[]">'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                    '<label class="control-label col-md-3">Status: #' +counter+'</label>'+
                    '<div class="col-md-5">'+
                    '<select class="form-control input-height"  name="itemsizeStatus[]">'+
                    '<option value="">Select...'+'</option>'+
                    '<option value="1">Active'+'</option>'+
                    '<option value="0">Inactive'+'</option>'+
                    '</select>'+
                    '</div>'+
                    '</div>'
                );
                newTextBoxDiv.appendTo("#TextBoxesGroup");
                counter++;
            });
            $("#removeButton").click(function () {
                if(counter==2){
                    alert(" textbox to remove");
                    document.getElementById('Item_price').style.display = "block";
                    document.getElementById('add_remove_button').style.display = "none";
                    document.getElementById('showattr').style.display = "none";
                    return false;
                }
                counter--;
                $("#TextBoxDiv" + counter).remove();
            });
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

        function selectid2() {
            document.getElementById('showattr').style.display = "block";
            document.getElementById('Item_price').style.display = "none";
            document.getElementById("itemPrice").required = false;
            document.getElementById('add_remove_button').style.display = "block";
            return false;
        }

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