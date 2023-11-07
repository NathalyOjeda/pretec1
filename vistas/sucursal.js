function mostrarSucursal() {
    var contenido = dameContenido("paginas/referenciales/sucursal.php");
    $("#contenido-page").html(contenido);
    cargarTablaSucursal();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarSucursal() {
    var descripcion = "", activo = "";

    if ($("#id_sucursal").val() === '0') {

        descripcion = $("#sucursal_descripcion").val();
        activo = $("#sucursal_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#sucursal_descripcion").focus();
            return;

        }

        var lista = {
            'descripcion': descripcion,
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/sucursal.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/sucursal.php", "guardar=" + JSON.stringify(lista));
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

        descripcion = $('.modal-editar-sucursal #sucursal_descripcion').val();
        activo = $('.modal-editar-sucursal #sucursal_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-sucursal #sucursal_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'id_sucursal': $("#id_sucursal").val()
        };


        if ($("#nombre_antiguo_sucursal").val().trim() !== $(".modal-editar-sucursal #sucursal_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/sucursal.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/sucursal.php", "actualizar=" + JSON.stringify(lista));
                $("#id_sucursal").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/sucursal.php", "actualizar=" + JSON.stringify(lista));
            $("#id_sucursal").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaSucursal();
    limpiarCampoSucursal();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaSucursal() {
    var lista = ejecutarAjax("controladores/sucursal.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.suc_id}</td>`;
            fila += `<td>${item.suc_descri}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-sucursal'>Editar</button>
             <button class='btn btn-danger eliminar-sucursal'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#sucursal_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoSucursal() {

    $("#sucursal_descripcion").val("");
    $("#sucursal_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-sucursal", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/sucursal.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/sucursal.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-sucursal");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-sucursal #tabla").remove();


        $(".modal-editar-sucursal #sucursal_descripcion").val(json_color[0]['suc_descri']);
        $(".modal-editar-sucursal #sucursal_estado").val(json_color[0]['estado']);
        $("#id_sucursal").val(json_color[0]['suc_id']);
        $("#nombre_antiguo_sucursal").val(json_color[0]['suc_descri']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-sucursal", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/sucursal.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/sucursal.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaSucursal();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_sucursal", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/sucursal.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.suc_id}</td>`;
                fila += `<td>${item.suc_descri}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-sucursal'>Editar</button>
             <button class='btn btn-danger eliminar-sucursal'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#sucursal_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaSucursal(componente) {
    var lista = ejecutarAjax("controladores/sucursal.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona una sucursal</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
           fila += `<option value='${item.suc_id}'>${item.suc_descri}</option>`;
        });

    }
    $(componente).html(fila);
}