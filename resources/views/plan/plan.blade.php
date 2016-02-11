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
            <form method="POST" action="/plan/save" id="form-info">
                {!! csrf_field() !!}
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-folder"></i></span>
                    <input class="form-control" disabled placeholder="Nombre" aria-describedby="basic-addon2" type="text" name="name" value="{{$plan->name}}">
                </div>

                <input type="hidden" name="id" value="{{$plan->id}}">

                <input type="submit" value="Guardar" class="pull-right btn-success">

                <input type="button" value="Editar" class="pull-right edit-button btn-warning ">

            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="modules">
            @foreach ($plan->modules as $module)
                <h4>{{$module->name}}</h4>
                <form method="POST" action="/plan/module/update" class="form-grade" data-id="{{$module->id}}">
                    <?php echo csrf_field(); ?>
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
                                    <td><input type="hidden"        name="subjects_ids[]"       value="{{$subject->id}}">{{$subject->id}}</td>
                                    <td><input type="text" disabled name="subjects_clvs[]"      value="{{$subject->clv}}"></td>
                                    <td><input type="text" disabled name="subjects_names[]"     value="{{$subject->name}}"></td>
                                    <td><input type="text" disabled name="subjects_lengths[]"   value="{{$subject->length}}"></td>
                                    <td><input type="text" disabled name="subjects_credits[]"   value="{{$subject->credits}}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <input type="submit" value="Guardar" class="pull-right btn-success">
                        <input type="button" value="Editar" class="pull-right edit-grade-button btn-warning " data-id="{{$module->id}}">
                    </div>
                </form>
            @endforeach
        </div>
    </div>


</div>

<!--BODY-->
@endsection