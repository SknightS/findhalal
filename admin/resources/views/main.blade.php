@include('topbar')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

@yield('content')


@yield('foot-js')


@include('footer')
