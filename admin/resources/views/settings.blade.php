@extends('main')
<style>
    #field { margin-left: .5em; float: left; }
    #field, label { float: left; font-family: Arial, Helvetica, sans-serif; font-size: small; }
    br { clear: both; }
    input { border: 1px solid black; margin-bottom: .5em;  }
    input.error { border: 1px solid red; }
    label.error {
        background: url('images/unchecked.gif') no-repeat;
        padding-left: 16px;
        margin-left: .3em;
    }
    label.valid {
        background: url('images/checked.gif') no-repeat;
        display: block;
        width: 16px;
        height: 16px;
    }

</style>
@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Change Password
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" id="#myform" class="form-horizontal form-groups-bordered"  method="post" action="{{route('changePass')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Old Password</label>
                            <div class="col-sm-5">
                                <input type="password" min="0" class="form-control"  value="{{old('oldPass')}}" name="oldPass" placeholder="old password" required>
                                @if ($errors->has('minOrder'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('oldPass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">New Password</label>
                            <div class="col-sm-5">
                                <input type="password" min="0" class="form-control" id="newPass"  value="{{old('newPass')}}" name="newPass" placeholder="new password" required>
                                @if ($errors->has('newPass'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('newPass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-5">
                                <input type="password" min="0" class="form-control" id="confirmPass"  value="{{old('confirmPass')}}" name="confirmPass" placeholder="confirm password" required>
                                @if ($errors->has('confirmPass'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('confirmPass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="text-align: center;">
                        <button type="submit" class="btn btn-success">change</button>
                        </div>

                    </form>





                </div>
            </div>
        </div>
    </div>



    <script src="{{url('js/jqueryvalidate.js')}}"></script>
    <script src="{{url('js/additional-method.js')}}"></script>
    <script>



        //    jQuery.validator.setDefaults({
        //        debug: true,
        //        success: "valid"
        //    });
        var validator = $( "#myform" ).validate({
            rules: {
                newPass: "required",
                confirmPass: {
                    equalTo: "#newPass"
                }

            }

        });




    </script>


@endsection