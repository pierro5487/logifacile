<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('css/plugins/morris.css')}}" rel="stylesheet">

    <!-- mon css -->
    <link href="{{asset('css/default.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #333;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        #page-wrapper{
            background-color: #333;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @endif
        </div>
    @endif
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    @include('flash')
                    <div class="col-lg-8 col-lg-offset-2" style="height: 200px">
                    </div>
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="content">
                            <div class="title m-b-md">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Connection</div>
                                                <div class="panel-body">
                                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                                        {{ csrf_field() }}

                                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                            <label for="email" class="col-md-4 control-label">Adresse email</label>

                                                            <div class="col-md-6">
                                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                                @if ($errors->has('email'))
                                                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                                                            <div class="col-md-6">
                                                                <input id="password" type="password" class="form-control" name="password" required>

                                                                @if ($errors->has('password'))
                                                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-8 col-md-offset-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Se connecter
                                                                </button>

                                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                    Mot de passe oublié ?
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>d
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
</div>
</body>
</html>
