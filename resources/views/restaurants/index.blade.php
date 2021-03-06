@extends('main')
@section('content')
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-3 link-item"><span>1</span><a href="index.html">Choose Your Location</a></li>
                    <li class="col-xs-12 col-sm-3 link-item active"><span>2</span><a href="restaurants.html">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-3 link-item"><span>3</span><a href="profile.html">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-3 link-item"><span>4</span><a href="checkout.html">Order and Pay online</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <div class="inner-page-hero bg-image" data-image-src="{{url('images/fhb.jpg')}}">
            <div class="container"> </div>
            <!-- end:Container -->
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <p><span class="primary-color"><strong>{{count($resturant)}}</strong></span> Results so far </div>
                    </p>
                    {{--<div class="col-sm-9">--}}
                        {{--<select class="custom-select pull-right">--}}
                            {{--<option selected>Open this select menu</option>--}}
                            {{--<option value="1">One</option>--}}
                            {{--<option value="2">Two</option>--}}
                            {{--<option value="3">Three</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <!-- //results show -->
        <section class="restaurants-page">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-10">
                        @if(count($resturant) <= 0 )

                            <h3 class="primary-color"><strong>There Are No Restaurants Available In Your Area </strong></h3>
                            @endif
                       @foreach($resturant as $res)
                        <div class="bg-gray restaurant-entry">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                    <div class="entry-logo">
                                        <a class="img-fluid" href="#"><img src="{{url('admin/public/RestaurantImages/'.$res->image)}}" alt="Food logo"></a>
                                    </div>
                                    <!-- end:Logo -->
                                    <div class="entry-dscr">
                                        <h5>
{{--                                            <a href="{{ route('restaurant.viewmenu', [$res->resturantId, $res->zipcodeZip]) }}">{{$res->name}}</a>--}}
                                            <a data-panel-id="{{$res->resturantId}}" onclick="showResZip(this)">{{$res->name}}</a>
                                        </h5> <span>{{$res->details}} <a href="#">...</a></span>
                                        <ul class="list-inline">
                                            {{--<li class="list-inline-item"><i class="fa fa-check"></i> Min € {{$res->minOrder}}</li>--}}
                                           {{$res->address}}
                                        </ul>
                                    </div>
                                    <!-- end:Entry description -->
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                    <div class="right-content bg-white">
                                        <div class="right-review">
                                            <div class="rating-block">

                                                @foreach($restaurantRating as $rating)
                                                    @if($res->resturantId == $rating->restaurantId)
                                                        <div class="rating pull-left">
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
                                                        </div>

                                                        <div class="review pull-right"><span style="color: red">{{$rating->totalRating}} Ratings</span> </div>
                                                    @endif

                                                @endforeach

                                            </div>
                                            {{--<p> 245 Reviews</p>--}}
{{--                                            <a href="{{ route('restaurant.viewmenu', [$res->resturantId , $res->zipcodeZip]) }}" class="btn theme-btn-dash">View Menu</a> --}}
                                            <a style="margin-top: 10px" data-panel-id="{{$res->resturantId}}" onclick="showResZip(this)" class="btn theme-btn-dash">View Menu</a>
                                        </div>
                                    </div>
                                    <!-- end:right info -->
                                </div>
                            </div>
                            <!--end:row -->
                        </div>
                        @endforeach
                        <!-- end:Restaurant entry -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('foot-js')
    <script>
        function showResZip(x) {
            var resId=$(x).data('panel-id');

            $.ajax({
                type: "POST",
                url: '{{route('restaurant.resZip')}}',
                data: {id:resId,_token:"{{csrf_token()}}"},
                success: function(data){

                    //  console.log(data);
                    if (data==0){

                        $.alert({
                            title: 'Error!',
                            type: 'red',
                            content: 'No Delivery Zip available',
                            buttons: {
                                tryAgain: {
                                    text: 'Ok',
                                    btnClass: 'btn-red',
                                    action: function () {
                                    }
                                }
                            }
                        });
                    }
                    else {
                        $('.modal-body').html(data);
                        $('#myModalLabel').html("Restaurant's Delivary Available");
                        $('#myModal').modal({show:true});
                    }

                },
            });


        }
    </script>
    @endsection