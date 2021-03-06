@extends('main')

@section('content')
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-3 link-item"><span>1</span><a href="#">Choose Your Location</a></li>
                    <li class="col-xs-12 col-sm-3 link-item"><span>2</span><a href="#">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-3 link-item active"><span>3</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-3 link-item"><span>4</span><a href="#">Order and Pay online</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <section class="inner-page-hero bg-image" data-image-src="{{url('images/fhb.jpg')}}">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        @foreach($restaurant as $rest)
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><img src="{{url('admin/public/RestaurantImages/'.$rest->image)}}" alt="Profile Image"></figure>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">

                                <div class="pull-left right-text white-txt">
                                    <h6><a href="">{{$rest->name}}</a></h6>


                                                <a class="btn btn-small ">{{$restaurantStatus}}</a>


                                    <p>{{$rest->details}}</p>
                                    <ul class="nav nav-inline">
                                        <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min $ {{$rest->minOrder}}</a> </li>
                                        <li class="nav-item">  </li>
                                        <li class="nav-item ratings">
                                            <a class="nav-link" style="cursor: pointer">


                                            @foreach($restaurantRating as $rating)

                                                <span>
                                                        @if(round($rating->avgRating) == '0')
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @if(round($rating->avgRating) == '1')
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @if(round($rating->avgRating) == '2')
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @if(round($rating->avgRating) == '3')
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @if(round($rating->avgRating) == '4')
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                        @if(round($rating->avgRating) == '5')
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                      </span>




                                            @endforeach
                                            </a>
                                            @if(isset($rating))
                                            &nbsp; <span class="review pull-right"><span style="color: white">{{$rating->totalRating}} Ratings</span> </span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end:Inner page hero -->
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#">Search results</a></li>
                    <li>Profile</li>
                </ul>
            </div>
        </div>
        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                    <div class="sidebar clearfix m-b-20">
                        <div class="main-block">
                            <div class="sidebar-title white-txt">
                                <h6>Choose Cusine</h6> <i class="fa fa-cutlery pull-right"></i> </div>
                            <ul id="mydiv">
                                @foreach($category as $cat)
                                    <div >
                                        <li id="{{$cat->categoryId}}">
                                            <a href="#{{$cat->categoryId}}" class="scroll active">{{$cat->name}}</a>
                                        </li>
                                    </div>
                                @endforeach
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <!-- end:Sidebar nav -->

                    </div>
                    <!-- end:Left Sidebar -->

                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                    <div id="showitem"></div>
                    <!--/row -->
                </div>
                <!-- end:Bar -->
                <div  class="col-xs-12 col-md-12 col-lg-3">
                    <div class="sidebar-wrap">
                        <div class="widget widget-cart">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Your Shopping Cart
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <span id="cart_table">
                            @foreach($cartitem as $ci)
                            <div class="order-row bg-white">
                                <div class="widget-body">

                                    <div class="title-row">{{$ci->name}} <button id="{{$ci->id}}" class="btn btn-info btn-sm pull-right" onclick="deleteCart(this)"><i class="fa fa-trash"></i></button></div>

                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                           {{$ci->attributes->sizeName}} € {{$ci->price}}
                                            {{--<select class="form-control b-r-0" id="{{"size".$ci->id}}"  data-panel-id="{{$ci->id}}" onchange="updatesize(this)" >--}}
                                              {{--@foreach($itemsize as $is)--}}
                                                  {{--@if($ci->id ==$is->item_itemId)--}}
                                                {{--<option @if($ci->attributes->size == $is->itemsizeId) selected @endif value="{{$is->itemsizeId}}" >{{$is->itemsizeName." €".$is->price }}</option>--}}
                                                    {{--@endif--}}
                                                  {{--@endforeach--}}
                                            {{--</select>--}}
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control myInputField" id="{{"qty".$ci->id}}" type="number" min="1" value="{{$ci->quantity}}" data-panel-id="{{$ci->id}}"  onkeypress="return isNumberKey(event,this)" onkeyup="updateqty(this)" onchange="updateqty(this)" >

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- end:Order row -->
                            <div id="ordertypeDiv" class="widget-delivery clearfix">

                                <form>
                                    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6 b-t-0">
                                        <label class="custom-control custom-radio">
                                            <input id="radio4" name="radio" type="radio" class="custom-control-input" @if(Session::get('ordertype')=='Delivery') checked @endif required onclick="delivery()" required> <span class="custom-control-indicator"></span> <span class="custom-control-description">Delivery</span> </label>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6 b-t-0">
                                        <label class="custom-control custom-radio">
                                            <input id="radio3" name="radio" type="radio" class="custom-control-input" @if(Session::get('ordertype')=='Takeout') checked @endif onclick="takeout()" required> <span class="custom-control-indicator"></span> <span class="custom-control-description">Takeout</span> </label>
                                    </div>
                                </form>
                            </div>
                            <div class="widget-body">
                                <div id="totalPrice" class="price-wrap text-xs-center">
                                    <p>TOTAL</p>
                                    <h3 class="value"><strong>{{"€"}}{{Cart::getTotal()}}</strong></h3>


                                    {{--<button onclick="location.href='{{route('restaurant.checkout')}}'" type="submit" class="btn theme-btn btn-lg">Checkout</button>--}}
                                    <button onclick="checkOut()" id="checkOut" type="submit" class="btn theme-btn btn-lg">Checkout</button>
                                </div>
                            </div>
                                 </span>
                        </div>
                    </div>
                </div>
                <!-- end:Right Sidebar -->
            </div>
            <!-- end:row -->
        </div>
        <!-- end:Container -->
    </div>
