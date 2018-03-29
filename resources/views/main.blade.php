@include('topbar')

@if(Session::has('message'))
    <br><br><br>
    <p class="alert alert-info" style="text-align: center">{{ Session::get('message') }}</p>
@endif
@yield('content')

@include('footer')

