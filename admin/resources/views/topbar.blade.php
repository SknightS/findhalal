
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    @include('sidebar')

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">

                {{--<ul class="user-info pull-left pull-none-xsm">--}}

                    {{--<!-- Profile Info -->--}}
                    {{--<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->--}}

                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<img src="{{url('assets/images/userImage.png')}}" alt="" class="img-circle" width="44" />--}}
                            {{--{{ Auth::user()->firstName}}--}}
                        {{--</a>--}}


                    {{--</li>--}}

                {{--</ul>--}}



            </div>


            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix ">

                <ul class="list-inline links-list pull-right">

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{--{{ Auth::user()->fkuserTypeId }} --}}
                            <img src="{{url('assets/images/userImage.png')}}" alt="" class="img-circle" width="40" />
                            {{ Auth::user()->firstName}}
                            <span class="caret"></span>
                        </a>
                        <div style="min-width:100px " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <i class="entypo-logout left"></i>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>

                    {{--<li>--}}
                        {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                           {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                            {{--Logout--}}
                        {{--</a>--}}

                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                            {{--@csrf--}}
                        {{--</form>--}}

                            {{--<i class="entypo-logout right"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>

            </div>

        </div>

        <hr />

