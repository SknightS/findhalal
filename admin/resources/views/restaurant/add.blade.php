@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                       Add Restaurant
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" method="post" action="{{route('restaurant.insert')}}">
                        @csrf

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" name="name" placeholder="Enter Restaurant Name">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">Details</label>

                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" name="details" placeholder="Textarea"></textarea>
                                @if ($errors->has('details'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Min Order</label>
                            <div class="col-sm-5">
                                <input type="number" min="0" class="form-control" id="field-1" name="minOrder" placeholder="min order">
                                @if ($errors->has('minOrder'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('minOrder') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Delivery Fee</label>
                            <div class="col-sm-5">
                                <input type="number" min="0" class="form-control" id="field-1" name="delfee" placeholder="insert fee">
                                @if ($errors->has('delfee'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('delfee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Picture</label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control" name="image" id="field-file" placeholder="Placeholder">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" name="address" placeholder="Textarea"></textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">City</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" name="city" placeholder="Enter Restaurant Name">
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Zip</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" name="zip" placeholder="Enter Restaurant Name">
                                @if ($errors->has('zip'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-3 control-label">Country</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="country">
                                    <option>Germany</option>
                                    <option>Bangladesh</option>
                                    <option>India</option>
                                    <option>UK</option>
                                    <option>USA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" style="text-align:center">
                            <a class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Time</a>
                        </div>



                        <!--Add Time Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Opening time of whole week</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Saturday</label>
                                            <div class="col-sm-8">
                                                <div class="input-group minimal">
                                                    <div class="input-group-addon">
                                                        <i class="entypo-clock"></i>
                                                    </div>
                                                    <input type="text" name="satOpen" id="timepicker" class="form-control timepicker" />
                                                    <input type="text" name="satClose" class="form-control timepicker" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Sunday</label>
                                            <div class="col-sm-8">
                                                <div class="input-group minimal">
                                                    <div class="input-group-addon">
                                                        <i class="entypo-clock"></i>
                                                    </div>
                                                    <input type="text" name="sunOpen" value="" class="form-control timepicker" />
                                                    <input type="text" name="sunClose" class="form-control timepicker" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Monday</label>
                                            <div class="col-sm-8">
                                                <div class="input-group minimal">
                                                    <div class="input-group-addon">
                                                        <i class="entypo-clock"></i>
                                                    </div>
                                                    <input type="text" name="monOpen" class="form-control timepicker" />
                                                    <input type="text" name="monClose" class="form-control timepicker" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Tuesday</label>
                                            <div class="col-sm-8">
                                                <div class="input-group minimal">
                                                    <div class="input-group-addon">
                                                        <i class="entypo-clock"></i>
                                                    </div>
                                                    <input type="text" name="tueOpen" class="form-control timepicker" />
                                                    <input type="text" name="tueClose" class="form-control timepicker" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Wednesday</label>
                                            <div class="col-sm-8">
                                                <div class="input-group minimal">
                                                    <div class="input-group-addon">
                                                        <i class="entypo-clock"></i>
                                                    </div>
                                                    <input type="text" name="wedOpen" class="form-control timepicker" />
                                                    <input type="text" name="wedClose" class="form-control timepicker" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Thursday</label>
                                            <div class="col-sm-8">
                                                <div class="input-group minimal">
                                                    <div class="input-group-addon">
                                                        <i class="entypo-clock"></i>
                                                    </div>
                                                    <input type="text" name="thuOpen" class="form-control timepicker" />
                                                    <input type="text" name="thuClose" class="form-control timepicker" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Friday</label>
                                            <div class="col-sm-8">
                                                <div class="input-group minimal">
                                                    <div class="input-group-addon">
                                                        <i class="entypo-clock"></i>
                                                    </div>
                                                    <input type="text" name="friOpen" class="form-control timepicker" />
                                                    <input type="text" name="friClose" class="form-control timepicker" />
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{--End Modal--}}



                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="status">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-default">Create</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>






@endsection
@section('foot-js')
    <script src="{{url('assets/js/bootstrap-timepicker.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('.timepicker').val(null);
        });

    </script>


    @endsection