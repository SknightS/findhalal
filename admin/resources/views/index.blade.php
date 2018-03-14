@extends('main')

@section('content')



<div class="row">
    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-red">
            <div class="icon"><i class="entypo-users"></i></div>
            <div class="num" data-start="0" data-end="{{$regiteredUser}}" data-postfix="" data-duration="1500" data-delay="0">0</div>

            <h3>Registered users</h3>
            <p>so far in our blog, and our website.</p>
        </div>

    </div>

    <div class="col-sm-3 col-xs-6">
        <div class="tile-stats tile-green">
            <div class="icon"><i class="entypo-chart-bar"></i></div>
            <div class="num" data-start="0" data-end="{{$visitors}}" data-postfix="" data-duration="1500" data-delay="600">0</div>
            <h3>Daily Visitors</h3>
            <p>this is the average value.</p>
        </div>

    </div>

    {{--Report Count--}}
    <div class="clear visible-xs"></div>
    <div class="col-sm-3 col-xs-6">
        <div class="tile-stats tile-aqua">
            <div class="icon"><i class="entypo-mail"></i></div>
            <div class="num" data-start="0" data-end="{{$message}}" data-postfix="" data-duration="1500" data-delay="1200">0</div>
            <h3>New Messages</h3>
            <p>messages per day.</p>
        </div>
    </div>

    <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-blue">
            <div class="icon"><i class="entypo-rss"></i></div>
            <div class="num" data-start="0" data-end="{{$subcriber}}" data-postfix="" data-duration="1500" data-delay="1800">0</div>

            <h3>Subscribers</h3>
            <p>on our site right now.</p>
        </div>

    </div>
</div>
{{--Report Count End--}}




{{--<br />--}}
    {{--<div id="map">My map will go here</div>--}}
{{--<br />--}}



{{--<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>--}}
{{--<script type="text/javascript">--}}

    {{--function myMap() {--}}
        {{--var mapOptions = {--}}
            {{--center: new google.maps.LatLng(51.5, -0.12),--}}
            {{--zoom: 10,--}}
            {{--mapTypeId: google.maps.MapTypeId.HYBRID--}}
        {{--}--}}
        {{--var map = new google.maps.Map(document.getElementById("map"), mapOptions);--}}
    {{--}--}}


{{--</script>--}}



@endsection