@extends('main')
@section('header')
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="{{url('public/rating/css/star-rating.min.css')}}" media="all" rel="stylesheet" type="text/css" />


    <style>
        .StripeElement {
            background-color: white;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection
@section('content')

    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-3 link-item active"><span>1</span><a href="index.html">Choose Your Location</a></li>
                    <li class="col-xs-12 col-sm-3 link-item active"><span>2</span><a href="restaurants.html">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-3 link-item active"><span>3</span><a href="profile.html">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-3 link-item"><span>4</span><a href="checkout.html">Order and Pay online</a></li>
                </ul>
            </div>
        </div>




        <div class="container m-t-30">
            <div class="widget clearfix">
                <!-- /widget heading -->
                <div class="widget-heading">
                    <h3 class="widget-title text-dark">
                       <span style="color: #0a001f">Cart summary</span>
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-body">
                    {{--<form method="post" action="{{route('restaurant.submitorder')}}">--}}
                    {{--{{csrf_field()}}--}}
                    <div class="row">
                        <div class="col-sm-6 margin-b-30">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input type="text" class="form-control"  id="firstname" name="firstname" placeholder=""> </div>
                                    <!--/form-group-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder=""> </div>
                                    <!--/form-group-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Full Address*</label>
                                        <input type="text" class="form-control" placeholder="" id="address" name="address"> </div>
                                    <!--/form-group-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City / State*</label>
                                        <input type="text" class="form-control" placeholder="" id="city" name="city"> </div>
                                    <!--/form-group-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Zip/ Postal Code*</label>
                                        <input type="number" class="form-control" placeholder="" id="zip" name="zip"> </div>
                                    <!--/form-group-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address*</label>
                                        <input type="email" class="form-control" placeholder="" id="email" name="email"> </div>
                                    <!--/form-group-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>phone*</label>
                                        <input type="number" class="form-control" placeholder="" id="phone" name="phone"> </div>
                                    <!--/form-group-->
                                </div>

                                <div class="col-sm-12">
                                    {{--Rating--}}
                                    <input id="rating-input" type="text" data-size="sm" title=""/>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="cart-totals margin-b-20">
                                <div class="cart-totals-title">
                                    <h4>Cart Summary</h4> </div>
                                <div class="cart-totals-fields">
                                    <table class="table">
                                        <tbody>

                                        <tr>
                                            <td>Cart Subtotal</td>
                                            <td>{{"€ "}}{{Cart::getTotal()}}</td>
                                        </tr>

                                        <tr>
                                            @foreach($cartitem as $ci)
                                                <td>Shipping &amp; Handling</td>

                                                @php
                                                    $delfee = 0;
                                                     if(Session::get('ordertype') == "Delivery"){
                                                     $delfee = $ci->attributes->delfee;
                                                     }
                                                     else{
                                                     $delfee = 0;
                                                     }
                                                @endphp
                                                <td>{{"€ "}}{{ $delfee }}</td>
                                                @break
                                            @endforeach
                                        </tr>
                                        {{--For Min Order--}}
                                        <tr>
                                            <td>Discount</td>
                                            @if(Cart::getTotal() >$minOrder)
                                                <td>€ {{$delfee}}</td>
                                                @php($delfee=0)
                                            @else
                                                <td>€ 0</td>

                                            @endif



                                        </tr>

                                        <tr>
                                            <td class="text-color"><strong>Total</strong></td>
                                            <td class="text-color"><strong>{{"€ "}}{{Cart::getTotal()+ $delfee}}</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <!--cart summary-->
                            <div class="payment-option">
                                <ul class=" list-unstyled">
                                    <li>
                                        <label class="custom-control custom-radio  m-b-20">
                                            <input id="radioStacked1" name="radio-stacked" type="radio" class="custom-control-input" onclick="cash()" required> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                            <br> <span>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</span> </label>
                                    </li>
                                    {{--<li>--}}
                                    {{--<label class="custom-control custom-radio  m-b-10">--}}
                                    {{--<input name="radio-stacked" type="radio" class="custom-control-input" onclick="card()" required> <span class="custom-control-indicator"></span> <span class="custom-control-description">Pay Online <img src="images/paypal.jpg" alt="" width="90"></span> </label>--}}
                                    {{--</li>--}}

                                    <li>

                                        <label class="custom-control custom-radio  m-b-10">
                                            <input name="radio-stacked" id="cartButton" type="radio" onclick="card()"  class="custom-control-input">
                                            {{--<input name="radio-stacked" type="radio" class="custom-control-input" onclick="card()" required> --}}
                                            <span class="custom-control-indicator"></span> <span class="custom-control-description">Pay Online
                                                        <img src="images/paypal.jpg" alt="" width="90"></span> </label>

                                        {{--<button data-toggle="collapse" class="btn btn-outline-success btn-block" data-target="#demo">Pay With Card</button>--}}

                                        <div id="demo" style="display: none">

                                            <script src="https://js.stripe.com/v3/"></script>
                                            <form action="{{route('restaurant.submitorder')}}" method="post" id="payment-form">
                                                {{csrf_field()}}
                                                <div class="form-row">
                                                    <label for="card-element">
                                                        Credit or debit card
                                                    </label>
                                                    <div id="card-element">
                                                        <!-- A Stripe Element will be inserted here. -->
                                                    </div>

                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                </div>

                                                <button class="btn btn-outline-success btn-block">Pay now</button>
                                            </form>

                                        </div>
                                    </li>
                                </ul>
                                {{--<p class="text-xs-center"> <button type="submit" id="PayNowCard" style="display: none" class="btn btn-outline-success btn-block">Pay now1</button> </p>--}}
                                <p class="text-xs-center"> <button type="submit" id="PayNowCash" style="display: none" onclick="cash()" class="btn btn-outline-success btn-block">Pay now</button> </p>
                            </div>
                        </div>
                    </div>
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot-js')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{url('public/rating/js/star-rating.min.js')}}" type="text/javascript"></script>

    <script>
        // Create a Stripe client.  pk_live_FpOYxAZOuEFIkVQTX5QUYQQp
        var stripe = Stripe('pk_live_FpOYxAZOuEFIkVQTX5QUYQQp');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };



        function stripeTokenHandler(token) {
       // console.log(token);
            // Insert the token ID into the form so it gets submitted to the server
            // var form = document.getElementById('payment-form');
            // var hiddenInput = document.createElement('input');
            // hiddenInput.setAttribute('type', 'hidden');
            // hiddenInput.setAttribute('name', 'stripeToken');
            // hiddenInput.setAttribute('value', token.id);
            // form.appendChild(hiddenInput);

            // Submit the form
            // form.submit();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


            var rating=$('#rating-input').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var zip = $('#zip').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (firstname ==""){

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'FirstName can not be empty',

                });

            }
            else if (lastname ==""){

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'LastName can not be empty',

                });

            }
            else if (address ==""){

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Address can not be empty',

                });

            }else if (city ==""){

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'City can not be empty',

                });

            }else if (zip ==""){

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Zip can not be empty',

                });

            }else if (email ==""){

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Email can not be empty',

                });

            }
            else if(!email.match(mailformat))
            {
                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'You have entered an invalid email address!',

                });

            }
            else if (phone ==""){

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Phone can not be empty',

                });

            }
            else {

                $.ajax({
                    type: 'post',
                    url: '{{route('restaurant.submitorder')}}',
                    data: {
                        _token: CSRF_TOKEN,
                        'firstname': firstname,
                        'lastname': lastname,
                        'address': address,
                        'city': city,
                        'zip': zip,
                        'email': email,
                        'phone': phone,
                        'rating': rating,
                        'stripeToken':token.id
                    },
                    success: function (data) {
                        console.log(data);
                        if(data=='error'){
                            location.reload();
                        }

                        else{
                            $.alert({
                                title: 'Alert!',
                                type: 'green',
                                content: 'Order Has Placed successfully',
                                buttons: {
                                    tryAgain: {
                                        text: 'Ok',
                                        btnClass: 'btn-blue',
                                        action: function () {

                                            window.location.href = "{{route('home')}}";
                                        }
                                    }

                                }
                            });

                        }



                    }
                });
            }


            }
    </script>


    <script>


        $(document).ready(function() {

            var $inp = $('#rating-input');

            $inp.rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'lg',
                showClear: false
            });


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $("#PayNowCash").click(function () {

                var rating=$('#rating-input').val();
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var address = $('#address').val();
                var city = $('#city').val();
                var zip = $('#zip').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if (firstname ==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'FirstName can not be empty',

                    });

                }
                else if (lastname ==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'LastName can not be empty',

                    });

                }
                else if (address ==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'Address can not be empty',

                    });

                }else if (city ==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'City can not be empty',

                    });

                }else if (zip ==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'Zip can not be empty',

                    });

                }else if (email ==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'Email can not be empty',

                    });

                }
                else if(!email.match(mailformat))
                {
                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'You have entered an invalid email address!',

                    });

                }
                else if (phone ==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'Phone can not be empty',

                    });

                }
                else {

                    $.ajax({
                        type : 'post' ,
                        url : '{{route('restaurant.submitorder')}}',
                        data : {_token: CSRF_TOKEN,'firstname':firstname,'lastname':lastname,'address':address,'city':city,
                            'zip':zip,'email':email,'phone':phone,'rating':rating
                        } ,
                        success : function(data){
                            // console.log(data);

                            $.alert({
                                title: 'Alert!',
                                type: 'green',
                                content: 'Order Has Placed successfully',
                                buttons: {
                                    tryAgain: {
                                        text: 'Ok',
                                        btnClass: 'btn-blue',
                                        action: function(){

                                           // window.location.href = "{{route('home')}}";
                                            console.log(data);
                                        }
                                    }

                                }
                            });

                        }
                    });

                }




            });


        });
        function cash() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.cash')}}',
                data : {_token: CSRF_TOKEN} ,
                success : function(data){

                    document.getElementById('PayNowCash').style.display = 'block';
//                    document.getElementById('PayNowCard').style.display = 'none';
                    $("#demo").slideToggle( "slow");
                    document.getElementById('demo').style.display = 'none';



                }
            });

        }

        function card() {

//        alert("card");

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : 'post' ,
                url : '{{route('restaurant.card')}}',
                data : {_token: CSRF_TOKEN} ,
                success : function(data){

                    document.getElementById('PayNowCash').style.display = 'none';
//                    document.getElementById('PayNowCard').style.display = 'block';
                    document.getElementById('demo').style.display = 'block';

                    // Create an instance of the card Element.
                    var card = elements.create('card', {style: style});

                    // Add an instance of the card Element into the `card-element` <div>.
                    card.mount('#card-element');

                    // Handle real-time validation errors from the card Element.
                    card.addEventListener('change', function(event) {
                        var displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

                    // Handle form submission.
                    var form = document.getElementById('payment-form');
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        stripe.createToken(card).then(function(result) {
                            if (result.error) {
                                // Inform the user if there was an error.
                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            } else {
                                // Send the token to your server.
                                stripeTokenHandler(result.token);
                            }
                        });
                    });

                }
            });

        }
    </script>
@endsection