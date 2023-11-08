function mostrarMotivoDescuento() {
    var contenido = dameContenido("paginas/referenciales/motivo_descuento.php");
    $("#contenido-page").html(contenido);
    cargarTablaMotivoDescuento();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarMotivoDescuento() {
    var descripcion = "", activo = "";

    if ($("#id_motivo_descuento").val() === '0') {

        descripcion = $("#motivo_descripcion").val();
        activo = $("#motivo_estado").val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR UNA DESCRIPCION" ,
            "ATENCION");
            $("#motivo_descripcion").focus();
            return;

        }

        var lista = {
            'descripcion': descripcion,
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/motivo_descuento.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/motivo_descuento.php", "guardar=" + JSON.stringify(lista));
//            console.log(r);
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

        descripcion = $('.modal-editar-motivo_descuento #motivo_descripcion').val();
        activo = $('.modal-editar-motivo_descuento #motivo_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-motivo_descuento #motivo_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'des_motiv_id': $("#id_motivo_descuento").val()
        };


        if ($("#nombre_antiguo_motivo").val().trim() !== $(".modal-editar-motivo_descuento #motivo_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/motivo_descuento.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/motivo_descuento.php", "actualizar=" + JSON.stringify(lista));
                $("#id_motivo_descuento").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/motivo_descuento.php", "actualizar=" + JSON.stringify(lista));
            $("#id_motivo_descuento").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaMotivoDescuento();
    limpiarCampoMotivoDescuento();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaMotivoDescuento() {
    var lista = ejecutarAjax("controladores/motivo_descuento.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.des_motiv_id}</td>`;
            fila += `<td>${item.des_mot_desci}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-motivo_descuento'>Editar</button>
             <button class='btn btn-danger eliminar-motivo_descuento'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#motivo_descuento_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoMotivoDescuento() {

    $("#motivo_descripcion").val("");
    $("#motivo_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-motivo_descuento", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);
    
    var registro = ejecutarAjax("controladores/motivo_descuento.php",
            "id=" + id);
    console.log(registro);
    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/motivo_descuento.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-motivo_descuento");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Motivo Descuento");
        $(".modal-editar-motivo_descuento #tabla").remove();


        $(".modal-editar-motivo_descuento #motivo_descripcion").val(json_color[0]['des_mot_desci']);
        $(".modal-editar-motivo_descuento #motivo_estado").val(json_color[0]['estado']);
        $("#id_motivo_descuento").val(json_color[0]['des_motiv_id']);
        $("#nombre_antiguo_motivo").val(json_color[0]['des_mot_desci']);

        $("#modal-generico").modal("show");

    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#motivo_busqueda_nombre", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/motivo_descuento.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.des_motiv_id}</td>`;
            fila += `<td>${item.des_mot_desci}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-motivo_descuento'>Editar</button>
             <button class='btn btn-danger eliminar-motivo_descuento'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

        }
        $("#motivo_descuento_tb").html(fila);
    }

});

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-motivo_descuento", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/motivo_descuento.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/motivo_descuento.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaMotivoDescuento();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaMotivoDescuento(componente) {
    var lista = ejecutarAjax("controladores/motivo_descuento.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona un motivo</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
           fila += `<option value='${item.des_motiv_id}'>${item.des_mot_desci}</option>`;
        });

    }
    $(componente).html(fila);
}