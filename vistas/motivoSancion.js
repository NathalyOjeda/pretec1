function mostrarMotivoSancion() {
    var contenido = dameContenido("paginas/referenciales/motivo_sancion.php");
    $("#contenido-page").html(contenido);
    cargarTablaMotivoSancion();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarMotivoSancion() {
    var descripcion = "", activo = "";

    if ($("#id_motivo_sancion").val() === '0') {

        descripcion = $("#motivo_sancion_descripcion").val();
        activo = $("#motivo_sancion_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#motivo_sancion_descripcion").focus();
            return;

        }

        var lista = {
            'descripcion': descripcion,
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/motivo_sancion.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/motivo_sancion.php", "guardar=" + JSON.stringify(lista));
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

        descripcion = $('.modal-editar-motivo_sancion #motivo_sancion_descripcion').val();
        activo = $('.modal-editar-motivo_sancion #motivo_sancion_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-motivo_sancion #motivo_sancion_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'id_motivo_sancion': $("#id_motivo_sancion").val()
        };


        if ($("#nombre_antiguo_motivo_sancion").val().trim() !== $(".modal-editar-motivo_sancion #motivo_sancion_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/cargo.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/motivo_sancion.php", "actualizar=" + JSON.stringify(lista));
                $("#id_motivo_sancion").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/motivo_sancion.php", "actualizar=" + JSON.stringify(lista));
            $("#id_motivo_sancion").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaMotivoSancion();
    limpiarCampoMotivoSancion();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaMotivoSancion() {
    var lista = ejecutarAjax("controladores/motivo_sancion.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.mot_san_id}</td>`;
            fila += `<td>${item.mot_san}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-motivo_sancion'>Editar</button>
             <button class='btn btn-danger eliminar-motivo_sancion'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#motivo_sancion_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoMotivoSancion() {

    $("#motivo_sancion_descripcion").val("");
    $("#motivo_sancion_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-motivo_sancion", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/motivo_sancion.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/motivo_sancion.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-motivo_sancion");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-motivo_sancion #tabla").remove();


        $(".modal-editar-motivo_sancion #motivo_sancion_descripcion").val(json_color[0]['mot_san']);
        $(".modal-editar-motivo_sancion #motivo_sancion_estado").val(json_color[0]['estado']);
        $("#id_motivo_sancion").val(json_color[0]['mot_san_id']);
        $("#nombre_antiguo_motivo_sancion").val(json_color[0]['mot_san']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-motivo_sancion", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/motivo_sancion.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/motivo_sancion.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaMotivoSancion();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_motivo_sancion", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/motivo_sancion.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.mot_san_id}</td>`;
                fila += `<td>${item.mot_san}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-motivo_sancion'>Editar</button>
             <button class='btn btn-danger eliminar-motivo_sancion'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#motivo_sancion_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaMotivoSancion(componente) {
    var lista = ejecutarAjax("controladores/motivo_sancion.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona un motivo</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
           fila += `<option value='${item.mot_san_id}'>${item.mot_san}</option>`;
        });

    }
    $(componente).html(fila);
}