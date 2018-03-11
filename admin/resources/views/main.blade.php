
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
    <link type="stylesheet" href="{{url('assets/css/bootstrap-timepicker.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/font-icons/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>

    <!--[if lt IE 9]--><script src="{{url('')}}assets/js/ie8-responsive-file-warning.js"></script><!--[endif]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style>
        body{
            font-size: 15px;
        }
        .invalid-feedback{
            color: red !important;
        }

    </style>
@include('topbar')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <![endif]-->


</head>


<body class="page-body  page-fade" data-url="http://neon.dev">



@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

@yield('content')


@yield('foot-js')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@include('footer')
