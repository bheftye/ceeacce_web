@extends('layouts.main')

@section('title', 'Estudiantes')

@section('menu')
@parent
@endsection

@section('content')
<!--BODY-->
<div class="col-lg-12">
    <h2>Estudiantes</h2>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Informaci&oacute;n</a></li>
        <li role="presentation"><a href="#grades" aria-controls="grades" role="tab" data-toggle="tab">Calificaciones</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            <form method="POST" action="/student/save">
                {!! csrf_field() !!}
                <label>Nombre</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                    <input class="form-control" disabled placeholder="Nombre" aria-describedby="basic-addon1" type="text" name="name" value="{{$student->name}}">
                </div>
                <br>

                <label>Apellido Paterno</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">P</span>
                    <input class="form-control" disabled placeholder="Apellido Pateno" aria-describedby="basic-addon2" type="text" name="last_name_p" value="{{$student->last_name_p}}">
                </div>
                <br>

                <label>Apellido Materno</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">M</span>
                    <input class="form-control" disabled placeholder="Apellido Materno" aria-describedby="basic-addon3" type="text" name="last_name_m" value="{{$student->last_name_m}}">
                </div>
                <br>

                <label>CURP</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4">C</span>
                    <input class="form-control" disabled placeholder="CURP" aria-describedby="basic-addon4" type="text" name="curp" value="{{$student->curp}}">
                </div>
                <br>

                <label>Correo electrónico</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon5">C</span>
                    <input class="form-control" disabled placeholder="Email" aria-describedby="basic-addon5" type="email" name="email" value="{{$student->email}}">
                </div>
                <br>

                <label>Fecha de nacimiento</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon5">C</span>
                    <input class="form-control" disabled placeholder="Email" aria-describedby="basic-addon5" type="text" name="bithday" value="{{$student->birthday}}">
                </div>
                <br>

                <label>Año de inscripción</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon5">C</span>
                    <input class="form-control" disabled placeholder="Año de inscripción" aria-describedby="basic-addon5" type="text" name="year" value="{{$student->year}}">
                </div>
                <br>

                <label>Plan de estudios</label>
                <br>
                <select disabled>
                        <option value="0">Selecciona un plan de estudio</option>
                    @foreach($plans as $plan)
                        <?php
                            $selected = "";
                            if($student->plan == $plan->id){
                                $selected = "selected";
                            }
                        ?>
                        <option vale="{{$plan->id}}" {{$selected}}> {{$plan->name}}</option>
                    @endforeach
                </select>
                <br><br>

                <label>Plantel</label>
                <br>
                <select disabled>
                    <option value="0">Selecciona un plantel</option>
                    @foreach($campuses as $campus)
                    <?php
                    $selected = "";
                    if($student->campus == $campus->id){
                        $selected = "selected";
                    }
                    ?>
                    <option vale="{{$campus->id}}" {{$selected}}> {{$campus->name}}</option>
                    @endforeach
                </select>
                <br>



                <input type="submit" value="Guardar" disabled class="pull-right btn-success">

                <input type="button" value="Editar" disabled class="pull-right edit-button btn-warning ">

            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="grades">
            <form class="col-lg-12" action="/student/import/grades" method="post" enctype="multipart/form-data">
                Selecciona el archivo csv para importar las calificaciones
                <input type="file" name="csv" id="file">
                <br>
                <?php echo csrf_field(); ?>
                <input type="hidden" value="{{$student->plan}}" name="id_plan">
                <input type="hidden" value="{{$student->id}}" name="id_student">
                <input type="submit" value="Importar Calificaciones" class="btn btn-success" style="width:auto;">
            </form>
            <div class="cleafix"></div>
            <?php
                $plan = \ceeacce\Plan::find($student->plan);
            ?>
            @foreach ($plan->modules as $module)
            <h4>{{$module->name}}</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Calificaci&oacute;n</th>
                        <th>Fecha</th>
                        <th>Modalidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($module->subjects as $subject)
                    <?php
                        $grade = \ceeacce\Grade::where(['id_subject'=>$subject->id, "id_student"=>$student->id])->first();
                        $studentGrade = (isset($grade->grade))? $grade->grade:0;
                    ?>
                    <tr>
                        <td><input type="hidden" value="{{$subject->id}}" name="id[]">{{$subject->id}}</td>
                        <td>{{$subject->clv}}</td>
                        <td>{{mb_strtoupper($subject->name)}}</td>
                        <td><input type="text" name="grade[]" value="{{$studentGrade}}" disabled></td>
                        <td><input type="text" name="date_taken[]" value="{{(isset($grade->date_taken))?$grade->date_taken:''}}" disabled></td>
                        <td><input type="text" name="type[]" value="{{(isset($grade->type))?$grade->type:''}}" disabled></td>
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