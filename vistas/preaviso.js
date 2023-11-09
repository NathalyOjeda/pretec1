function mostrarPreaviso() {
    var contenido = dameContenido("paginas/referenciales/preaviso.php");
    $("#contenido-page").html(contenido);
    cargarListaMotivoDesvinculacion("#motivo_desvinculacion");
    cargarTablaPreaviso();
    dameFechaActual("desde_preaviso");
    dameFechaActual("hasta");
    $("#desde_preaviso").attr("min", dameFechaActualSQL());
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarPreaviso() {
    var descripcion = "", activo = "";

    if ($("#id_preaviso").val() === '0') {

        descripcion = $("#preaviso_descripcion").val();
        activo = 1;

        if ($("#id_contrato").val() === "0") {
            mensaje_dialogo_info("DEBES SELECCIONAR EMPLEADO", "ATENCION");
            $("#cedula_contrato_b").focus();
            return;

        }
        if ($("#motivo_desvinculacion").val() === "0") {
            mensaje_dialogo_info("DEBES SELECCIONAR UN MOTIVO", "ATENCION");
           
            return;

        }

        var lista = {
            'con_id': $("#id_contrato").val(),
            'id_motivo': $("#motivo_desvinculacion").val(),
            'dias': $("#dias").val(),
            'desde': $("#desde_preaviso").val(),
            'hasta': $("#hasta").val(),
            'tipo': ($("#empresa").prop("checked")) ? "EMPRESA" : "EMPLEADOR",
            'estado': activo
        };

//        var existe = ejecutarAjax("controladores/preaviso.php", "b_nombre_exacto=" + descripcion.trim());
//        if (existe === '0') {
            let r = ejecutarAjax("controladores/preaviso.php", "guardar=" + JSON.stringify(lista));
            console.log(r);
            alertify.alert(
                    'INFORMACION',
                    'Guardado correctamente!',
                    function ()
                    {
                        alertify.success('Guardado');
                    });

//        } else {
//            alertify.alert('WARNING', "El registro ya existe!");
//            return;
//        }





    } else {

        descripcion = $('.modal-editar-preaviso #preaviso_descripcion').val();
        activo = $('.modal-editar-preaviso #preaviso_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-preaviso #preaviso_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'id_preaviso': $("#id_preaviso").val()
        };

        console.log(lista);
        if ($("#nombre_antiguo_preaviso").val().trim() !== $(".modal-editar-preaviso #preaviso_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/preaviso.php", "b_nombre_exacto=" + descripcion.trim());
            console.log(existe);
            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                let r = ejecutarAjax("controladores/preaviso.php", "actualizar=" + JSON.stringify(lista));
                console.log(r);
                $("#id_preaviso").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/preaviso.php", "actualizar=" + JSON.stringify(lista));
            $("#id_preaviso").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaPreaviso();
    limpiarCampoPreaviso();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaPreaviso() {
    var lista = ejecutarAjax("controladores/preaviso.php",
            "dame_todo="+$("#id_contrato").val());

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.id_preaviso}</td>`;
            fila += `<td>${item.motivo}</td>`;
            fila += `<td>${item.dias}</td>`;
            fila += `<td>${item.desde}</td>`;
            fila += `<td>${item.hasta}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td>
             <button class='btn btn-danger eliminar-preaviso'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#preaviso_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoPreaviso() {

    $("#preaviso_descripcion").val("");
    $("#preaviso_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-preaviso", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/preaviso.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/preaviso.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-preaviso");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-preaviso #tabla").remove();


        $(".modal-editar-preaviso #preaviso_descripcion").val(json_color[0]['descripcion']);
        $(".modal-editar-preaviso #preaviso_estado").val(json_color[0]['estado']);
        $("#id_preaviso").val(json_color[0]['id_preaviso']);
        $("#nombre_antiguo_preaviso").val(json_color[0]['descripcion']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-preaviso", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/preaviso.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/preaviso.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaPreaviso();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_preaviso", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/preaviso.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.id_preaviso}</td>`;
                fila += `<td>${item.descripcion}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-preaviso'>Editar</button>
             <button class='btn btn-danger eliminar-preaviso'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#preaviso_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaPreaviso(componente) {
    var lista = ejecutarAjax("controladores/preaviso.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona un motivo</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<option value='${item.id_preaviso}'>${item.descripcion}</option>`;
        });

    }
    $(componente).html(fila);
}


//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", ".cedula_preaviso", function (evt) {
    if ($("#id_contrato").val() !== "0") {
        let contrato = ejecutarAjax("controladores/contrato.php", "id=" + $("#id_contrato").val());

        let json_con = JSON.parse(contrato);

        let inicio = parseInt(json_con[0]['con_emis'].split("-")[0]);
        let actual = parseInt(dameFechaActualSQL().split("-")[0]);
        $("#antiguedad").val((actual - inicio)+" AÑOS");
        let antiguedad =  actual - inicio;
        let dias  = 0;
        if(antiguedad <=1){
            dias = 30;
        }
        if(antiguedad <=5 && antiguedad > 1){
           dias = 45;
        }
        if(antiguedad <=10 && antiguedad > 5){
           dias = 60;
        }
        if(antiguedad > 10){
           dias = 90;
        }
        
        $("#dias").val(dias);
        
        var fecha = new Date($("#desde_preaviso").val());
        
        fecha.setDate(fecha.getDate() + dias);
        
        $("#hasta").val(fecha.toISOString().split('T')[0]);
        cargarTablaPreaviso();
    }
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("change", "#desde_preaviso", function (evt) {
    console.log($("#desde_preaviso").val());
    $(".cedula_preaviso").keyup();
});