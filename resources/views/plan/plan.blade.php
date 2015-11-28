@extends('layouts.main')

@section('title', 'Planes de Estudio')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="col-lg-12">
    <h2>Planes de Estudio</h2>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">Informaci&oacute;n</a></li>
        <li role="presentation"><a href="#modules" aria-controls="settings" role="tab" data-toggle="tab">Modulos</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            <form method="POST" action="/plan/save">
                {!! csrf_field() !!}
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-folder"></i></span>
                    <input class="form-control" disabled placeholder="Nombre" aria-describedby="basic-addon2" type="text" name="name" value="{{$plan->name}}">
                </div>

                <input type="submit" value="Guardar" disabled class="pull-right btn-success">

                <input type="button" value="Editar" disabled class="pull-right edit-button btn-warning ">

            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="modules">
            @foreach ($plan->modules as $module)
                <h4>{{$module->name}}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Duracion (Semanas)</th>
                            <th>Cr&eacute;ditos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($module->subjects as $subject)
                            <tr>
                                <td>{{$subject->id}}</td>
                                <td>{{$subject->clv}}</td>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->length}}</td>
                                <td>{{$subject->credits}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>


</div>

<!--BODY-->
@endsection