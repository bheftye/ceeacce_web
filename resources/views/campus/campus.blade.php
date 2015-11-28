@extends('layouts.main')

@section('title', 'Planteles')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<style>
    body{
        background:#;
    }
</style>
<div class="col-lg-12">
    <h2>Plantel</h2>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">Informaci&oacute;n</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            <form method="POST" action="/campus/save">
                {!! csrf_field() !!}
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-building"></i></span>
                    <input class="form-control" disabled placeholder="Nombre" aria-describedby="basic-addon2" type="text" name="name" value="{{$campus->name}}">
                </div>

                <br>

                <div class="form-group">
                    <label>Direcci&oacute;n</label>
                    <textarea class="form-control" disabled rows="3">{{$campus->address}}</textarea>
                </div>

                <input type="submit" value="Guardar" disabled class="pull-right btn-success">

                <input type="button" value="Editar" disabled class="pull-right edit-button btn-warning ">

            </form>
        </div>
    </div>


</div>

<!--BODY-->
@endsection