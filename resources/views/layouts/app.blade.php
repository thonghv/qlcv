<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Compiled and minified JavaScript -->
    <!-- Styles -->
    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Scripts -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <script src="{{url('/js/moment.min.js')}}"></script>
    <script src="{{url('/js/moment-with-locales.min.js')}}"></script>
    <script src="{{url('/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{url('/js/jquery.bpopup.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    {{--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">--}}
    <!-- Styles -->
  <link href="{{url('/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <link href="{{url('/css/style.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a href="{{ url('/todo') }}">
                    <img src="{{url('/img/logo.png')}}" class="img-fluid" alt="Responsive image">
                </a>
            </div>
            <div class="navbar-brand-title">PHẦN MỀM QUẢN LÝ CÔNG VIỆC</div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li><a href="{{ url('/kpi') }}">Báo cáo KPI</a></li>
                        @if (Auth::user()->permission === "ADMIN")
                            <li><a href="{{ url('/register') }}">Đăng ký</a></li>
                        @endif

                        <li>
                            {{--<a href="{{ url('/password/reset') }}"
                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Đổi mật khẩu
                            </a>--}}
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        @yield('content')
    </div>

</div>

<!-- Scripts -->


{{--<script src="{{url('/js/app.js')}}"></script>--}}
<script src="{{url('/js/uploadfile.js')}}"></script>
</body>
</html>
