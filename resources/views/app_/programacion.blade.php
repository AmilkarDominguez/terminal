@extends('layouts.webapp')
@section('title')
PROGRAMACIÓN
@endsection
@section('content')



<div class="row">
    <div align='center' class="col s12">
        <h5 class="orange-text text-darken-4">Transmisión en vivo</h5>
    </div>
    <div id="transmision"  class="col s12">
            
    </div>
</div>
<hr>
<div class="row">
    <div align='center' class="col s12">
        <h5 class="orange-text text-darken-4">Nuestra programación</h5>
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
                code += value.transmision;
            });

            $("#transmision").html(code);
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