@extends('layouts.main')

@section('title', 'Documentos / Plantillas')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="col-lg-12">
    <h2>Documentos / Plantillas</h2>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Informaci&oacute;n</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            <form method="POST" action="/document/save" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-folder"></i></span>
                    <input class="form-control" placeholder="Nombre" aria-describedby="basic-addon2" type="text" name="name">
                </div>
                <br>
                Selecciona el archivo csv para importar las calificaciones
                <input type="file" name="document" id="file">
                <br>

                <input type="submit" value="Guardar" class="pull-right btn-success">


            </form>
        </div>
    </div>


</div>

<!--BODY-->
@endsection