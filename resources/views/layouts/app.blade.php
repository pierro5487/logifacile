<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('css/plugins/morris.css')}}" rel="stylesheet">

    <!-- mon css -->
    <link href="{{asset('css/default.css?32')}}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">
    @include('elements/loader/loader_fullpage')
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">Jp Multi service</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
           <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu message-dropdown">
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-footer">
                        <a href="#">Read All New Messages</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
            </li>-->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-connectdevelop"></i> {{ \Illuminate\Support\Facades\Auth::check()? \Illuminate\Support\Facades\Auth::user()->name:'' }} <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <!--<li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>-->
                    <li class="divider"></li>
                    <li class="text-center">
                        <form method="POST" action="/logout">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-power-off"></i>Se déconnecter</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                @if(Session::has('client'))
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>&nbsp;
                        {{Session::get('client.fullName')}}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('clients.choixClient')}}"><i class="fa fa-fw fa-list"></i>Changer</a>
                        </li>
                        <li>
                            <a href="{{route('clients.view',Session::get('client.id'))}}"><i class="fa fa-fw fa-search"></i>Voir Client</a>
                        </li>
                        <li>
                            <a href="{{route('clients.edit',Session::get('client.id'))}}"><i class="fa fa-fw fa-gear"></i>modifier Client</a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="#"><i class="fa fa-fw fa-envelope"></i>Email</a>--}}
                        {{--</li>--}}
                    </ul>
                @else
                    <a href="{{ route('clients.choixClient',['redirect' => 'home']) }}" >
                        <i class="fa fa-user"></i>
                        &nbsp;
                        Choisir un client
                    </a>
                @endif

            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                @include('layouts.nav')
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                @include('flash')
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @yield('title')
                    </h1>
                </div>
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->


<!-- Bootstrap Core JavaScript -->
<script src="{{asset('js/bootstrap.min.js')}}"defer></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"defer></script>
<script src="{{asset('js/bootstrap-datepicker.fr.js')}}"defer></script>
<script src="{{asset('js/defaut.js')}}"></script>

<!-- Morris Charts JavaScript -->
<!--<script src="{{asset('js/plugins/morris/raphael.min.js')}}" defer></script>
<script src="{{asset('js/plugins/morris/morris.min.js')}}" defer></script>
<script src="{{asset('js/plugins/morris/morris-data.js')}}" defer></script>-->

</body>

</html>
