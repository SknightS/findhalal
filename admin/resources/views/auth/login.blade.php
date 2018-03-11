<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href={{url('assets/images/favicon.ico')}}">

    <title>Find Halal | Login</title>

    <link rel="stylesheet" href="{{url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">

    <script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>

    <!--[if lt IE 9]><script src="{{url('assets/js/ie8-responsive-file-warning.js')}}"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
    var baseurl = '';
</script>

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">


            <b class="description"> <h1 style="color:white; font-family: Serif;font-size: 50px;">Find Halal</h1></b>

            <!-- progress bar indicator -->
            <div class="login-progressbar-indicator">
                <h3>43%</h3>
                <span>logging in...</span>
            </div>
        </div>

    </div>

    <div class="login-progressbar">
        <div></div>
    </div>

    <div class="login-form">

        <div class="login-content">


            @if ($errors->has('email'))
                <h2 style="color: white;">Invalid login</h2>
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user"></i>
                        </div>

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                    </div>

                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-login"></i>
                        Login In
                    </button>
                </div>



            </form>


            <div class="login-bottom-links">

                <a href="extra-forgot-password.html" class="link">Forgot your password?</a>

                <br />

                <a href="#">ToS</a>  - <a href="#">Privacy Policy</a>

            </div>

        </div>

    </div>

</div>


<!-- Bottom scripts (common) -->
<script src="{{url('assets/js/gsap/TweenMax.min.js')}}"></script>
<script src="{{url('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.js')}}"></script>
<script src="{{url('assets/js/joinable.js')}}"></script>
<script src="{{url('assets/js/resizeable.js')}}"></script>
<script src="{{url('assets/js/neon-api.js')}}"></script>
<script src="{{url('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{url('assets/js/neon-login.js')}}"></script>


<!-- JavaScripts initializations and stuff -->
<script src="{{url('assets/js/neon-custom.js')}}"></script>


<!-- Demo Settings -->
<script src="{{url('assets/js/neon-demo.js')}}"></script>

</body>
</html>