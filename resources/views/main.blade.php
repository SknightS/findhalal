@include('topbar')

@if(Session::has('message'))
    <br><br><br>
    <p class="alert alert-info" style="text-align: center">{{ Session::get('message') }}</p>
@endif

@yield('content')
<div id="wait" style="display:none;position:absolute;top:40%;left:35%;padding:2px;">
    <img src='{{url('public/images/pleaseWait-1.gif')}}' />
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b><h4 class="modal-title dark profile-title" id="myModalLabel"></h4></b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

            </div>

            <div class="modal-body">


            </div>

        </div>
    </div>
</div>

@include('footer')

