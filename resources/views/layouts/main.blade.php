<!DOCTYPE html>
<html>
<head>
    <title>CEEACCE - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('template/css/sb-admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('template/css/plugins/morris.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('img/icon.png') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">



</head>
<body>
<div id="wrapper">
    @section('menu')
        @include('menu')
    @show
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Control Escolar <small>@yield('title')</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-@yield('icon')"></i> @yield('title')
                        </li>
                    </ol>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</div>

    <div class="modal fade" id="modal_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="imgShowProd" style="border:hidden;padding-bottom:25px;">
                                <img class="img-responsive" src="{{ URL::asset('img/logo_ceeac.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
                            <h4 class="titleCart" id="mensaje_contacto"></h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-8 col-lg-offset-4 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:15px;">
                        <button id="button_modal" data-dismiss="modal" class="btn pull-right">Continuar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('template/js/plugins/morris/raphael.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('template/js/plugins/morris/morris.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('template/js/plugins/morris/morris-data.js') }}"></script>

</html>