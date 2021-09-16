@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">

                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Bienvenido!</strong> {{ auth()->user()->name }}!.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>



                    @if ($institutional)
                        @foreach ($institutional as $item)

                            <div class="container" style="padding-top: 25px">
                                <div class="row">
                                    <div class="col-sm">
                                        <h1>Misión</h1>
                                        <p><b>Misión :</b>{{ $item->mision }}</p>

                                    </div>
                                    <div class="col-sm">
                                        <h1>Visión</h1>
                                        <p><b>Visión :</b>{{ $item->vision }}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="jumbotron p-10">
                                <h3>Datos</h3>
                                <hr>
                                <p><b>Contacto : </b>{{ $item->contacto }}</p>
                                <p><b>Dirección : </b>{{ $item->direccion }}</p>
                                <p><b>Teléfono : </b>{{ $item->telefono }}</p>
                                <p><b>Web : </b>{{ $item->web }}</p>
                            </div>
                        @endforeach



                    @endif




                </div>
            </div>
        </div>
    @endsection
