@extends('layouts.main')

@section('title', 'Planteles')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="col-lg-12">
    <h2>Planteles</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>No. Estudiantes</th>
                <th>Dirección</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($campuses as $campus)
            <tr>
                <td>{{$campus->id}}</td>
                <td><a href="/campus/{{$campus->id}}">{{$campus->name}}</a></td>
                <td>{{$campus->students->count()}}</td>
                <td>{{$campus->address}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--BODY-->
@endsection