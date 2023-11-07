function mostrarConcepto() {
    var contenido = dameContenido("paginas/referenciales/concepto.php");
    $("#contenido-page").html(contenido);
    cargarTablaConcepto();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarConcepto() {
    var descripcion = "", activo = "";

    if ($("#id_concepto").val() === '0') {

        descripcion = $("#concepto_descripcion").val();
        monto = quitarDecimalesConvertir($("#monto_descripcion").val());
        activo = $("#concepto_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#concepto_descripcion").focus();
            return;

        }

        var lista = {
            'descripcion': descripcion,
            'monto': monto,
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/concepto.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/concepto.php", "guardar=" + JSON.stringify(lista));
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

        descripcion = $('.modal-editar-concepto #concepto_descripcion').val();
        monto = $('.modal-editar-concepto #monto_descripcion').val();
        activo = $('.modal-editar-concepto #concepto_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-concepto #concepto_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'monto': monto,
            'estado': activo,
            'id_concepto': $("#id_concepto").val()
        };


        if ($("#nombre_antiguo_concepto").val().trim() !== $(".modal-editar-concepto #concepto_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/cargo.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/concepto.php", "actualizar=" + JSON.stringify(lista));
                $("#id_concepto").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/concepto.php", "actualizar=" + JSON.stringify(lista));
            $("#id_concepto").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaConcepto();
    limpiarCampoConcepto();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaConcepto() {
    var lista = ejecutarAjax("controladores/concepto.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.id_concepto}</td>`;
            fila += `<td>${item.descripcion}</td>`;
            fila += `<td>${formatearNumero(item.monto)}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-concepto'>Editar</button>
             <button class='btn btn-danger eliminar-concepto'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#concepto_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoConcepto() {

    $("#concepto_descripcion").val("");
    $("#monto_descripcion").val("");
    $("#concepto_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-concepto", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/concepto.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/concepto.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-concepto");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-concepto #tabla").remove();


        $(".modal-editar-concepto #concepto_descripcion").val(json_color[0]['descripcion']);
        $(".modal-editar-concepto #monto_descripcion").val(json_color[0]['monto']);
        $(".modal-editar-concepto #concepto_estado").val(json_color[0]['estado']);
        $("#id_concepto").val(json_color[0]['id_concepto']);
        $("#nombre_antiguo_concepto").val(json_color[0]['descripcion']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-concepto", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/concepto.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/concepto.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaConcepto();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_concepto", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/concepto.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.id_concepto}</td>`;
                fila += `<td>${item.descripcion}</td>`;
                fila += `<td>${item.monto}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-concepto'>Editar</button>
             <button class='btn btn-danger eliminar-concepto'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#concepto_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaConcepto(componente) {
    var lista = ejecutarAjax("controladores/concepto.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona un concepto</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
           fila += `<option value='${item.id_concepto}-${item.monto}'>${item.descripcion}</option>`;
        });

    }
    $(componente).html(fila);
}