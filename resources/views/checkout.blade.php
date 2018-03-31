@extends('main')

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
                            Cart summary
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-body">
                        <form method="post" action="{{route('restaurant.submitorder')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-6 margin-b-30">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name*</label>
                                                <input type="text" class="form-control"  name="firstname" placeholder=""> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name*</label>
                                                <input type="text" class="form-control" name="lastname" placeholder=""> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Country*</label>--}}
                                                {{--<select class="form-control">--}}
                                                    {{--<option>India</option>--}}
                                                    {{--<option>USA</option>--}}
                                                    {{--<option>UK</option>--}}
                                                    {{--<option>Australia</option>--}}
                                                    {{--<option>Japan</option>--}}
                                                    {{--<option>Columbia</option>--}}
                                                    {{--<option>Poland</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<!--/form-group-->--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Company Name</label>--}}
                                                {{--<input type="text" class="form-control" placeholder="Lorem ipsum"> </div>--}}
                                            {{--<!--/form-group-->--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Full Address*</label>
                                                <input type="text" class="form-control" placeholder="" name="address"> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>City / State*</label>
                                                <input type="text" class="form-control" placeholder="" name="city"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Zip/ Postal Code*</label>
                                                <input type="number" class="form-control" placeholder="" name="zip"> </div>
                                            <!--/form-group-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email Address*</label>
                                                <input type="email" class="form-control" placeholder="" name="email"> </div>
                                            <!--/form-group-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>phone*</label>
                                                <input type="number" class="form-control" placeholder="" name="phone"> </div>
                                            <!--/form-group-->
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
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="radio-stacked" type="radio" class="custom-control-input" onclick="card()" required> <span class="custom-control-indicator"></span> <span class="custom-control-description">Pay Online <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <button type="submit" class="btn btn-outline-success btn-block">Pay now</button> </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
 @endsection
@section('foot-js')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
    function cash() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    type : 'post' ,
    url : '{{route('restaurant.cash')}}',
    data : {_token: CSRF_TOKEN} ,
    success : function(data){

    }
    });

    }

    function card() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
    type : 'post' ,
    url : '{{route('restaurant.card')}}',
    data : {_token: CSRF_TOKEN} ,
    success : function(data){



    }
    });

    }
    </script>
    @endsection