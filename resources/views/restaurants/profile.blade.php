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
                                <h6><a href="#">{{$rest->name}}</a></h6> <a class="btn btn-small btn-green">Open</a>
                                <p>{{$rest->details}}</p>
                                <ul class="nav nav-inline">
                                    <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min $ {{$rest->minOrder}}</a> </li>
                                    <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 30 min</a> </li>
                                    <li class="nav-item ratings">
                                        <a class="nav-link" href="#"> <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    </span> </a>
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
                               <div > <li id="{{$cat->categoryId}}"><a href="#{{$cat->categoryId}}" class="scroll active">{{$cat->name}}</a></li></div>
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
                <div class="col-xs-12 col-md-12 col-lg-3">
                    <div class="sidebar-wrap">
                        <div class="widget widget-cart">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Your Shopping Cart
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="order-row bg-white">
                                <div class="widget-body">
                                    <div class="title-row">Pizza Quatro Stagione <a href="#"><i class="fa fa-trash pull-right"></i></a></div>
                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                            <select class="form-control b-r-0" id="exampleSelect1">
                                                <option>Size SM</option>
                                                <option>Size LG</option>
                                                <option>Size XL</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="number" value="2" id="example-number-input"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-row">
                                <div class="widget-body">
                                    <div class="title-row">Carlsberg Beer <a href="#"><i class="fa fa-trash pull-right"></i></a></div>
                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                            <select class="form-control b-r-0">
                                                <option>Size SM</option>
                                                <option>Size LG</option>
                                                <option>Size XL</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control" value="4" id="quant-input"> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:Order row -->
                            <div class="widget-delivery clearfix">
                                <form>
                                    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6 b-t-0">
                                        <label class="custom-control custom-radio">
                                            <input id="radio4" name="radio" type="radio" class="custom-control-input" checked=""> <span class="custom-control-indicator"></span> <span class="custom-control-description">Delivery</span> </label>
                                    </div>
                                    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6 b-t-0">
                                        <label class="custom-control custom-radio">
                                            <input id="radio3" name="radio" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Takeout</span> </label>
                                    </div>
                                </form>
                            </div>
                            <div class="widget-body">
                                <div class="price-wrap text-xs-center">
                                    <p>TOTAL</p>
                                    <h3 class="value"><strong>$ 25,49</strong></h3>
                                    <p>Free Shipping</p>
                                    <button onclick="location.href='checkout.html'" type="button" class="btn theme-btn btn-lg">Checkout</button>
                                </div>
                            </div>
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
@endsection