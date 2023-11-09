function mostrarDesvinculacion() {
    var contenido = dameContenido("paginas/permisos_descuentos/desvinculacion.php");
    $("#contenido-page").html(contenido);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarDesvinculacion() {
    var contenido = dameContenido("paginas/permisos_descuentos/agregar-desvinculacion.php");
    $("#contenido-desvinculacion").html(contenido);
    dameFechaActual("fecha_inicio");
    dameFechaActual("fecha_desvinculacion");
    $("#fecha_desvinculacion").attr("min", dameFechaActualSQL());
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarDesvinculacion() {
    var contenido = dameContenido("paginas/permisos_descuentos/consultar-desvinculacion.php");
    $("#contenido-desvinculacion").html(contenido);
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
function guardarDesvinculacion() {


    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }

    console.log($("#id_contrato").val());
    let existe = ejecutarAjax("controladores/desvinculacion.php",
            "id_contrato=" + $("#id_contrato").val());

    console.log(existe);
    if (existe !== "0") {
        mensaje_dialogo_info("El Empleado (" + $("#nombre_contrato").val() + ") ya ha sido desvinculado anteriormente.",
                "ATENCION");
        return;
    }





    let desvinculacion = {

        'con_id': $("#id_contrato").val(),
        'fecha_desvinculacion': $("#fecha_desvinculacion").val(),
        'justiticado': ($("#si").is(":checked")) ? 1 : 0,
        'descripcion': $("#descripcion").val(),
        'total_liquidacion': quitarDecimalesConvertir($("#total").text()),
        'preaviso': quitarDecimalesConvertir($("#preaviso").text()),
        'indemnizacion': quitarDecimalesConvertir($("#indemnizacion").text()),
        'ips': quitarDecimalesConvertir($("#ips").text()),
        'aguinaldo': quitarDecimalesConvertir($("#aguinaldo").text()),
        'salario': quitarDecimalesConvertir($("#salario_dias_trabajados").text()),
        'estado': "ACTIVO"

    };
    let cur = ejecutarAjax("controladores/desvinculacion.php",
            "guardar=" + JSON.stringify(desvinculacion));
    console.log(cur);
    let id = ejecutarAjax("controladores/desvinculacion.php",
            "ultimoID=1");
    console.log(id);



    mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

    alertify.confirm('ANTENCION', 'Desea imprimir la nota de desvinculacion?', function () {
        window.open("paginas/permisos_descuentos/imprimirDesvinculacion.php?id=" + id);

    }
    , function () {
        alertify.error('Operación cancelada');
    });


    limpiarDesvinculacion();


}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarDesvinculacion() {
    $("#cedula_contrato_b").val("");
    $("#desvinculaciones_tb").html("");
    $("#nombre_contrato").val("");
    $("#descripcion").val("");
    $("#estado_a").val("1");
    $("#justificacion_lst").val("0");
    $("#desv").html("");
    dameFechaActual("fecha_desvinculacion");
    $("#fecha_desvinculacion").attr("min", dameFechaActualSQL());
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarDesvinculacion() {
    let fecha = $("#fecha_desvinculacion").val();
    let motivo = $("#motivo_lst").val();
    if (motivo === "0") {
        mensaje_dialogo_info("Debes seleccionar un motivo", "ATENCION");
        return;
    }
    let repetido = false;
    $("#desvinculaciones_tb tr").each(function (evt) {
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
    fila += `<td><button class='btn btn-danger eliminar-desvinculacion'><i class="ti ti-trash"></i></button></td>`;
    fila += `</tr>`;
    $("#desvinculaciones_tb").append(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".eliminar-desvinculacion", function (evt) {
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
function buscarDesvinculacion() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#desvinculacion_tb").html("NO HAY RESULTADOS");
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
        let desvinculacion = ejecutarAjax("controladores/desvinculacion.php",
                "b_filtros=" + JSON.stringify(filtro));
        console.log(desvinculacion);
        if (desvinculacion === "0") {
            $("#contrato_tb").html("NO HAY RESULTADOS");
        } else {
            let fila = ``;
            let json_desvinculacion = JSON.parse(desvinculacion);
            json_desvinculacion.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.id_desvinculacion}</td>`;
                fila += `<td>${item.fecha_desvinculacion}</td>`;
                fila += `<td>${((item.justificado === 1) ? 'SI' : 'NO')}</td>`;
                fila += `<td>${item.descripcion}</td>`;
                fila += `<td>${formatearNumero(item.total_liquidacion)}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
                                <button class='btn btn-danger eliminar-desvinculacion'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-desvinculacion'><i class="ti ti-printer"></i></button>
                            </td>`;
//                fila += `<td>
//                                <button class='btn btn-warning editar-desvinculacion'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-danger anular-desvinculacion'><i class="ti ti-trash"></i></button>
//                                <button class='btn btn-primary imprimir-desvinculacion'><i class="ti ti-printer"></i></button>
//                            </td>`;
                fila += `</tr>`;
            });
            $("#desvinculacion_tb").html(fila);
        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-desvinculacion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let desvinculacion = ejecutarAjax("controladores/desvinculacion.php",
            "id=" + id);
    let json_desvinculacion = JSON.parse(desvinculacion);
    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/permisos_descuentos/agregar-desvinculacion.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-desvinculacion");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_desvinculacion");
    $("#fecha_desvinculacion").attr("min", dameFechaActualSQL());
    cargarListaMotivoDesvinculacion("#motivo_lst");
    $(".actualizar-desvinculacion .panel-empleado").attr("hidden", true);
    $(".actualizar-desvinculacion #id_desvinculacion").val(id);
    $(".actualizar-desvinculacion #id_contrato").val(json_desvinculacion[0]['con_id']);
    $(".actualizar-desvinculacion #fecha_desvinculacion").val(json_desvinculacion[0]['sanc_fec']);
    $(".actualizar-desvinculacion #motivo_lst").val(json_desvinculacion[0]['mot_san_id']);
    $(".actualizar-desvinculacion #estado_a").val(json_desvinculacion[0]['sanc_estado']);
    $(".actualizar-desvinculacion #descripcion").val(json_desvinculacion[0]['sanc_descri']);
    $("#modal-generico").modal("show");
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".eliminar-desvinculacion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea eliminar el registro?', function () {


        let cur = ejecutarAjax("controladores/desvinculacion.php",
                "eliminar=" + id);
        console.log(cur);
        mensaje_dialogo_info("Eliminado Correctamente", "EXITOSO");
        buscarDesvinculacion();
        alertify.success('Eliminado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-desvinculacion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/permisos_descuentos/imprimirDesvinculacion.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("keyup", ".cedula_desvinculacion", function (evt) {
    buscarDatosDesvinculacion();

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function buscarDatosDesvinculacion() {
    let id = $("#id_contrato").val();

    let contrato = ejecutarAjax("controladores/contrato.php", "id=" + id);

    if (contrato === "0") {

    } else {
        let json_contrato = JSON.parse(contrato);
        $("#fecha_inicio").val(json_contrato[0]['con_emis']);
        let inicio = parseInt(json_contrato[0]['con_emis'].split("-")[0]);
        let actual = parseInt($("#fecha_desvinculacion").val().split("-")[0]);
        let antiguedad = actual - inicio;
        $("#antiguedad").val(actual - inicio);
        $("#salario").val(formatearNumero(json_contrato[0]['con_salario']));
        $("#salario_dias_trabajados").text(formatearNumero(json_contrato[0]['con_salario']));
        $("#salario-dia").val(formatearNumero(Math.round(parseInt(json_contrato[0]['con_salario']) / 20)));
        let salario = parseInt(json_contrato[0]['con_salario']);
        let salario_dia = salario / 30;
        $("#trabajado").val(dias_laborales(json_contrato[0]['con_emis'], $("#fecha_desvinculacion").val()));
        $("#indemnizacion").text(formatearNumero(Math.round(salario * 0.26)));
        //calculo de pre aviso
        var pre = ejecutarAjax("controladores/preaviso.php",
                "dame_activo=" + $("#id_contrato").val());
        if (pre === "0") {
            let antiguedad = actual - inicio;
            let dias = 0;
            if (antiguedad <= 1) {
                dias = 30;
            }
            if (antiguedad <= 5 && antiguedad > 1) {
                dias = 45;
            }
            if (antiguedad <= 10 && antiguedad > 5) {
                dias = 60;
            }
            if (antiguedad > 10) {
                dias = 90;
            }
            
            dias = dias / 2;
            
             $("#preaviso").text("-"+formatearNumero(Math.round(salario_dia * dias)));
        }else{
            let json_pre =  JSON.parse(pre);
            let dias = parseInt(json_pre[0]['dias']);
            $("#preaviso").text(formatearNumero(Math.round(salario_dia * dias)));
        }
        
        //aguinaldo
        let salario_mensual = salario / 12;
        $("#aguinaldo").text(formatearNumero(Math.round(salario_mensual * parseInt($("#fecha_desvinculacion").val().split("-")[1]))));
        $("#ips").text(formatearNumero(Math.round(salario * 0.09)));

        calcularTotalesDesvinculacion();


    }
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarDescripcion() {
    if ($("#si").is(":checked")) {
        $(".desvinculacion-des").removeAttr("hidden");
    } else {
        $(".desvinculacion-des").attr("hidden", true);
    }
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("change", "#si, #no", function (evt) {
    mostrarDescripcion();
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function calcularTotalesDesvinculacion() {

    let salario = quitarDecimalesConvertir($("#salario_dias_trabajados").text());
    let preaviso = quitarDecimalesConvertir($("#preaviso").text());
    let indemnizacion = quitarDecimalesConvertir($("#indemnizacion").text());
    let ips = quitarDecimalesConvertir($("#ips").text());
    let aguinaldo = quitarDecimalesConvertir($("#aguinaldo").text());

    $("#subtotal1").text(formatearNumero(salario + indemnizacion + preaviso));
    $("#subtotal2").text(formatearNumero(salario + preaviso - ips + indemnizacion));
    let total = salario + preaviso + indemnizacion - ips + aguinaldo;

    $("#total").text(formatearNumero(total));
}