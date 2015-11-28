@extends('layouts.login')

@section('title', 'Registro')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="register">
    <p class="login-header">Registrarse</p>
    <form method="POST" action="/user/register">
        {!! csrf_field() !!}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input class="form-control" placeholder="Email" aria-describedby="basic-addon1" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="input-group">
            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-user"></i></span>
            <input class="form-control" placeholder="Nombre" aria-describedby="basic-addon2" type="text" name="name" value="{{ old('name') }}">
        </div>

        <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-key"></i></span>
            <input type="password" name="password"  class="form-control" placeholder="Password" aria-describedby="basic-addon3">
        </div>

        <input type="checkbox" name="remember"> Recuérdame

        <br>

        <input type="submit" value="Registrarse" class="pull-right">

    </form>
</div>

<!--BODY-->
@endsection
