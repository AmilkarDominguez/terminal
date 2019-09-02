@extends('layouts.webapp')
@section('title')
INFORMACIÓN
@endsection
@section('content')



<div class="row">
    <div align='center' class="col s12">
        <h5 class="orange-text text-darken-4">Acerca de nosotros</h5>
    </div>
    <div id="informacion" class="col s12">
            
    </div>
</div>
<hr>
<div class="row">
    <div align='center' class="col s12">
        <h5 class="orange-text text-darken-4">Nuestras presentadores</h5>
    </div>


    <div class="col s12" id="programas">

    </div>
    
</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn orange-darken-4" onclick="location.reload();">
        <i class="icon-ccw"></i>
    </a>
</div>

@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Transmision();
    ListarProgramas();
});
function Transmision() {
    $.ajax({
        url: "/api/list_institutional",
        method: 'get',
        success: function (result) {
            var code = '';
            $.each(result, function (key, value) {

            code += '<div class="card">';
            code += '<div class="card-content">';
            code += '<p class="flow-text orange-text text-darken-4">MISIÓN</p>';
            code += '<p>'+value.mision+'</p>';
            code += '<p class="flow-text orange-text text-darken-4">VISIÓN</p>';
            code += '<p>'+value.vision+'</p>';
            code += '<br>';
            code += '<p><b><i class="icon-map-signs"></i>Dirección: </b>'+value.direccion+'</p>';
            code += '<p><b><i class="icon-phone"></i>Teléfono: </b>'+value.telefono+'</p>';
            code += '<p><b><i class="icon-mail"></i>Correo: </b>'+value.email+'</p>';
            code += '</div>';
            code += '<div class="card-action">';
            code += '<a href="googlechrome://'+value.web+'" target="_blank"  class="flow-text orange-text text-darken-4">ver más.</a>';
            code += '</div>';
            code += '</div>';


            });

            $("#informacion").html(code);
        },
        error: function (result) {
            console.log(result);
        },

    });
}
function ListarProgramas() {
    $.ajax({
        url: "/api/list_program",
        method: 'get',
        success: function (result) {
            var code = '';
            $.each(result, function (key, value) {
                code += '<div class="card">';
                code += '<div class="card-image">';
                code += '<img src="'+value.logo+'">';
                code += '</div>';
                code += '<div class="card-content">';
                code += '<p class="flow-text orange-text text-darken-4">'+value.nombre+'</p>';
                code += '<p>'+value.descripcion+'</p>';
                code += '<p><b>Conductor: </b>'+value.presenter.nombre+'</p>';
                code += '<p><b>Auspiciado por: </b>'+value.auspice.nombre+'</p>';
                code += '</div>';
                code += '<div class="card-action">';
                code += '<a href="googlechrome://'+value.link+'" target="_blank"  class="flow-text orange-text text-darken-4">ver más.</a>';
                code += '</div>';
                code += '</div>';
            });

            $("#programas").html(code);
        },
        error: function (result) {
            console.log(result);
        },

    });
}
</script>
@endsection

<!--<p><a href='twitter://user?screen_name=gajotres', target='_system'>Twitter</a></p>-->