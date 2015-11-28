@extends('layouts.login')

@section('title', 'INICIAR SESIÓN')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
   <div class="log-in">
        <p class="login-header">Iniciar Sesi&oacute;n</p>
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">@</span>
                <input class="form-control" placeholder="Email" aria-describedby="basic-addon1" type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key"></i></span>
                <input type="password" name="password"  class="form-control" placeholder="Password" aria-describedby="basic-addon2">
            </div>

            <input type="checkbox" name="remember"> Recuérdame

            <br>

            <input type="submit" value="Entrar" class="pull-right">

            <a href="user/recover">¿Olvidaste la contrase&ntilde;a?</a>
        </form>
   </div>

<!--BODY-->
@endsection
