<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="{{url('assets/images/favicon.ico')}}">

    <title> Admin Panel</title>

    <link rel="stylesheet" href="{{url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="{{url('//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">

    <script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>

    <!--[if lt IE 9]><script src="{{url('')}}assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>


<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    @include('sidebar')

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">

                <ul class="user-info pull-left pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{url('assets/images/thumb-1@2x.png')}}" alt="" class="img-circle" width="44" />
                            John Henderson
                        </a>


                    </li>

                </ul>



            </div>


            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                <ul class="list-inline links-list pull-right">

                    <!-- Language Selector -->
                    <li class="dropdown language-selector">

                        Language: &nbsp;
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                            <img src="assets/images/flags/flag-uk.png" width="16" height="16" />
                        </a>

                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="#">
                                    <img src="assets/images/flags/flag-de.png" width="16" height="16" />
                                    <span>Deutsch</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#">
                                    <img src="assets/images/flags/flag-uk.png" width="16" height="16" />
                                    <span>English</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/images/flags/flag-fr.png" width="16" height="16" />
                                    <span>François</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/images/flags/flag-al.png" width="16" height="16" />
                                    <span>Shqip</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/images/flags/flag-es.png" width="16" height="16" />
                                    <span>Español</span>
                                </a>
                            </li>
                        </ul>

                    </li>

                    <li class="sep"></li>


                    <li>
                        <a href="#" data-toggle="chat" data-collapse-sidebar="1">
                            <i class="entypo-chat"></i>
                            Chat

                            <span class="badge badge-success chat-notifications-badge is-hidden">0</span>
                        </a>
                    </li>

                    <li class="sep"></li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                            <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>

            </div>

        </div>

        <hr />

