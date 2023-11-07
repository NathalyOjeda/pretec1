function mostrarIngresos() {
    var contenido = dameContenido("paginas/permisos_descuentos/ingresos.php");
    $("#contenido-page").html(contenido);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarIngresos() {
    var contenido = dameContenido("paginas/permisos_descuentos/agregar-ingresos.php");
    $("#contenido-ingresos").html(contenido);
    dameFechaActual("fecha");
    cargarListaConcepto("#concepto_lst");
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarIngresos() {
    var contenido = dameContenido("paginas/permisos_descuentos/consultar-ingresos.php");
    $("#contenido-ingresos").html(contenido);
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
function agregarIngreso() {

    let fecha = $("#fecha").val();
    let concepto = $("#concepto_lst").val();
    let hora = quitarDecimalesConvertir($("#horas").val());
    let monto = quitarDecimalesConvertir($("#monto").val());
    if (concepto === "0") {
        mensaje_dialogo_info("Debes seleccionar un concepto", "ATENCION");
        return;
    }
    let repetido = false;
    let mensaje = "";
    $("#ingresos_tb tr").each(function (evt) {
        if ($(this).find("td:eq(0)").text() === fecha) {
            repetido = true;
            mensaje = "La fecha ya ha sido registrada anteriormente";
        }
    });

    if (repetido) {
        mensaje_dialogo_info(mensaje, "ATENCION");
        return;
    }

    let fila = "";
    fila += `<tr>`;
    fila += `<td>${$("#concepto_lst").val().split("-")[0]}</td>`;
    fila += `<td>${fecha}</td>`;
    fila += `<td>${$("#concepto_lst option:selected").html()}</td>`;
    fila += `<td>${hora}</td>`;
    fila += `<td>${formatearNumero(monto)}</td>`;
    fila += `<td>${formatearNumero(monto * hora)}</td>`;
    fila += `<td><button class="btn btn-danger eliminar-ingresos"><i class="ti ti-trash"></i></button></td>`;
    fila += `</tr>`;
    $("#ingresos_tb").append(fila);

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarIngresos() {
    $("#cedula_contrato_b").val("");
    $("#ingresos_tb").html("");
    $("#nombre_contrato").val("");
    $("#descripcion").val("");
    $("#estado_a").val("1");
    $("#justificacion_lst").val("0");
    dameFechaActual("fecha_ingresos");
    $("#fecha_ingresos").attr("min", dameFechaActualSQL());
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarIngresos() {
    let fecha = $("#fecha_ingresos").val();
    let motivo = $("#motivo_lst").val();
    if (motivo === "0") {
        mensaje_dialogo_info("Debes seleccionar un motivo", "ATENCION");
        return;
    }
    let repetido = false;
    $("#ingresoses_tb tr").each(function (evt) {
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
    fila += `<td><button class='btn btn-danger eliminar-ingresos'><i class="ti ti-trash"></i></button></td>`;
    fila += `</tr>`;
    $("#ingresoses_tb").append(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".eliminar-ingresos", function (evt) {
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
function buscarIngresos() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#ingreso_tb").html("NO HAY RESULTADOS");
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
        let ingresos = ejecutarAjax("controladores/ingresos.php",
                "b_filtros=" + JSON.stringify(filtro));
                console.log(ingresos);
        if (ingresos === "0") {
            $("#contrato_tb").html("NO HAY RESULTADOS");
        } else {
            let fila = ``;
            let json_ingresos = JSON.parse(ingresos);
            json_ingresos.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.id_ingreso}</td>`;
                fila += `<td>${item.fecha}</td>`;
                fila += `<td>${item.descripcion}</td>`;
                fila += `<td>${item.cantidad_horas}</td>`;
                fila += `<td>${formatearNumero(item.monto)}</td>`;
                fila += `<td>${formatearNumero(item.total)}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
                                <button class='btn btn-danger anular-ingresos'><i class="ti ti-trash"></i></button>
                            </td>`;
//                fila += `<td>
//                                <button class='btn btn-warning editar-ingresos'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-danger anular-ingresos'><i class="ti ti-trash"></i></button>
//                                <button class='btn btn-primary imprimir-ingresos'><i class="ti ti-printer"></i></button>
//                            </td>`;
                fila += `</tr>`;
            });
            $("#ingreso_tb").html(fila);
        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-ingresos", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let ingresos = ejecutarAjax("controladores/ingresos.php",
            "id=" + id);
    let json_ingresos = JSON.parse(ingresos);
    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/permisos_descuentos/agregar-ingresos.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-ingresos");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_ingresos");
    $("#fecha_ingresos").attr("min", dameFechaActualSQL());
    cargarListaMotivoIngresos("#motivo_lst");
    $(".actualizar-ingresos .panel-empleado").attr("hidden", true);
    $(".actualizar-ingresos #id_ingresos").val(id);
    $(".actualizar-ingresos #id_contrato").val(json_ingresos[0]['con_id']);
    $(".actualizar-ingresos #fecha_ingresos").val(json_ingresos[0]['sanc_fec']);
    $(".actualizar-ingresos #motivo_lst").val(json_ingresos[0]['mot_san_id']);
    $(".actualizar-ingresos #estado_a").val(json_ingresos[0]['sanc_estado']);
    $(".actualizar-ingresos #descripcion").val(json_ingresos[0]['sanc_descri']);
    $("#modal-generico").modal("show");
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-ingresos", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/ingresos.php",
                "anular=" + id);
        console.log(cur);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        buscarIngresos();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-ingresos", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/permisos_descuentos/imprimirIngresos.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("keyup", ".cedula_ingresos", function (evt) {
    buscarDatos();

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function buscarDatos() {
    let id = $("#id_contrato").val();

    let id_bon = ejecutarAjax("controladores/ingresos.php",
            "id_contrato=" + id);
    let sueldo_minimo = 2356000;
    let fila = "";

    if (id_bon === "0") {
        fila = "NO HAY REGISTROS";
    } else {
        let json_bon = JSON.parse(id_bon);
        let cantidad_total = 0;
        let cantidad_boni = 0;
        $("#id_ingresos").val(json_bon[0]['bon_id']);

        let hijos = ejecutarAjax("controladores/ingresos.php",
                "id_contrato_hijos=" + id);
        console.log(hijos);
        if (hijos === "0") {
            fila = "NO HAY REGISTROS";
        } else {
            let json_hijos = JSON.parse(hijos);

            json_hijos.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.id_def_bonif}</td>`;
                fila += `<td>${item.nombre_apellido}</td>`;
                fila += `<td>${item.fecha_nacimiento}</td>`;
                fila += `<td>
                            <button class='btn btn-danger eliminar-hijo'><i class="ti ti-trash"></i></button>
                        </td>`;
                fila += `</tr>`;
                //calculo de edad
                cantidad_total++;
                if (parseInt(item.edad) < 18) {
                    cantidad_boni++;
                }
            });

            let monto = (sueldo_minimo * 0.05) * cantidad_boni;
            $("#total_hijos").val(cantidad_total);
            $("#total_hijos_menores").val(cantidad_boni);
            $("#monto").val(formatearNumero(monto));
        }
    }

    $("#hijos_tb").html(fila);
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("change", "#concepto_lst", function (evt) {
    console.log($("#concepto_lst").val());
    if ($("#concepto_lst").val() === "0") {
        $("#monto").val("0");
    } else {
        let precio = quitarDecimalesConvertir($("#concepto_lst").val().split("-")[1]);
        let cantidad = quitarDecimalesConvertir($("#horas").val());
        $("#monto").val(formatearNumero(precio));

    }
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------



//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function guardarIngresos() {
    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes se buscar un personal", "ATENCION");
        return;
    }
    if ($("#ingresos_tb").html().length === 0) {
        mensaje_dialogo_info("No hay datos que guardar", "ATENCION");
        return;
    }

    $("#ingresos_tb tr").each(function (evt) {

        let data = {
            cantidad_horas : $(this).find("td:eq(3)").text(),
            monto : quitarDecimalesConvertir($(this).find("td:eq(4)").text()),
            id_concepto : $(this).find("td:eq(0)").text(),
            con_id : $("#id_contrato").val(),
            fecha : $(this).find("td:eq(1)").text(),
            estado : 1
        };
        
        let r = ejecutarAjax("controladores/ingresos.php",
        "guardar="+JSON.stringify(data));
        console.log(r);
    });
    
    mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
    limpiarIngresos();

}