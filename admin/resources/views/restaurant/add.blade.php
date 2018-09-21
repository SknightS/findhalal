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

                    <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"  method="post" action="{{route('restaurant.insert')}}">
                        @csrf

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="field-1" value="{{old('name')}}" name="name" placeholder="Enter Restaurant Name" required>
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
                                <textarea class="form-control" id="field-ta" name="details" placeholder="Textarea">{{old('details')}}</textarea>
                                @if ($errors->has('details'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Min Order(€)</label>
                            <div class="col-sm-5">
                                <input type="number" min="0" class="form-control"  value="{{old('minOrder')}}" name="minOrder" placeholder="min order" required>
                                @if ($errors->has('minOrder'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('minOrder') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        {{--<div class="form-group">--}}
                            {{--<label for="field-1" class="col-sm-3 control-label">Delivery Fee(€)</label>--}}
                            {{--<div class="col-sm-5">--}}
                                {{--<input type="number" min="0" class="form-control" value="{{old('delfee')}}" name="delfee" placeholder="insert fee">--}}
                                {{--@if ($errors->has('delfee'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('delfee') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Picture</label>
                            <div class="col-sm-5">
                                <input type="file" name="image"  value="upload Image" accept=".jpg, .jpeg" id="mainPic" >
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <img height="50px" width="50px" id="imgMainPic">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" id="field-ta" name="address" placeholder="Textarea" required>{{old('address')}}</textarea>
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
                                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" placeholder="enter your city">
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Zip</label>
                            <div class="col-sm-5" id="zipDiv">
                                {{--<input type="text" class="form-control" id="zip" value="{{old('zip')}}" name="zip" placeholder="enter your zip code">--}}
                                {{--@if ($errors->has('zip'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('zip') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                                <div class="row">
                                    <input type="text" class="col-sm-5 zip" name="zip[]" placeholder="enter your zip code" required>
                                    <input type="number" class="col-sm-5" name="deliveryFee[]" placeholder="enter delivery fee" required>
                                </div>



                            </div>
                            <button type="button" class="btn btn-success" onclick="addMoreZip()">add mode</button>
                            <button type="button" class="btn btn-danger" onclick="removeZip()">remove</button>
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



                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">email</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" id="zip" value="{{old('email')}}" name="email" placeholder="enter email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">phone</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="phone" value="{{old('phone')}}" name="phone" placeholder="number">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
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

                                                    <input type="time" name="satOpen"  class="form-control" />
                                                    <input type="time" name="satClose" class="form-control" />

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

                                                    <input type="time" name="sunOpen" id="timepicker" value="" class="form-control timepicker" />
                                                    <input type="time" name="sunClose" id="timepicker2" class="form-control timepicker" />

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
                                                    <input type="time" name="monOpen" class="form-control " />
                                                    <input type="time" name="monClose" class="form-control " />
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
                                                    <input type="time" name="tueOpen" class="form-control " />
                                                    <input type="time" name="tueClose" class="form-control" />
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
                                                    <input type="time" name="wedOpen" class="form-control" />
                                                    <input type="time" name="wedClose" class="form-control" />
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
                                                    <input type="time" name="thuOpen" class="form-control " />
                                                    <input type="time" name="thuClose" class="form-control " />
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
                                                    <input type="time" name="friOpen" class="form-control " />
                                                    <input type="time" name="friClose" class="form-control " />
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
                                    @if(Auth::user()->fkuserTypeId == User[0])
                                        @foreach(Status as $s)
                                            <option>{{$s}}</option>
                                         @endforeach
                                    @else
                                        <option>{{Status[1]}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Add as a featured Resturany</label>
                            <div class="col-sm-5">
                                <input type="checkbox" name="featureRes" value="1">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    var counter =1;
    function addMoreZip(){
        counter++;
        var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);


        newTextBoxDiv.after().html(
        '<br><div class="row">' +
        '<input type="text" class="col-sm-5 zip" name="zip[]" placeholder="enter your zip code" required> ' +
        '<input type="number" class="col-sm-5" name="deliveryFee[]" placeholder="enter delivery fee" required> ' +
        '</div>');
        newTextBoxDiv.appendTo("#zipDiv");
//        console.log(counter);

    }

    function removeZip() {

        $("#TextBoxDiv" + counter).remove();
        if(counter>0){
            counter--;
        }

//        console.log(counter);
    }



    function mainPic(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#imgMainPic').attr('src', e.target.result);}
               reader.readAsDataURL(input.files[0]);}
       }
       $("#mainPic").change(function(){
           mainPic(this);
       });


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

    $( ".zip" ).autocomplete({
        source: availableZip
    });
    $( "#city" ).autocomplete({
        source: availableCity
    });



} );


    </script>


    @endsection