@endsection

@section('foot-js')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var resid = '<?php echo $resid ?>';
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.getItem')}}',
                data : {_token: CSRF_TOKEN,'resid':resid} ,
                success : function(data){
                    //   alert(data);
                    //console.log(data);
                    document.getElementById("showitem").innerHTML = data;
                }
            });


            $('#mydiv li').click(function() {
                //Get the id of list items
                var ID = $(this).attr('id');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var resid = '<?php echo $resid ?>';
                $.ajax({
                    type : 'post' ,
                    url : '{{route('restaurant.getItemByCategory')}}',
                    data : {_token: CSRF_TOKEN,'resid':resid, 'catid':ID} ,
                    success : function(data){
                        //   alert(data);
                        //console.log(data);
                        document.getElementById("showitem").innerHTML = data;
                    }
                });
            });

        });
    </script>

    <script>
        function addcart(x){

            var zipcode = '<?php echo $zipcode ?>';

           var id = $(x).data('panel-id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // alert(id);
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.addCart')}}',
                data : {_token: CSRF_TOKEN, 'itemid':id, 'zipcode':zipcode} ,
                success : function(data){

                    if(data=='mismatch'){
                        $.alert({
                            title: 'Alert!',
                            type: 'red',
                            content: 'You can not order from multiple restaurant at a time',

                        });

                    }

                    $('#cart_table').load(document.URL +  ' #cart_table');
                }
            });
        }
        function checkOut(){

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.checkOrderType')}}',
                data : {_token: CSRF_TOKEN,} ,
                success : function(data){

                    if (data== '1'){

                        location.href='{{route('restaurant.checkout')}}';

                    }
                    else if (data== '2'){

                        $.alert({
                            title: 'Alert!',
                            type: 'Red',
                            content: 'Your Cart is Empty ',
                            buttons: {
                                tryAgain: {
                                    text: 'Ok',
                                    btnClass: 'btn-red',
                                    action: function () {

                                    }
                                }

                            }
                        });

                    }else {

                        $.alert({
                            title: 'Alert!',
                            type: 'Red',
                            content: 'Order Type Must be Delivery or Takeout',
                            buttons: {
                                tryAgain: {
                                    text: 'Ok',
                                    btnClass: 'btn-red',
                                    action: function () {

                                    }
                                }

                            }
                        });
                        $('#cart_table').load(document.URL +  ' #cart_table');

                    }



                }
            });
        }

        function updatesize(x) {
            var id = $(x).data('panel-id');
           var  itemsize = document.getElementById("size"+id).value;



            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            type : 'post' ,
            url : '{{route('restaurant.updateitemsize')}}',
            data : {_token: CSRF_TOKEN, 'itemsize':itemsize, 'cartid':id} ,
            success : function(data){

            $('#cart_table').load(document.URL +  ' #cart_table');

            }
            });
        }

        function updateqty(x) {

                var id = $(x).data('panel-id');
               var qty = document.getElementById("qty"+id).value;


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.updateitemqty')}}',
                data : {_token: CSRF_TOKEN, 'qty':qty, 'cartid':id} ,
                success : function(data){

                  //  $('#cart_table').load(document.URL +  ' #cart_table');
                    $('#totalPrice').load(document.URL +  ' #totalPrice');

                }
            });

        }
        function removecart(x) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = $(x).data('panel-id2');

       //     alert(id);
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.removecart')}}',
                data : {_token: CSRF_TOKEN, 'cartid':id} ,
                success : function(data){

                    //alert(data);
                  //  $('#cart_table').load(document.URL +  ' #cart_table');

                }
            });
        }

        function deleteCart(x) {

            var id = x.id;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.removeCart')}}',
                data : {_token: CSRF_TOKEN, 'itemid':id} ,
                success : function(data){

                    console.log(data);
                    $('#cart_table').load(document.URL +  ' #cart_table');
                }
            });

        }

        function delivery() {


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.delivery')}}',
                data : {_token: CSRF_TOKEN} ,
                success : function(data){

                    $('#ordertypeDiv').load(document.URL +  ' #ordertypeDiv');

                }
            });
           //  $('#cart_table').load(document.URL +  ' #cart_table');
        }
        function takeout() {


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.takeout')}}',
                data : {_token: CSRF_TOKEN} ,
                success : function(data){

                     $('#ordertypeDiv').load(document.URL +  ' #ordertypeDiv');

                }
            });
          //   $('#cart_table').load(document.URL +  ' #cart_table');
        }



    </script>

    <SCRIPT language=Javascript>
        <!--
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        //-->
    </SCRIPT>
@endsection