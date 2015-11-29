@extends('layouts.main')

@section('title', 'Estudiantes')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="col-lg-12">
    <h2>Estudiantes</h2>
    <div class="row">
        <form class="col-lg-6" action="student/import" method="post" enctype="multipart/form-data" style="display:none;">
            Selecciona el archivo csv.
            <input type="file" name="csv" id="file">
            <br>
            <br>
            <label>Selecciona un plantel</label>
                <select name="campus_id">
                    @foreach($campuses as $campus)
                        <option value="{{$campus->id}}">{{$campus->name}}</option>
                    @endforeach
                </select>
            <br>
            <?php echo csrf_field(); ?>
            <input type="submit" value="Importar" class="btn btn-success">
        </form>
        <form class="col-lg-6" action="/students" method="post">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></span>
                <input type="text" name="search"  class="form-control" placeholder="Buscar estudiante" aria-describedby="basic-addon2">
            </div>
            <br>
            <?php echo csrf_field(); ?>
            <input type="submit" value="Buscar" class="btn btn-success">
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Clave</th>
                <th>Nombre Completo</th>
                <th>Plan de Estudio</th>
                <th>Plantel</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
            <?php
                $campus = \ceeacce\Campus::find($student->campus);
                $plan = \ceeacce\Plan::find($student->plan);
            ?>
            <tr>
                <td>{{$student->id}}</td>
                <td>{{$student->clv}}</td>
                <td><a href="/student/{{$student->id}}">{{$student->last_name_p}} {{$student->last_name_m}} {{$student->name}} </a></td>
                <td>{{$plan->name}}</td>
                <td>{{$campus->name}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {!! $students->render() !!}
        </div>
    </div>
</div>

<!--BODY-->
@endsection
