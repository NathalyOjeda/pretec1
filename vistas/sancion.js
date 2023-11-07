function mostrarSancion() {
    var contenido = dameContenido("paginas/permisos_descuentos/sancion.php");
    $("#contenido-page").html(contenido);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarSancion() {
    var contenido = dameContenido("paginas/permisos_descuentos/agregar-sancion.php");
    $("#contenido-sancion").html(contenido);
    dameFechaActual("fecha_sancion");
    $("#fecha_sancion").attr("min", dameFechaActualSQL());
    cargarListaMotivoSancion("#motivo_lst");
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarSancion() {
    var contenido = dameContenido("paginas/permisos_descuentos/consultar-sancion.php");
    $("#contenido-sancion").html(contenido);
    dameFechaActual("desde");
    dameFechaActual("hasta");
}


//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarBusqueda() {
    $("#cedula_contrato_b").val("");
    $("#nombre_contrato").val("");
    $("#id_contrato").val("0");
    $("#cedula_contrato_b").focus();
}
//$(document).on("keyup", "#nombre_busqueda_sancion", function (evt) {
    // agregar ajax 

//}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarSancion() {


    if ($("#id_contraro").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }
    if ($("#sanciones_tb").html().length === 0) {
        mensaje_dialogo_info("Debes ingresar por lo menos un motivo de sancion en la grilla", "ATENCION");
        return;
    }


   
    





    if ($("#id_sancion").val() === "0") {



        $("#sanciones_tb tr").each(function (evt) {

            let sancion = {

                'con_id': $("#id_contrato").val(),
                'mot_san_id': $(this).find("td:eq(0)").text(),
                'sanc_descri': "",
                'sanc_fec': $(this).find("td:eq(1)").text(),
                'sanc_estado': "ACTIVO"

            };
            let cur = ejecutarAjax("controladores/sancion.php",
                    "guardar=" + JSON.stringify(sancion));
        });
//        let id = ejecutarAjax("controladores/sancion.php",
//                "ultimoID=1");
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
//
//        alertify.confirm('ANTENCION', 'Desea imprimir la sanción?', function () {
//            window.open("paginas/permisos_descuentos/imprimirSancion.php?id=" + id);


    } else {
        let sancion = {

            'san_id': $("#id_sancion").val(),
            'con_id': $("#id_contrato").val(),
            'mot_san_id': $("#motivo_lst").val(),
            'sanc_descri': $("#descripcion").val(),
            'sanc_fec': $("#fecha_sancion").val(),
            'sanc_estado': "ACTIVO"

        };
        let cur = ejecutarAjax("controladores/sancion.php",
                "actualizar=" + JSON.stringify(sancion));
        console.log(cur);
        $(".actualizar-sancion #id_contrato").val("0");
        $("#id_sancion").val("0");
        $("#modal-generico").modal("hide");
        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        buscarSancion();
    }

//    console.log(cur);
    limpiarSancion();
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarSancion() {
    $("#cedula_contrato_b").val("");
    $("#sanciones_tb").html("");
    $("#nombre_contrato").val("");
    $("#descripcion").val("");
    $("#estado_a").val("1");
    $("#justificacion_lst").val("0");
    dameFechaActual("fecha_sancion");
    $("#fecha_sancion").attr("min", dameFechaActualSQL());
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarSancion() {
    let fecha = $("#fecha_sancion").val();
    let motivo = $("#motivo_lst").val();
    if (motivo === "0") {
        mensaje_dialogo_info("Debes seleccionar un motivo", "ATENCION");
        return;
    }
    let repetido = false;
    $("#sanciones_tb tr").each(function (evt) {
        if (fecha === $(this).find("td:eq(1)").text() &&
                motivo === $(this).find("td:eq(0)").text()) {
            repetido = true;
        }
    });
    if (repetido) {
        mensaje_dialogo_info("El registro ya ha sido agregado a la grilla", "ATENCION");
        return;
    }

    

    let fila = "";
    fila += `<tr>`;
    fila += `<td>${motivo}</td>`;
    fila += `<td>${fecha}</td>`;
    fila += `<td>${$("#motivo_lst option:selected").html()}</td>`;
    fila += `<td><button class='btn btn-danger eliminar-sancion'><i class="ti ti-trash"></i></button></td>`;
    fila += `</tr>`;
    $("#sanciones_tb").append(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".eliminar-sancion", function (evt) {
    let tr = $(this).closest("tr");
    alertify.confirm('ATENCION', 'Desea eliminar el registro? ', function () {
        $(tr).remove();
        alertify.success("Eliminado");
    }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarSancion() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#sancion_tb").html("NO HAY RESULTADOS");
    } else {
        let fecha_desde = $("#desde").val();
        let fecha_hasta = $("#hasta").val();
        if ($("#id_contrato").val() === "0") {
            mensaje_dialogo_info("Debes buscar un empleado",
                    "ATENCION");
            return;
        }

        if (fecha_desde > fecha_hasta) {
            mensaje_dialogo_info("Verifica el periodo de fecha",
                    "ATENCION");
            return;
        }

        let filtro = {
            'id_contrato': $("#id_contrato").val(),
            'desde': fecha_desde,
            'hasta': fecha_hasta
        };
        let sancion = ejecutarAjax("controladores/sancion.php",
                "b_filtros=" + JSON.stringify(filtro));
        if (sancion === "0") {
            $("#contrato_tb").html("NO HAY RESULTADOS");
        } else {
            let fila = ``;
            let json_sancion = JSON.parse(sancion);
            json_sancion.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.san_id}</td>`;
                fila += `<td>${item.sanc_fec}</td>`;
                fila += `<td>${item.mot_san}</td>`;
                fila += `<td>${item.sanc_estado}</td>`;
                fila += `<td>
                                <button class='btn btn-danger anular-sancion'><i class="ti ti-trash"></i></button>
                            </td>`;
//                fila += `<td>
//                                <button class='btn btn-warning editar-sancion'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-danger anular-sancion'><i class="ti ti-trash"></i></button>
//                                <button class='btn btn-primary imprimir-sancion'><i class="ti ti-printer"></i></button>
//                            </td>`;
                fila += `</tr>`;
            });
            $("#sancion_tb").html(fila);
        }

    }
}







//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-sancion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let sancion = ejecutarAjax("controladores/sancion.php",
            "id=" + id);
    let json_sancion = JSON.parse(sancion);
    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/permisos_descuentos/agregar-sancion.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-sancion");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_sancion");
    $("#fecha_sancion").attr("min", dameFechaActualSQL());
    cargarListaMotivoSancion("#motivo_lst");
    $(".actualizar-sancion .panel-empleado").attr("hidden", true);
    $(".actualizar-sancion #id_sancion").val(id);
    $(".actualizar-sancion #id_contrato").val(json_sancion[0]['con_id']);
    $(".actualizar-sancion #fecha_sancion").val(json_sancion[0]['sanc_fec']);
    $(".actualizar-sancion #motivo_lst").val(json_sancion[0]['mot_san_id']);
    $(".actualizar-sancion #estado_a").val(json_sancion[0]['sanc_estado']);
    $(".actualizar-sancion #descripcion").val(json_sancion[0]['sanc_descri']);
    $("#modal-generico").modal("show");
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-sancion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/sancion.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        buscarSancion();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-sancion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/permisos_descuentos/imprimirSancion.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
