@extends('main')

@section('content')



    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                       Edit Restaurant
                    </div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data" method="post" action="{{route('restaurant.update')}}">

                        @csrf
                    <input type="hidden" value="{{$restaurant->resturantId}}" name="id">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" name="name" placeholder="Enter Restaurant Name" value="{{$restaurant->name}}">
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
                                <textarea class="form-control" id="field-ta" name="details" placeholder="Textarea">{{$restaurant->details}}</textarea>
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
                                <input type="number" min="0" class="form-control" id="field-1" name="minOrder" value="{{$restaurant->minOrder}}" placeholder="min order">
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
                                <input type="number" min="0" class="form-control" id="field-1" name="delfee" value="{{$restaurant->delfee}}" placeholder="insert fee">
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
                                <input type="file" name="image"  value="upload Image" accept=".jpg, .jpeg" id="mainPic" >

                            @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <img height="50px" @if($restaurant->image != null) src="{{url('public/RestaurantImages/'.$restaurant->image)}}"  @endif width="50px" id="imgMainPic">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" name="address" placeholder="Textarea">{{$restaurant->address}}</textarea>
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
                                <input type="text" class="form-control" id="city" name="city" value="{{$restaurant->city}}" placeholder="Enter Restaurant Name">
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
                                <input type="text" class="form-control" id="zip" value="{{$restaurant->zip}}" name="zip" placeholder="Enter Restaurant Name">
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
                            <a class="btn btn-info" data-toggle="modal" data-target="#myModal">Update Time</a>
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
                                                    <input type="hidden" name="satId" value="{{$saturday->resturanttimeId}}">
                                                    <input type="time" name="satOpen" value="{{$saturday->opentime}}" class="form-control" />
                                                    <input type="time" name="satClose" value="{{$saturday->closetime}}" class="form-control" />
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
                                                    <input type="hidden" name="sunId" value="{{$sunday->resturanttimeId}}">
                                                    <input type="time" name="sunOpen" value="{{$sunday->opentime}}"  class="form-control" />
                                                    <input type="time" name="sunClose" value="{{$sunday->closetime}}"  class="form-control" />
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
                                                    <input type="hidden" name="monId" value="{{$monday->resturanttimeId}}">
                                                    <input type="time" name="monOpen" value="{{$monday->opentime}}" class="form-control " />
                                                    <input type="time" name="monClose" value="{{$monday->closetime}}" class="form-control " />
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
                                                    <input type="hidden" name="tueId" value="{{$tuesday->resturanttimeId}}">
                                                    <input type="time" name="tueOpen" value="{{$tuesday->opentime}}" class="form-control " />
                                                    <input type="time" name="tueClose" value="{{$tuesday->closetime}}" class="form-control" />
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
                                                    <input type="hidden" name="wedId" value="{{$wednesday->resturanttimeId}}">
                                                    <input type="time" name="wedOpen" value="{{$wednesday->opentime}}" class="form-control" />
                                                    <input type="time" name="wedClose" value="{{$wednesday->closetime}}" class="form-control" />
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
                                                    <input type="hidden" name="thuId" value="{{$thursday->resturanttimeId}}">
                                                    <input type="time" name="thuOpen" value="{{$thursday->opentime}}" class="form-control " />
                                                    <input type="time" name="thuClose" value="{{$thursday->closetime}}" class="form-control " />
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
                                                    <input type="hidden" name="friId" value="{{$friday->resturanttimeId}}">
                                                    <input type="time" name="friOpen" value="{{$friday->opentime}}" class="form-control " />
                                                    <input type="time" name="friClose" value="{{$friday->closetime}}" class="form-control " />
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
                                    @foreach(Status as $s)
                                        <option value="{{$s}}" @if($s ==$restaurant->status) selected @endif>{{$s}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-default">Update</button>
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
        $("#mainPic").change(function(){
            mainPic(this);
        });

        function mainPic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgMainPic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }




        $( function() {
            var availableCity=[
                "Altstadt",
                "Altstadt",
                "Bahnhofsviertel",
                "Bergen-Enkheim",
                "Bergen-Enkheim",
                "Berkersheim",
                "Bockenheim",
                "Bockenheim",
                "Bockenheim",
                "Bockenheim",
                "Bockenheim",
                "Bonames",
                "Bonames",
                "Bornheim",
                "Bornheim",
                "Bornheim",
                "Bornheim",
                "Dornbusch",
                "Dornbusch",
                "Dornbusch",
                "Dornbusch",
                "Dornbusch",
                "Eckenheim",
                "Eckenheim",
                "Eschersheim",
                "Eschersheim",
                "Fechenheim",
                "Fechenheim",
                "Flughafen",
                "Frankfurter Berg",
                "Gallus",
                "Gallus",
                "Gallus",
                "Gallus",
                "Gallus",
                "Ginnheim",
                "Griesheim",
                "Griesheim",
                "Gutleutviertel",
                "Gutleutviertel",
                "Harheim",
                "Hausen",
                "Hausen",
                "Heddernheim",
                "Höchst",
                "Höchst",
                "Innenstadt",
                "Innenstadt",
                "Innenstadt",
                "Innenstadt",
                "Innenstadt",
                "Innenstadt",
                "Kalbach",
                "Kalbach",
                "Kalbach-Riedberg",
                "Nied",
                "Nied",
                "Nieder-Erlenbach",
                "Nieder-Eschbach",
                "Niederrad",
                "Niederursel",
                "Niederursel",
                "Nordend-Ost",
                "Nordend-Ost",
                "Nordend-Ost",
                "Nordend-Ost",
                "Nordend-West",
                "Nordend-West",
                "Nordend-West",
                "Nordend-West",
                "Nordend-West",
                "Nordend-West",
                "Oberrad",
                "Ostend",
                "Ostend",
                "Ostend",
                "Praunheim",
                "Praunheim",
                "Praunheim",
                "Preungesheim",
                "Preungesheim",
                "Riederwald",
                "Rödelheim",
                "Rödelheim",
                "Rödelheim",
                "Rödelheim",
                "Sachsenhausen",
                "Sachsenhausen",
                "Sachsenhausen",
                "Sachsenhausen",
                "Sachsenhausen",
                "Schwanheim",
                "Schwanheim",
                "Seckbach",
                "Seckbach",
                "Seckbach",
                "Sindlingen",
                "Sossenheim",
                "Unterliederbach",
                "Westend-Nord",
                "Westend-Nord",
                "Westend-Nord",
                "Westend-Nord",
                "Westend-Süd",
                "Westend-Süd",
                "Westend-Süd",
                "Westend-Süd",
                "Westend-Süd",
                "Westend-Süd",
                "Westend-Süd",
                "Westend-Süd",
                "Westend-Süd",
                "Zeilsheim",
            ];
            var availableZip = [
                "60311",
                "60313",
                "60329",
                "60388",
                "60389",
                "60435",
                "60320",
                "60325",
                "60431",
                "60486",
                "60487",
                "60433",
                "60437",
                "60385",
                "60386",
                "60389",
                "60435",
                "60320",
                "60322",
                "60431",
                "60433",
                "60435",
                "60320",
                "60435",
                "60431",
                "60433",
                "60314",
                "60386",
                "60549",
                "60433",
                "60325",
                "60326",
                "60327",
                "60329",
                "60486",
                "60431",
                "60326",
                "65933",
                "60327",
                "60329",
                "60437",
                "60487",
                "60488",
                "60439",
                "65929",
                "65934",
                "60310",
                "60311",
                "60313",
                "60318",
                "60322",
                "60329",
                "60437",
                "60439",
                "60438",
                "65934",
                "65936",
                "60437",
                "60437",
                "60528",
                "60437",
                "60439",
                "60316",
                "60318",
                "60385",
                "60389",
                "60316",
                "60318",
                "60320",
                "60322",
                "60389",
                "60435",
                "60599",
                "60314",
                "60316",
                "60385",
                "60431",
                "60439",
                "60488",
                "60433",
                "60435",
                "60386",
                "60486",
                "60487",
                "60488",
                "60489",
                "60528",
                "60594",
                "60596",
                "60598",
                "60599",
                "60528",
                "60529",
                "60386",
                "60388",
                "60389",
                "65931",
                "65936",
                "65929",
                "60320",
                "60322",
                "60323",
                "60431",
                "60306",
                "60308",
                "60320",
                "60322",
                "60323",
                "60325",
                "60327",
                "60486",
                "60487",
                "65931",


            ];

            $( "#zip" ).autocomplete({
                source: availableZip
            });
            $( "#city" ).autocomplete({
                source: availableCity
            });
        } );





    </script>


@endsection