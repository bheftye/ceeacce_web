@extends('layouts.main')

@section('title', 'Control Escolar')

@section('menu')
@parent
@endsection

@section('content')
<?php
    if(isset($remember)){
        echo 'hello '.$remember;
    }
?>
<!--BODY-->


<!--BODY-->
@endsection
