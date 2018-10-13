<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/cs-skin-elastic.css') }}">
<!-- <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/bootstrap-select.less') }}"> -->
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/scss/style.css') }}">
    <link href="{{ URL::asset('admin/assets/css/lib/vector-map/jqvmap.min.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    @yield('top')
</head>
<body>


<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="{{ URL('admin/images/logo.png') }}" alt="Goal"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{ URL('admin/images/logo2.png') }}" alt="G"></a>
        </div>

        @include('admin.layout.menu')

    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                   aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="{{ URL('admin/images/admin.jpg') }}"
                             alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa- user"></i>Minha Conta</a>

                        <a class="nav-link" href="#"><i class="fa fa- user"></i>Notificações <span
                                    class="count">13</span></a>

                        <a class="nav-link" href="#"><i class="fa fa -cog"></i>Configurações</a>

                        <a class="nav-link" href="http://localhost:8000/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-power -off"></i>Deslogar</a>

                        <form id="logout-form"
                              action="http://localhost:8000/logout"
                              method="POST" style="display: none;">
                            {!! csrf_field() !!}
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">

                        @if (empty($breadcrumbs))
                            <li class="active"><a href="{{ url('/') }}">Dashboard</a></li>
                        @else
                            @foreach($breadcrumbs as $crumb)
                                <li class="{{ $crumb['class'] }}">
                                    <a href="{{ url($crumb['url']) }}">{{ $crumb['name'] }}</a>
                                </li>
                            @endforeach
                            <li><a href="{{ url('/') }}">Dashboard</a></li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content mt-3">
        @yield('page_content')
    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<script src="{{  URL::asset('admin/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="{{  URL::asset('admin/assets/js/plugins.js') }}"></script>
<script src="{{  URL::asset('admin/assets/js/main.js') }}"></script>


{{--<script src="{{  URL::asset('admin/assets/js/lib/chart-js/Chart.bundle.js') }}"></script>--}}
{{--<script src="{{  URL::asset('admin/assets/js/dashboard.js') }}"></script>--}}
{{--<script src="{{  URL::asset('admin/assets/js/widgets.js') }}"></script>--}}
<script src="{{  URL::asset('admin/assets/js/lib/vector-map/jquery.vmap.js') }}"></script>
<script src="{{  URL::asset('admin/assets/js/lib/vector-map/jquery.vmap.min.js') }}"></script>
<script src="{{  URL::asset('admin/assets/js/lib/vector-map/jquery.vmap.sampledata.js') }}"></script>

@yield('botton')
</body>
</html>
