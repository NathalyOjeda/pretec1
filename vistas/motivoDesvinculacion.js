function mostrarMotivoDesvinculacion() {
    var contenido = dameContenido("paginas/referenciales/motivo_desvinculacion.php");
    $("#contenido-page").html(contenido);
    cargarTablaMotivoDesvinculacion();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarMotivoDesvinculacion() {
    var descripcion = "", activo = "";

    if ($("#id_motivo_desvinculacion").val() === '0') {

        descripcion = $("#motivo_desvinculacion_descripcion").val();
        activo = $("#motivo_desvinculacion_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#motivo_desvinculacion_descripcion").focus();
            return;

        }

        var lista = {
            'descripcion': descripcion,
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/motivo_desvinculacion.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/motivo_desvinculacion.php", "guardar=" + JSON.stringify(lista));
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

        descripcion = $('.modal-editar-motivo_desvinculacion #motivo_desvinculacion_descripcion').val();
        activo = $('.modal-editar-motivo_desvinculacion #motivo_desvinculacion_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-motivo_desvinculacion #motivo_desvinculacion_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'id_motivo_desvinculacion': $("#id_motivo_desvinculacion").val()
        };

        console.log(lista);
        if ($("#nombre_antiguo_motivo_desvinculacion").val().trim() !== $(".modal-editar-motivo_desvinculacion #motivo_desvinculacion_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/motivo_desvinculacion.php", "b_nombre_exacto=" + descripcion.trim());
            console.log(existe);
            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                let r =ejecutarAjax("controladores/motivo_desvinculacion.php", "actualizar=" + JSON.stringify(lista));
                console.log(r);
                        $("#id_motivo_desvinculacion").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/motivo_desvinculacion.php", "actualizar=" + JSON.stringify(lista));
            $("#id_motivo_desvinculacion").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaMotivoDesvinculacion();
    limpiarCampoMotivoDesvinculacion();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaMotivoDesvinculacion() {
    var lista = ejecutarAjax("controladores/motivo_desvinculacion.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.id_motivo_desvinculacion}</td>`;
            fila += `<td>${item.descripcion}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-motivo_desvinculacion'>Editar</button>
             <button class='btn btn-danger eliminar-motivo_desvinculacion'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#motivo_desvinculacion_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoMotivoDesvinculacion() {

    $("#motivo_desvinculacion_descripcion").val("");
    $("#motivo_desvinculacion_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-motivo_desvinculacion", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/motivo_desvinculacion.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/motivo_desvinculacion.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-motivo_desvinculacion");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-motivo_desvinculacion #tabla").remove();


        $(".modal-editar-motivo_desvinculacion #motivo_desvinculacion_descripcion").val(json_color[0]['descripcion']);
        $(".modal-editar-motivo_desvinculacion #motivo_desvinculacion_estado").val(json_color[0]['estado']);
        $("#id_motivo_desvinculacion").val(json_color[0]['id_motivo_desvinculacion']);
        $("#nombre_antiguo_motivo_desvinculacion").val(json_color[0]['descripcion']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-motivo_desvinculacion", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/motivo_desvinculacion.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/motivo_desvinculacion.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaMotivoDesvinculacion();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_motivo_desvinculacion", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/motivo_desvinculacion.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.id_motivo_desvinculacion}</td>`;
                fila += `<td>${item.descripcion}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-motivo_desvinculacion'>Editar</button>
             <button class='btn btn-danger eliminar-motivo_desvinculacion'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#motivo_desvinculacion_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaMotivoDesvinculacion(componente) {
    var lista = ejecutarAjax("controladores/motivo_desvinculacion.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona un motivo</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
           fila += `<option value='${item.id_motivo_desvinculacion}'>${item.descripcion}</option>`;
        });

    }
    $(componente).html(fila);
}