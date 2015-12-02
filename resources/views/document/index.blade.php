@extends('layouts.main')

@section('title', 'Documentos / Plantillas')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="col-lg-12">
    <h2>Documentos / Plantillas</h2>
    <br>
    <div class="text-right">
        <a href="/document/create" class="btn btn-info">Crear Documento / Plantilla</a>
    </div>
    <div class="table-responsive" style="margin-top:15px;">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Nombre del documento</th>
                <th>Extensi&oacute;n del archivo</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($documents as $document)
            <tr>
                <td>{{$document->id}}</td>
                <td><a href="/document/{{$document->id}}">{{$document->name}}</a></td>
                <td>{{$document->document_name}}</td>
                <td>{{$document->extension}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--BODY-->
@endsection
