function mostrarJustificacionMovPermiso() {
    var contenido = dameContenido("paginas/personal/justificacion_permiso.php");
    $("#contenido-page").html(contenido);

}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarJustificacionMovPermiso() {
    var contenido = dameContenido("paginas/personal/agregar-justificacion.php");
    $("#contenido-justificacion").html(contenido);
    dameFechaActual("fecha");
    cargarListaJustificacionPermiso("#justificacion_lst");

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarJustificacionMovPermiso() {
    var contenido = dameContenido("paginas/personal/consultar-justificacion.php");
    $("#contenido-justificacion").html(contenido);

}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarJustificacionMovPermiso() {
    var descripcion = "", activo = "";

    if ($("#id_justificacion_permiso").val() === '0') {



        if ($("#id_contrato").val() === "0") {
            mensaje_dialogo_info_ERROR("Debes buscar un empleado por cedula", "ATENCION");
            $("#cedula_b").focus();
            return;

        }
        if ($("#justificacion_lst").val() === "0") {
            mensaje_dialogo_info_ERROR("Debes seleccionar una justificación", "ATENCION");
            return;

        }
        let fileInput = document.getElementById("file");
        console.log(fileInput.files.length);
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const base64PDF = e.target.result.split(',')[1];
//                    console.log("Contenido PDF en Base64: " + base64PDF);
                var lista = {
                    'fecha': $("#fecha").val(),
                    'con_id': $("#id_contrato").val(),
                    'jus_per_id': $("#justificacion_lst").val(),
                    'observacion': $("#descripcion").val(),
                    'file': ($("#file").val().length === 0) ? null : base64PDF,
                    'estado': 1
                };

//                console.log("data:application/pdf;base64," + base64PDF);

                let g = ejecutarAjax("controladores/justificacion.php",
                        "guardar=" + JSON.stringify(lista));
                console.log(g);
//                mostrarPDF( base64PDF);
                mensaje_dialogo_info("Guardado Correctamente", "ATENCION");
                mostrarAgregarJustificacionMovPermiso();

            };

            reader.readAsDataURL(file);
        } else {
            var lista = {
                'fecha': $("#fecha").val(),
                'con_id': $("#id_contrato").val(),
                'jus_per_id': $("#justificacion_lst").val(),
                'observacion': $("#descripcion").val(),
                'file': ($("#file").val().length === 0) ? null : "",
                'estado': 1
            };

//                console.log("data:application/pdf;base64," + base64PDF);

            let g = ejecutarAjax("controladores/justificacion.php",
                    "guardar=" + JSON.stringify(lista));
            console.log(g);
            mensaje_dialogo_info("Guardado Correctamente", "ATENCION");
            mostrarAgregarJustificacionMovPermiso();
        }











    }

//    cargarTablaJustificacionMovPermiso();
//    limpiarCampoJustificacionMovPermiso();
//    $("#modal-generico").modal("hide");


}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoJustificacionMovPermiso() {

    $("#justificacion_permiso_descripcion").val("");
    $("#justificacion_permiso_estado").val("1");

}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-justificacionmov", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/justificacion.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/justificacion_permiso.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaJustificacionMovPermiso();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_mov_justificacion_permiso", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/justificacion.php",
                "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                let b64 = item.file;
                fila += `<tr>`;
                fila += `<td>${item.id_permiso_justif}</td>`;
                fila += `<td>${item.personal}</td>`;
                fila += `<td>${item.cedula}</td>`;
                fila += `<td>${item.fecha}</td>`;
                fila += `<td>${item.just_per_de}</td>`;
                fila += `<td>${item.observacion}</td>`;
                fila += `<td>${(item.file === "null") ? "NO HAY DOCUMENTOS" :
                        `<button class="btn btn-primary" onclick="mostrarPDF(${item.id_permiso_justif}); return false;">Ver</button>`}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
             
             <button class='btn btn-danger eliminar-justificacionmov'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#justificacion_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaJustificacionMovPermiso(componente) {
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
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("keyup", "#cedula_b", function (evt) {
    if (evt.keyCode === 13) {
        if ($(this).val().trim().length === 0) {
            mensaje_dialogo_info_ERROR("Debes ingresar un numero de cedula", "ERROR");
            return;
        }

        let data = ejecutarAjax("controladores/empleado.php", "buscar_cedula=" + $(this).val().trim());


        console.log(data);

        if (data === "0") {
            mensaje_dialogo_info("No se encontro el empleado", "ATENCION");
        } else {
            let json_data = JSON.parse(data);
            $("#nombre_personal").val(json_data[0]['empleado']);
            $("#id_contrato").val(json_data[0]['con_id']);
        }

    } else {

    }
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cancelarJusMov() {
    $("#cedula_b").val("");
    $("#nombre_personal").val("");
    $("#id_contrado").val("0");
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("change", "#documentos", function (evt) {
    if ($('#documentos').is(':checked')) {
        $("#file").remove("readonly");
    } else {
        $("#file").attr("readonly", true);

    }
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarPDF(id) {
    var lista = ejecutarAjax("controladores/justificacion.php",
            "id=" + id);
    console.log(lista);
    var json_lista = JSON.parse(lista);


    var base64PDF = json_lista[0]['file']; // Reemplaza con tu PDF en base64

    // Función para decodificar la cadena base64 y abrir el PDF en una nueva ventana

    // Decodifica la cadena base64
    const binaryData = atob(base64PDF);

    // Convierte la cadena binaria en un array de bytes
    const byteArray = new Uint8Array(binaryData.length);
    for (let i = 0; i < binaryData.length; i++) {
        byteArray[i] = binaryData.charCodeAt(i);
    }

    // Crea un Blob con los datos del PDF
    const blob = new Blob([byteArray], {type: 'application/pdf'});

    // Crea una URL para el Blob
    const pdfUrl = URL.createObjectURL(blob);

    // Abre el PDF en una nueva ventana para imprimirlo
    window.open(pdfUrl);
}