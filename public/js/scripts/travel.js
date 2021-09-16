var table;
var id=0;

var title_modal_data = " Agregar Recorrido";
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    catch_parameters();
    ListDatatable();
    SelectBus();
    SelectOrigen();
    SelectLlegada();
    dateEntry();
    dateExpiration();
});

// datatable catalogos
function ListDatatable()
{
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        //dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'travel_dt'
            
        },
        columns: [
            { data: 'id'},
            { data: 'code'},
            { data: 'user.name'},
            { data: 'bus.placa'},
            { data: 'origen.nombre'},
            { data: 'destino.nombre'},
            { data: 'detalle'},
            { data: 'salida'},
            { data: 'llegada'},
            { data: 'estado',
            "render": function (data, type, row) {
                    if (row.estado === 'ACTIVO') {
                        return '<center><p class="bg-success text-white"><b>ACTIVO</b></p></center>';
                    }
                    else if (row.estado === 'INACTIVO') {          
                        return '<center><p class="bg-warning text-white"><b>INACTIVO</b></p></center>';
                    }
                    else if (row.estado === 'ELIMINADO') {          
                        return '<center><p class="bg-danger text-white"><b>ELIMINADO</b></p></center>';
                    }
                }
            },
            { data: 'Editar',   orderable: false, searchable: false },
            { data: 'Eliminar', orderable: false, searchable: false },
        ],
        buttons: [
            {
                text: '<i class="icon-eye"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Columnas',
                extend: 'colvis'
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-excel"></i>',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Excel',
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            //btn Refresh
            {
                text: '<i class="icon-arrows-cw"></i>',
                className: 'rounded btn-info m-2',
                action: function () {
                    table.ajax.reload();
                }
            }
        ],
    });
};

// guarda los datos nuevos
function Save() {
    $.ajax({
        url: "travel",
        method: 'post',
        data: catch_parameters(),
        
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg);
                console.log(result);

            } else {
                toastr.warning(result.msg);
            }
        },
        error: function (result) {
            console.log(result.responseJSON.message);
            toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
        },
    });
    table.ajax.reload();
}

// captura los datos
function Edit(id) {
    $.ajax({
        url: "travel/{travel}/edit",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            show_data(result);
        },
        error: function (result) {
            toastr.error(result + ' CONTACTE A SU PROVEEDOR POR FAVOR.');

            console.log(result);
        },

    });
};
/// muestra la vista con los datos capturados
var data_old;
function show_data(obj) {
    ClearInputs();
    obj = JSON.parse(obj);
    id= obj.id;
    $("#bus_id").val(obj.bus_id);
    $("#detalle").val(obj.detalle);
    $("#origen_id").val(obj.origen_id);
    $("#destino_id").val(obj.destino_id);
    $("#llegada").val(obj.llegada);
    $("#salida").val(obj.salida);
    if (obj.estado == "ACTIVO") {
        $('#estado_activo').prop('checked', true);
    }
    if (obj.estado == "INACTIVO") {
        $('#estado_inactivo').prop('checked', true);
    }
    $("#title-modal").html("Editar Registro");

    data_old = catch_parameters();

    $('#modal_datos').modal('show');
};

// actualiza los datos
function Update() {
    var data_new = catch_parameters();
    if (data_old != data_new) {
        $.ajax({
            url: "travel/{travel}",
            method: 'put',
            data: catch_parameters(),
            success: function (result) {
                if (result.success) {
                    toastr.success(result.msg);
    
                } else {
                    toastr.warning(result.msg);
                }
            },
            error: function (result) {
                console.log(result.responseJSON.message);
                toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
            },
        });
        table.ajax.reload();
        
    }
}


//funcion para eliminar valor seleccionado
function Delete(id_) {
    id= id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "travel/{travel}",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg);
            } else {
                toastr.warning(result.msg);
            }
        },
        error: function (result) {
            toastr.error(result.msg +' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
    table.ajax.reload();
    $('#modal_eliminar').modal('hide');
});









//////////////////////////////////////////////

// METODOS NECESARIOS
// funcion para volver mayusculas
function Mayus(e) {
    e.value = e.value.toUpperCase();
}

// obtiene los datos del formulario
function catch_parameters()
{
    var data = $(".form-data").serialize();
    data += "&user_id="+user_id;
    data += "&id="+id;
    //console.log(data);
    return data;
    
}

// muestra el modal
$("#btn-agregar").click(function () {
    console.log("arrived");
    ClearInputs();
    $("#title-modal").html(title_modal_data);
    $("#modal_datos").modal("show");
});

// metodo de bootstrap para validar campos

(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('form-data');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                    if (id == 0) {
                        Save();
                    } else {
                        Update();
                    }
                    $('#modal_datos').modal('hide');
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

/// limpi campos despues de utilizar el modal
function ClearInputs() {
    var forms = document.getElementsByClassName('form-data');
    Array.prototype.filter.call(forms, function (form) {
        form.classList.remove('was-validated');
    });
    //__Clean values of inputs
    $("#form-data")[0].reset();
    id=0;
};

function SelectBus() {
    $.ajax({
        url: "/api/list_buses",
        method: 'get',
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label><b>Bus:</b></label>';
            code += '<select class="form-control" name="bus_id" id="bus_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.placa + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_tipo").html(code);
        },
        error: function (result) {
           
            toastr.error(result.msg +' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}
function SelectOrigen() {
    $.ajax({
        url: "/api/list_places",
        method: 'get',
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label><b>Origen:</b></label>';
            code += '<select class="form-control" name="origen_id" id="origen_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.nombre + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_origen").html(code);
        },
        error: function (result) {
           
            toastr.error(result.msg +' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}
function SelectLlegada() {
    $.ajax({
        url: "/api/list_places",
        method: 'get',
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label><b>Destino:</b></label>';
            code += '<select class="form-control" name="destino_id" id="destino_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.nombre + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_llegada").html(code);
        },
        error: function (result) {
           
            toastr.error(result.msg +' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}
//fecha de entrada
function dateEntry() {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD'
    });
}

//fecha de expiracion
function dateExpiration() {
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
    });
}