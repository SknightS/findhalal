@include('topbar')

@if(Session::has('message'))
    <br><br><br>
    <p class="alert alert-info" style="text-align: center">{{ Session::get('message') }}</p>
@endif

@yield('content')
<div id="wait" style="display:none;position:absolute;top:40%;left:35%;padding:2px;">
    <img src='{{url('public/images/pleaseWait-1.gif')}}' />
</div>

@include('footer')

