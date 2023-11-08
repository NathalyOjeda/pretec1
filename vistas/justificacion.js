function mostrarJustificacionPermiso() {
    var contenido = dameContenido("paginas/referenciales/justificacion_permiso.php");
    $("#contenido-page").html(contenido);
    cargarTablaJustificacionPermiso();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarJustificacionPermiso() {
    var descripcion = "", activo = "";

    if ($("#id_justificacion_permiso").val() === '0') {

        descripcion = $("#justificacion_permiso_descripcion").val();
        activo = $("#justificacion_permiso_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#justificacion_permiso_descripcion").focus();
            return;

        }

        var lista = {
            'descripcion': descripcion,
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/justificacion_permiso.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/justificacion_permiso.php", "guardar=" + JSON.stringify(lista));
            console.log(r);
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

        descripcion = $('.modal-editar-justificacion_permiso #justificacion_permiso_descripcion').val();
        activo = $('.modal-editar-justificacion_permiso #justificacion_permiso_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-justificacion_permiso #justificacion_permiso_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'id_justificacion_permiso': $("#id_justificacion_permiso").val()
        };


        if ($("#nombre_antiguo_justificacion_permiso").val().trim() !== $(".modal-editar-justificacion_permiso #justificacion_permiso_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/justificacion_permiso.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/justificacion_permiso.php", "actualizar=" + JSON.stringify(lista));
                $("#id_justificacion_permiso").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/justificacion_permiso.php", "actualizar=" + JSON.stringify(lista));
            $("#id_justificacion_permiso").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaJustificacionPermiso();
    limpiarCampoJustificacionPermiso();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaJustificacionPermiso() {
    var lista = ejecutarAjax("controladores/justificacion_permiso.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.jus_per_id}</td>`;
            fila += `<td>${item.just_per_de}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-justificacion_permiso'>Editar</button>
             <button class='btn btn-danger eliminar-justificacion_permiso'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#justificacion_permiso_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoJustificacionPermiso() {

    $("#justificacion_permiso_descripcion").val("");
    $("#justificacion_permiso_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-justificacion_permiso", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/justificacion_permiso.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/justificacion_permiso.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-justificacion_permiso");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-justificacion_permiso #tabla").remove();


        $(".modal-editar-justificacion_permiso #justificacion_permiso_descripcion").val(json_color[0]['just_per_de']);
        $(".modal-editar-justificacion_permiso #justificacion_permiso_estado").val(json_color[0]['estado']);
        $("#id_justificacion_permiso").val(json_color[0]['jus_per_id']);
        $("#nombre_antiguo_justificacion_permiso").val(json_color[0]['just_per_de']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-justificacion_permiso", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/justificacion_permiso.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/justificacion_permiso.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaJustificacionPermiso();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_justificacion_permiso", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/justificacion_permiso.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.jus_per_id}</td>`;
                fila += `<td>${item.just_per_de}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-justificacion_permiso'>Editar</button>
             <button class='btn btn-danger eliminar-justificacion_permiso'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#justificacion_permiso_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaJustificacionPermiso(componente) {
    var lista = ejecutarAjax("controladores/justificacion_permiso.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona una justificación de permiso</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
           fila += `<option value='${item.jus_per_id}'>${item.just_per_de}</option>`;
        });

    }
    $(componente).html(fila);
}