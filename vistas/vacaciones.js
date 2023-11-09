function mostrarVacaciones() {
    var contenido = dameContenido("paginas/permisos_descuentos/vacaciones.php");
    $("#contenido-page").html(contenido);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarVacaciones() {
    var contenido = dameContenido("paginas/permisos_descuentos/agregar-vacaciones.php");
    $("#contenido-vacaciones").html(contenido);
    dameFechaActual("fecha_ingreso");
    dameFechaActual("fecha_desde_va");
    dameFechaActual("fecha_hasta_va");
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarVacaciones() {
    var contenido = dameContenido("paginas/permisos_descuentos/consultar-vacaciones.php");
    $("#contenido-vacaciones").html(contenido);
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

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//function agregarHijo() {
//
//
//    if ($("#id_contraro").val() === "0") {
//        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
//        return;
//    }
//
//
//
//    if ($("#id_vacaciones").val() === "0") {
//
//
//
//
//        let vacaciones = {
//
//            'con_id': $("#id_contrato").val(),
//            'bon_monto': quitarDecimalesConvertir($("#monto").val()),
//            'bon_estad': "ACTIVO",
//            'bon_cant': $("#total_hijos").val(),
//            'bon_fec_pg': $("#fecha_pago_vacaciones").val(),
//            'sanc_estado': "ACTIVO"
//
//        };
//        let cur = ejecutarAjax("controladores/vacaciones.php",
//                "guardar=" + JSON.stringify(vacaciones));
//
//        console.log(cur);
//        buscarDatos();
//
//        let det = {
//            'bon_id': $("#id_vacaciones").val(),
//            'nombre_apellido': $("#nombre_hijo").val(),
//            'fecha_nacimiento': $("#fecha_nacimiento_hijo").val(),
//            'estado': 1
//        };
//
//        let dr = ejecutarAjax("controladores/det_vacaciones.php",
//                "guardar=" + JSON.stringify(det));
//        console.log(dr);
//
//        buscarDatos();
//
//        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
//
//    } else {
//        let det = {
//            'bon_id': $("#id_vacaciones").val(),
//            'nombre_apellido': $("#nombre_hijo").val(),
//            'fecha_nacimiento': $("#fecha_nacimiento_hijo").val(),
//            'estado': 1
//        };
//
//        let dr = ejecutarAjax("controladores/det_vacaciones.php",
//                "guardar=" + JSON.stringify(det));
//        console.log(dr);
//        buscarDatos();
//
//        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
//    }
//
//
//}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarVacaciones() {
    $("#cedula_contrato_b").val("");
    $("#vacacioneses_tb").html("");
    $("#nombre_contrato").val("");
    $("#descripcion").val("");
    $("#estado_a").val("1");
    $("#justificacion_lst").val("0");
    dameFechaActual("fecha_vacaciones");
    $("#fecha_vacaciones").attr("min", dameFechaActualSQL());
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarVacaciones() {
    let fecha = $("#fecha_vacaciones").val();
    let motivo = $("#motivo_lst").val();
    if (motivo === "0") {
        mensaje_dialogo_info("Debes seleccionar un motivo", "ATENCION");
        return;
    }
    let repetido = false;
    $("#vacacioneses_tb tr").each(function (evt) {
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
    fila += `<td><button class='btn btn-danger eliminar-vacaciones'><i class="ti ti-trash"></i></button></td>`;
    fila += `</tr>`;
    $("#vacacioneses_tb").append(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".eliminar-vacaciones", function (evt) {
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
function buscarVacaciones() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#vacaciones_tb").html("NO HAY RESULTADOS");
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
        let vacaciones = ejecutarAjax("controladores/vacaciones.php",
                "b_filtros=" + JSON.stringify(filtro));
        if (vacaciones === "0") {
            $("#vacacion_tb").html("NO HAY RESULTADOS");
        } else {
            let fila = ``;
            let json_vacaciones = JSON.parse(vacaciones);
            json_vacaciones.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.vac_id}</td>`;
                fila += `<td>${item.vac_salida}</td>`;
                fila += `<td>${item.vac_fin}</td>`;
                fila += `<td>${item.vac_dias}</td>`;
                fila += `<td>${item.vac_estado}</td>`;
                fila += `<td>
                                <button class='btn btn-success confirmar-vacaciones'>Confirmar</button>
                                <button class='btn btn-danger cancelar-vacaciones'>Cancelar</button>
                            </td>`;
//                fila += `<td>
//                                <button class='btn btn-warning editar-vacaciones'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-danger anular-vacaciones'><i class="ti ti-trash"></i></button>
//                                <button class='btn btn-primary imprimir-vacaciones'><i class="ti ti-printer"></i></button>
//                            </td>`;
                fila += `</tr>`;
            });
            $("#vacacion_tb").html(fila);
        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-vacaciones", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let vacaciones = ejecutarAjax("controladores/vacaciones.php",
            "id=" + id);
    let json_vacaciones = JSON.parse(vacaciones);
    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/permisos_descuentos/agregar-vacaciones.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-vacaciones");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_vacaciones");
    $("#fecha_vacaciones").attr("min", dameFechaActualSQL());
    cargarListaMotivoVacaciones("#motivo_lst");
    $(".actualizar-vacaciones .panel-empleado").attr("hidden", true);
    $(".actualizar-vacaciones #id_vacaciones").val(id);
    $(".actualizar-vacaciones #id_contrato").val(json_vacaciones[0]['con_id']);
    $(".actualizar-vacaciones #fecha_vacaciones").val(json_vacaciones[0]['sanc_fec']);
    $(".actualizar-vacaciones #motivo_lst").val(json_vacaciones[0]['mot_san_id']);
    $(".actualizar-vacaciones #estado_a").val(json_vacaciones[0]['sanc_estado']);
    $(".actualizar-vacaciones #descripcion").val(json_vacaciones[0]['sanc_descri']);
    $("#modal-generico").modal("show");
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".cancelar-solicitud", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    if ($(this).closest("tr").find("td").filter(":eq(4)").text() === "CONFIRMADO") {
        mensaje_dialogo_info("No puedes cancelar una solicitud Confirmada", "ATENCIO");
        return;
    }

    alertify.confirm('ANTENCION', 'Desea cancelar la solicitud?', function () {

        let data = {
            'estado': 'CANCELADO',
            'id': id

        };
        let cur = ejecutarAjax("controladores/vacaciones.php",
                "cambiar_estado=" + JSON.stringify(data));
        console.log(cur);
        mensaje_dialogo_info("Cancelado Correctamente", "EXITOSO");
        cargarSolicitudes();
        buscarVacaciones();
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".confirmar-vacaciones", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    

    alertify.confirm('ANTENCION', 'Desea confirmar la solicitud?', function () {

        let data = {
            'estado': 'CONFIRMADO',
            'id': id

        };
        let cur = ejecutarAjax("controladores/vacaciones.php",
                "cambiar_estado=" + JSON.stringify(data));
        console.log(cur);
        mensaje_dialogo_info("Confirmado Correctamente", "EXITOSO");
        buscarVacaciones();
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-vacaciones", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/permisos_descuentos/imprimirVacaciones.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("keyup", ".cedula_vacaciones", function (evt) {
    buscarDatosVacaciones();

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function buscarDatosVacaciones() {
    let id = $("#id_contrato").val();

    let contrato = ejecutarAjax("controladores/contrato.php",
            "id=" + id);

    if (contrato === "0") {

    } else {
        let json_contrato = JSON.parse(contrato);
        $("#fecha_ingreso").val(json_contrato[0]['con_emis']);
        let anio = parseInt(json_contrato[0]['con_emis'].split("-")[0]);
        let actual = parseInt(dameFechaActualSQL().split("-")[0]);
        $("#periodo").val(anio + "-" + actual);
        $("#departanento").val(json_contrato[0]['dep_descri']);
        $("#antiguedad").val((actual - anio) + " AÑOS");
        let correspondiente = ((actual - anio) >= 2) ? 24 : 12;
        $("#dias_correspondientes").val(correspondiente);

        let vacaciones = parseInt(ejecutarAjax("controladores/vacaciones.php",
                "dias=" + id));
                

        $("#dias_pendientes").val(correspondiente - vacaciones);

        console.log(vacaciones);
        console.log(dias_laborales_va());


        $("#dias_seleccionados").val(dias_laborales_va());

        cargarSolicitudes();



    }


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarSolicitudes() {
    //cargamos las solicitudes enviadas completas
    let id = $("#id_contrato").val();
    let listado = ejecutarAjax("controladores/vacaciones.php",
            "id_contrato=" + id);
    console.log(listado);
    if (listado === "0") {
        $("#vacaciones_tb").html("NO HAY REGISTROS");
    } else {
        let json_vacaciones = JSON.parse(listado);
        let fila = "";
        json_vacaciones.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.vac_id}</td>`;
            fila += `<td>${item.vac_salida}</td>`;
            fila += `<td>${item.vac_fin}</td>`;
            fila += `<td>${item.vac_dias}</td>`;
            fila += `<td>${item.vac_estado}</td>`;
            fila += `<td><button class='btn btn-danger cancelar-solicitud'>Cancelar solicitud</button></td>`;
            fila += `</tr>`;
        });

        $("#vacaciones_tb").html(fila);
    }
}


//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function dias_laborales_va() {
    var fecha1 = document.getElementById("fecha_desde_va").value;
    var diafecha1 = fecha1.split("-")[2];
    var mesfecha1 = parseInt(fecha1.split("-")[1]) - 1;
    var añofecha1 = fecha1.split("-")[0];
    var fechaconversion1 = new Date(añofecha1, mesfecha1, diafecha1);
    var fecha2 = document.getElementById("fecha_hasta_va").value;
    var diafecha2 = fecha2.split("-")[2];
    var mesfecha2 = parseInt(fecha2.split("-")[1]) - 1;
    var añofecha2 = fecha2.split("-")[0];
    var fechaconversion2 = new Date(añofecha2, mesfecha2, diafecha2);
    var diferencia = fechaconversion2.getTime() - fechaconversion1.getTime();
    var cantidaddias = Math.floor(diferencia / (1000 * 24 * 60 * 60)) + 1;

    console.log(fecha1);
    console.log(fecha2);
    var fecha3 = fechaconversion1;
    fecha3.setDate(fecha3.getDate() - 1);
    var nolaboral = 0;
    for (var i = 0; i < cantidaddias; i++) {
        fecha3.setDate(fecha3.getDate() + 1);
        var diasemana = fecha3.getDay();

        if (diasemana == 0 || diasemana == 6) {
            nolaboral++;
        }
    }

    var cantidadlaborales = cantidaddias - nolaboral;
    return cantidadlaborales;


}
function dias_laborales(desde, hasta) {
    var fecha1 = desde;
    var diafecha1 = fecha1.split("-")[2];
    var mesfecha1 = parseInt(fecha1.split("-")[1]) - 1;
    var añofecha1 = fecha1.split("-")[0];
    var fechaconversion1 = new Date(añofecha1, mesfecha1, diafecha1);
    var fecha2 = hasta;
    var diafecha2 = fecha2.split("-")[2];
    var mesfecha2 = parseInt(fecha2.split("-")[1]) - 1;
    var añofecha2 = fecha2.split("-")[0];
    var fechaconversion2 = new Date(añofecha2, mesfecha2, diafecha2);
    var diferencia = fechaconversion2.getTime() - fechaconversion1.getTime();
    var cantidaddias = Math.floor(diferencia / (1000 * 24 * 60 * 60)) + 1;

    console.log(fecha1);
    console.log(fecha2);
    var fecha3 = fechaconversion1;
    fecha3.setDate(fecha3.getDate() - 1);
    var nolaboral = 0;
    for (var i = 0; i < cantidaddias; i++) {
        fecha3.setDate(fecha3.getDate() + 1);
        var diasemana = fecha3.getDay();

        if (diasemana == 0 || diasemana == 6) {
            nolaboral++;
        }
    }

    var cantidadlaborales = cantidaddias - nolaboral;
    return cantidadlaborales;


}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("change", "#fecha_desde_va, #fecha_hasta_va", function (evt) {
    if ($("#fecha_desde").val() > $("#fecha_hasta").val()) {
        mensaje_dialogo_info("El dia de salida no puede ser mayor al de fin");

    } else {

        $("#dias_seleccionados").val(dias_laborales_va());
    }
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function enviarSolicitud() {
    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un funcionario.", "ATENCION");
        return;
    }
    if ($("#dias_seleccionados").val() === "0") {
        mensaje_dialogo_info("No hay dias seleccionados", "ATENCION");
        return;
    }


    if ($("#fecha_desde").val() > $("#fecha_hasta").val()) {
        mensaje_dialogo_info("El dia de salida no puede ser mayor al de fin");
        return;
    }

    let dias = parseInt($("#dias_seleccionados").val());
    let pendientes = $("#dias_pendientes").val();



    if ((pendientes - dias) < 0) {
        mensaje_dialogo_info("Los dias seleccionados superan a los dias pendientes", "ATENCION");
        return;
    }

    let data = {
        'vac_dias': dias,
        'vac_salida': $("#fecha_desde_va").val(),
        'vac_fin': $("#fecha_hasta_va").val(),
        'vac_estado': 'PENDIENTE',
        'con_id': $("#id_contrato").val()

    };

    let r = ejecutarAjax("controladores/vacaciones.php",
            "guardar=" + JSON.stringify(data));

    console.log(r);

    mensaje_dialogo_info("Enviado correctamente.", "ENVIADO");

    cargarSolicitudes();

    dameFechaActual("fecha_desde");
    dameFechaActual("fecha_hasta");
    $("#dias_seleccionados").val("0");
}
