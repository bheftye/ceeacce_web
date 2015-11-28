@extends('layouts.main')

@section('title', 'Planes de Estudio')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="col-lg-12">
    <h2>Planes de Estudio</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Modulos</th>
                <th>Materias</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($plans as $plan)
                <?php
                    $numModules = $plan->modules->count();
                    $numSubjects = 0;
                    foreach($plan->modules as $module){
                        $numSubjects+= $module->subjects->count();
                    }
                ?>
                <tr>
                    <td>{{$plan->id}}</td>
                    <td><a href="/plan/{{$plan->id}}">{{$plan->name}}</a></td>
                    <td>{{$numModules}}</td>
                    <td>{{$numSubjects}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--BODY-->
@endsection
