<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}"/>


    <title>RovEverywhere</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-free-5.0.7/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.3.0.min.js"
    integrity="sha256-RTQy8VOmNlT6b2PIRur37p6JEBZUE7o8wPgMvu18MC4="
    crossorigin="anonymous">
    </script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>




        @yield('scripts')

        <style>

          html, body{
            font-size: 15px;
            background-color: #fafaf9;
          }
          .nav.navbar-nav.navbar-left li a, .navbar-brand, .nav.navbar-nav.navbar-right li a{
            color: #429ef4;
          }
        </style>


</head>
<body>
    <div id="">
        <nav class="navbar navbar-fized-top" style="box-shadow: 0px 6px 6px -6px #999">
            <div class="container">
                <div class="navbar-header" style>

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                         RovEverywhere
                    </a>
                    @auth

                      <ul class="nav navbar-nav navbar-left">
                        <li>
                          <a href="/snapshots/index">Snapshots</a>
                        </li>

                        <li>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            Map <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="/map/">Index</a></li>
                            <li><a href="/map/create">Create</a></li>

                          </ul>
                        </li>
                        <li>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            Features <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="/features/rover">Let's Rove</a></li>
                            <li><a href="#">Object Recognition</a></li>
                          </ul>
                        </li>
                      </ul>
                    @endauth
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                      <a href="#">
                                        System
                                      </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include('partials._messages')

        @yield('content')
    </div>



</body>
</html>
