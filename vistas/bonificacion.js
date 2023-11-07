function mostrarBonificacion() {
    var contenido = dameContenido("paginas/permisos_descuentos/bonificacion.php");
    $("#contenido-page").html(contenido);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarBonificacion() {
    var contenido = dameContenido("paginas/permisos_descuentos/agregar-bonificacion.php");
    $("#contenido-bonificacion").html(contenido);
    dameFechaActual("fecha_pago_bonificacion");
    dameFechaActual("fecha_nacimiento_hijo");
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarBonificacion() {
    var contenido = dameContenido("paginas/permisos_descuentos/consultar-bonificacion.php");
    $("#contenido-bonificacion").html(contenido);
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
function agregarHijo() {


    if ($("#id_contraro").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }



    if ($("#id_bonificacion").val() === "0") {




        let bonificacion = {

            'con_id': $("#id_contrato").val(),
            'bon_monto': quitarDecimalesConvertir($("#monto").val()),
            'bon_estad': "ACTIVO",
            'bon_cant': $("#total_hijos").val(),
            'bon_fec_pg': $("#fecha_pago_bonificacion").val(),
            'sanc_estado': "ACTIVO"

        };
        let cur = ejecutarAjax("controladores/bonificacion.php",
                "guardar=" + JSON.stringify(bonificacion));

        console.log(cur);
        buscarDatos();

        let det = {
            'bon_id': $("#id_bonificacion").val(),
            'nombre_apellido': $("#nombre_hijo").val(),
            'fecha_nacimiento': $("#fecha_nacimiento_hijo").val(),
            'estado': 1
        };

        let dr = ejecutarAjax("controladores/det_bonificacion.php",
                "guardar=" + JSON.stringify(det));
        console.log(dr);

        buscarDatosBonificacion();

        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

    } else {
        let det = {
            'bon_id': $("#id_bonificacion").val(),
            'nombre_apellido': $("#nombre_hijo").val(),
            'fecha_nacimiento': $("#fecha_nacimiento_hijo").val(),
            'estado': 1
        };

        let dr = ejecutarAjax("controladores/det_bonificacion.php",
                "guardar=" + JSON.stringify(det));
        console.log(dr);
        buscarDatosBonificacion();

        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
    }


}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarBonificacion() {
    $("#cedula_contrato_b").val("");
    $("#bonificaciones_tb").html("");
    $("#nombre_contrato").val("");
    $("#descripcion").val("");
    $("#estado_a").val("1");
    $("#justificacion_lst").val("0");
    dameFechaActual("fecha_bonificacion");
    $("#fecha_bonificacion").attr("min", dameFechaActualSQL());
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarBonificacion() {
    let fecha = $("#fecha_bonificacion").val();
    let motivo = $("#motivo_lst").val();
    if (motivo === "0") {
        mensaje_dialogo_info("Debes seleccionar un motivo", "ATENCION");
        return;
    }
    let repetido = false;
    $("#bonificaciones_tb tr").each(function (evt) {
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
    fila += `<td><button class='btn btn-danger eliminar-bonificacion'><i class="ti ti-trash"></i></button></td>`;
    fila += `</tr>`;
    $("#bonificaciones_tb").append(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".eliminar-bonificacion", function (evt) {
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
function buscarBonificacion() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#bonificacion_tb").html("NO HAY RESULTADOS");
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
        let bonificacion = ejecutarAjax("controladores/bonificacion.php",
                "b_filtros=" + JSON.stringify(filtro));
        if (bonificacion === "0") {
            $("#contrato_tb").html("NO HAY RESULTADOS");
        } else {
            let fila = ``;
            let json_bonificacion = JSON.parse(bonificacion);
            json_bonificacion.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.san_id}</td>`;
                fila += `<td>${item.sanc_fec}</td>`;
                fila += `<td>${item.mot_san}</td>`;
                fila += `<td>${item.sanc_estado}</td>`;
                fila += `<td>
                                <button class='btn btn-danger anular-bonificacion'><i class="ti ti-trash"></i></button>
                            </td>`;
//                fila += `<td>
//                                <button class='btn btn-warning editar-bonificacion'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-danger anular-bonificacion'><i class="ti ti-trash"></i></button>
//                                <button class='btn btn-primary imprimir-bonificacion'><i class="ti ti-printer"></i></button>
//                            </td>`;
                fila += `</tr>`;
            });
            $("#bonificacion_tb").html(fila);
        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-bonificacion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let bonificacion = ejecutarAjax("controladores/bonificacion.php",
            "id=" + id);
    let json_bonificacion = JSON.parse(bonificacion);
    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/permisos_descuentos/agregar-bonificacion.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-bonificacion");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_bonificacion");
    $("#fecha_bonificacion").attr("min", dameFechaActualSQL());
    cargarListaMotivoBonificacion("#motivo_lst");
    $(".actualizar-bonificacion .panel-empleado").attr("hidden", true);
    $(".actualizar-bonificacion #id_bonificacion").val(id);
    $(".actualizar-bonificacion #id_contrato").val(json_bonificacion[0]['con_id']);
    $(".actualizar-bonificacion #fecha_bonificacion").val(json_bonificacion[0]['sanc_fec']);
    $(".actualizar-bonificacion #motivo_lst").val(json_bonificacion[0]['mot_san_id']);
    $(".actualizar-bonificacion #estado_a").val(json_bonificacion[0]['sanc_estado']);
    $(".actualizar-bonificacion #descripcion").val(json_bonificacion[0]['sanc_descri']);
    $("#modal-generico").modal("show");
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".eliminar-hijo", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea eliminar el registro?', function () {


        let cur = ejecutarAjax("controladores/bonificacion.php",
                "eliminar=" + id);
                console.log(cur);
        mensaje_dialogo_info("Eliminado Correctamente", "EXITOSO");
        buscarDatosBonificacion();
        alertify.success('Eliminado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-bonificacion", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/permisos_descuentos/imprimirBonificacion.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("keyup", ".cedula_bonificacion", function (evt) {
    buscarDatosBonificacion();

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function buscarDatosBonificacion() {
    let id = $("#id_contrato").val();

    let id_bon = ejecutarAjax("controladores/bonificacion.php",
            "id_contrato=" + id);
    let sueldo_minimo = 2356000;
    let fila = "";

    if (id_bon === "0") {
        fila = "NO HAY REGISTROS";
    } else {
        let json_bon = JSON.parse(id_bon);
        let cantidad_total = 0;
        let cantidad_boni = 0;
        $("#id_bonificacion").val(json_bon[0]['bon_id']);

        let hijos = ejecutarAjax("controladores/bonificacion.php",
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
