function mostrarPerfil() {
    var contenido = dameContenido("paginas/referenciales/perfil.php");
    $("#contenido-page").html(contenido);
    cargarTablaPerfilTodo();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarPerfil() {
    var descripcion = "", activo = "";

    if ($("#id_cargo").val() === '0') {

        descripcion = $("#cargo_descripcion").val();
        activo = $("#cargo_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#cargo_descripcion").focus();
            return;

        }
        //---------------------------------------------------
        if ($("#perfiles_tb").html().trim().length === 0) {
            alert("DEBE INGRESAR EL DETALLE DEL PERFIL");
            $("#cargo_descripcion").focus();
            return;
        }
        //--------------------------------------------------
        var lista = {
            'descripcion': descripcion,
            'salario': $("#cargo_salario").val(),
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/cargo.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/cargo.php", "guardar=" + JSON.stringify(lista));
            console.log(r);

            let id_cabecera_cargo = ejecutarAjax("controladores/cargo.php",
                    "dameUltimoID=1");
            //console.log(id_cabecera_cargo);

            $("#perfiles_tb tr").each(function (evt) {
                if ($(this).find("td:eq(0)").text() === "-") {
                    var lista2 = {
                        'id_cargo': id_cabecera_cargo,
                        'descripcion': $(this).find("td:eq(1)").text(),
                        'estado': 1
                    };

                    let p = ejecutarAjax("controladores/perfil_cargo.php", "guardar_perfil=" + JSON.stringify(lista2));
                    // console.log(p);
                }
            });


            alertify.alert(
                    'INFORMACION',
                    'Guardado correctamente!',
                    function ()
                    {
                        alertify.success('Guardado');
                    });

        } else {
            alertify.alert('WARNING', "El registro ya existe!");
            return;
        }


    } else {

        descripcion = $('.modal-editar-cargo #cargo_descripcion').val();
        activo = $('.modal-editar-cargo #cargo_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-cargo #cargo_descripcion').focus();
            return;

        }



        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'salario': $("#cargo_salario").val(),
            'id_cargo': $("#id_cargo").val()
        };

        console.log($("#nombre_antiguo_cargo").val().trim());
        console.log($(".modal-editar-cargo #cargo_descripcion").val().trim());
        if ($("#nombre_antiguo_cargo").val().trim() !== $(".modal-editar-cargo #cargo_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/cargo.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {

                ejecutarAjax("controladores/cargo.php", "actualizar=" + JSON.stringify(lista));
                $("#id_cargo").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {

            ejecutarAjax("controladores/cargo.php", "actualizar=" + JSON.stringify(lista));
            $("#id_cargo").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }


    cargarTablaPerfil();
    limpiarCampoPerfil();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaPerfilTodo() {
    var lista = ejecutarAjax("controladores/cargo.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.car_id}</td>`;
            fila += `<td>${item.car_descri}</td>`;
            fila += `<td>${formatearNumero(item.salario)}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-perfil'>Modificar Perfiles</button>
             </td>`;
            fila += `</tr>`;
        });

    }
    $("#cargo_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoPerfil() {

    $("#cargo_descripcion").val("");
    $("#cargo_estado").val("1");
    $("#cargo_salario").val("");
    $("#descripcion_perfil").val("");
    $("#perfiles_tb").html("");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-perfil", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    var nombre = $(tr).find("td").filter(":eq(1)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/cargo.php",
            "id=" + id);

//    var perfil = ejecutarAjax("controladores/perfil_cargo.php", "id=" + id);
//    console.log(perfil);
    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/perfil.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-cargo");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".agregar-perfil").removeAttr("hidden");
        $(".modal-editar-cargo #tabla").remove();
        $(".modal-editar-cargo #nombre_seleccionado").val(nombre);
        
        $(".modal-editar-cargo #perfiles_tb");
        $(".modal-editar-cargo #cargo_descripcion").val(json_color[0]['car_descri']);
        $(".modal-editar-cargo #cargo_estado").val(json_color[0]['estado']);
        $(".modal-editar-cargo #cargo_salario").val(json_color[0]['salario']);
        $("#id_cargo").val(json_color[0]['car_id']);
        $("#nombre_antiguo_departamento").val(json_color[0]['car_descri']);
        cargarTablaPerfil();

        $("#modal-generico").modal("show");

    }
});

//-----------------------Funcion eliminar---------------------------
$(document).on("click", ".eliminar-cargo-modal", function (evt) {

    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

    alertify.confirm("ATENCION", 'Desea eliminar el registro?', function () {
        var r = ejecutarAjax("controladores/perfil_cargo.php", "eliminar=" + id);
        console.log(r);

        if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
            var r = ejecutarAjax("controladores/perfil_cargo.php", "desactivar=" + id);
        }
        alertify.success('Eliminado');

        cargarTablaPerfil();
    }, function () {
        alertify.error('Cancelado');
    });
});

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-cargo", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/cargo.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/cargo.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaPerfil();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_cargo", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/cargo.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.car_id}</td>`;
                fila += `<td>${item.car_descri}</td>`;
                fila += `<td>${formatearNumero(item.salario)}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-primary editar-perfil'>Modificar Perfiles</button>
             </td>`;
                fila += `</tr>`;
            });

        }
        $("#cargo_tb").html(fila);
    }

});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaPerfil(componente) {
    var lista = ejecutarAjax("controladores/cargo.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona un cargo</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<option value='${item.car_id}'>${item.car_descri}</option>`;
        });

    }
    $(componente).html(fila);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function agregarPerfilDirecto() {

    if ($(".modal-editar-cargo #descripcion_perfil").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar una descripción para le perfil", "ATENCION");
        return;

    }

    var lista2 = {
        'id_cargo': $("#id_cargo").val(),
        'descripcion': $(".modal-editar-cargo #descripcion_perfil").val(),
        'estado': 1
    };

    let p = ejecutarAjax("controladores/perfil_cargo.php", "guardar_perfil=" + JSON.stringify(lista2));
    
    mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

    cargarTablaPerfil();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".eliminar-item", function (evt) {
    let id = $(this).closest("tr");

    alertify.confirm('ATENCION', 'Desea eliminar el item?', function () {
        $(id).remove();
        alertify.success('Eliminado');
    }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cargarTablaPerfil() {
    var id = $("#id_cargo").val();
    var perfil = ejecutarAjax("controladores/perfil_cargo.php", "id=" + id);

    var fila = "";
    if (perfil === '0') {
        fila = 'No hay registros';
    } else {
        var json_perfil = JSON.parse(perfil);
        json_perfil.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.id_per_carg}</td>`;
            fila += `<td>${item.descripcion}</td>`;
            fila += `<td>
             <button class='btn btn-danger eliminar-cargo-modal'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $(".modal-editar-cargo #perfiles_tb").html(fila);
}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function imprimirPerfiles(){
    
    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
            window.open("paginas/referenciales/imprimirPerfil.php?id=" + $("#id_cargo").val()+"&perfil="+
                    $(".modal-editar-cargo #nombre_seleccionado").val());
        }
        , function () {
            alertify.error('Operación cancelada');
        });
}