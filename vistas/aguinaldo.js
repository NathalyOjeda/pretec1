//CAMBIOS PARA LUCERO

function mostrarAguinaldo() {
    var contenido = dameContenido("paginas/planillas/aguinaldo.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarAguinaldo() {
    var contenido = dameContenido("paginas/planillas/agregar-aguinaldo.php");
    $("#contenido-aguinaldo").html(contenido);




}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarAguinaldo() {
    var contenido = dameContenido("paginas/planillas/consultar-aguinaldo.php");
    $("#contenido-aguinaldo").html(contenido);
    grillaAguinaldo();
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------

function mostrarGenerarPlanillaAguinaldo() {
    var contenido = dameContenido("paginas/planillas/generar-planilla-aguinaldo.php");
    $("#contenido-aguinaldo").html(contenido);
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarBusquedaIPS() {
    $("#cedula_contrato_b").val("");
    $("#nombre_contrato").val("");
    $("#salario").val("");
    $("#aporte").val("");
    $("#estado_a").val("ACTIVO");
    $("#id_contrato").val("0");
    $("#cedula_contrato_b").focus();



}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#cedula_contrato_a", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#cedula_contrato_a").val().trim().length === 0) {
            mensaje_dialogo_info("Debes ingresar un número de cédula válido",
                    "ATENCION");
        } else {
            let funcionario = ejecutarAjax("controladores/contrato.php",
                    "b_cedula=" + $("#cedula_contrato_a").val());
            if (funcionario === "0") {
                mensaje_dialogo_info("No se encontro número de cédula",
                        "ATENCION");
                $("#id_contrato").val("0");
            } else {

                let json_funcionario = JSON.parse(funcionario);
                $("#id_contrato").val(json_funcionario[0]['con_id']);
                $("#nombre_contrato").val(json_funcionario[0]['personal']);
                let contrato = ejecutarAjax("controladores/contrato.php",
                        "id=" + $("#id_contrato").val());
                let json_contrato = JSON.parse(contrato);
                let salario = parseInt(json_contrato[0]['con_salario']);
                $("#salario").val(formatearNumero(salario));
                $("#salario_basico").val(formatearNumero(salario));
                let sueldo_minimo = 2356000;
                //bonificacion de salario
                let hijos = ejecutarAjax("controladores/bonificacion.php",
                        "id_contrato_hijos=" + $("#id_contrato").val());
                if (hijos === "0") {
                    $("#bonificacion").val("0");
                } else {
                    let cantidad_boni = 0;
                    let json_hijos = JSON.parse(hijos);
                    json_hijos.map(function (item) {
                        if (parseInt(item.edad) < 18) {
                            cantidad_boni++;
                        }
                    });
                    console.log(cantidad_boni);
                    let monto_bonificacion = (sueldo_minimo * 0.05) * cantidad_boni;
                    $("#bonificacion").val(formatearNumero(monto_bonificacion));


                }


                calcularAguinaldo();
            }

        }
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function calcularAguinaldo() {
    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un funcionario por cedula",
                "ATENCION");
        return;
    }

    let data_filtros = {
        'id_contrato': $("#id_contrato").val(),
        'anio': $("#anio").val()
    };
    let data_asis = {
        'id': $("#id_contrato").val(),
        'fecha': $("#anio").val()
    };


//                console.log($("#id_contrato").val());
    //dias trabajados
    let dias = ejecutarAjax("controladores/asistencia.php",
            "dias_trabajados=" + JSON.stringify(data_filtros));
//                console.log(dias);
    $("#dias").val(dias);
    //dias trabajados
    let horas = ejecutarAjax("controladores/asistencia.php",
            "total_horas=" + JSON.stringify(data_asis));
//                console.log(dias);
    $("#horas").val(horas);

    //aguinaldo neto
    let anticipo = parseInt($("#anticipo").val());
    let salario = quitarDecimalesConvertir($("#salario").val());
    let dias_laborales = quitarDecimalesConvertir(dias);
    dias_laborales = dias_laborales / 24;
    salario = salario / 12;
    let aguinaldo = Math.round(salario * dias_laborales);
    $("#aguinaldo_neto").val(formatearNumero(aguinaldo - anticipo));

    //totales de montos

    let totales = ejecutarAjax("controladores/salario.php",
            "totales_aguinaldo=" + JSON.stringify(data_filtros));
//            console.log(totales);
    if (totales === "0") {

    } else {
        let json_totales = JSON.parse(totales);
        $("#egresos").val(formatearNumero(json_totales[0]['total_descuento']));
        $("#extra").val(formatearNumero(json_totales[0]['total_extra']));
        $("#bonificacion").val(formatearNumero(json_totales[0]['bonificacion']));
    }
    let aporte = ejecutarAjax("controladores/ips.php",
            "total_aporte_aguinaldo=" + JSON.stringify(data_filtros));

    if (aporte === "0") {

    } else {

        $("#ips").val(formatearNumero(aporte));
    }


    //vacaciones
    let contrato = ejecutarAjax("controladores/contrato.php",
            "id=" + $("#id_contrato").val());
    let json_contrato = JSON.parse(contrato);
    let anio = parseInt(json_contrato[0]['con_emis'].split("-")[0]);
    let actual = parseInt(dameFechaActualSQL().split("-")[0]);

    let correspondiente = ((actual - anio) >= 2) ? 24 : 12;


    let vacaciones = parseInt(ejecutarAjax("controladores/vacaciones.php",
            "dias=" + $("#id_contrato").val()));

    $("#vacaciones").val(correspondiente - vacaciones);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#anticipo", function (evt) {
    let anticipo = parseInt($("#anticipo").val());
    let salario = quitarDecimalesConvertir($("#salario").val());
    let dias_laborales = quitarDecimalesConvertir($("#dias").val());
    dias_laborales = dias_laborales / 24;
    salario = salario / 12;
    let aguinaldo = Math.round(salario * dias_laborales);
    $("#aguinaldo_neto").val(formatearNumero(aguinaldo - anticipo));

});

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarAguinaldo() {

//    mensaje_dialogo_info("El aguinaldo ya ha sido registrado", "ATENCION");
//    mensaje_dialogo_info("Debes ingresar nro NIC", "ATENCION");

    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }
    if ($("#nic").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar nro NIC", "ATENCION");
        return;
    }
    if ($("#ruc").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar el R.U.C. de la empresa", "ATENCION");
        return;
    }



    let existe_data = {
        'id_contrato': $("#id_contrato").val(),
        'anio': $("#anio").val()
    };
    var existe = ejecutarAjax("controladores/aguinaldo.php",
            "existe=" + JSON.stringify(existe_data));

    if (existe !== "0") {
        mensaje_dialogo_info("El aguinaldo ya ha sido registrado.",
                "ATENCION");
        return;
    }


    if ($("#id_aguinaldo").val() === "0") {


        let aguinaldo = {

            'con_id': $("#id_contrato").val(),
            'agui_nic': ($("#nic").val()),
            'agui_ruc': ($("#ruc").val()),
            'agui_di_trab': quitarDecimalesConvertir($("#dias").val()),
            'agui_sal_bas': quitarDecimalesConvertir($("#salario_basico").val()),
            'agui_q_horas': quitarDecimalesConvertir($("#horas").val()),
            'agui_bnf_fli': quitarDecimalesConvertir($("#bonificacion").val()),
            'agui_tot_ing': quitarDecimalesConvertir($("#extra").val()),
            'agui_ips': quitarDecimalesConvertir($("#ips").val()),
            'agui_anticip': quitarDecimalesConvertir($("#anticipo").val()),
            'agui_tot_egr': quitarDecimalesConvertir($("#egresos").val()),
            'agui_sal_net': quitarDecimalesConvertir($("#aguinaldo_neto").val()),
            'agui_fecha': dameFechaActualSQL(),
            'agui_estado': 'ACTIVO'
        };
        let cur = ejecutarAjax("controladores/aguinaldo.php",
                "guardar=" + JSON.stringify(aguinaldo));
        console.log(cur);
        let id = ejecutarAjax("controladores/aguinaldo.php",
                "ultimoID=1");
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
        alertify.confirm('ANTENCION', 'Desea imprimir el Informe individual?', function () {
            window.open("paginas/planillas/imprimirAguinaldo.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    } else {
        let aguinaldo = {

            'det_ips_id': $("#id_ips").val(),
            'con_id': $("#id_contrato").val(),
            'det_ips_fe_pg': $("#fecha").val() + "-01",
            'det_ips_des': $("#descripcion").val(),
            'det_ips_aport': $("#aporte").val(),
            'det_ips_estado': $("#estado_a").val()

        };
        let cur = ejecutarAjax("controladores/ips.php",
                "actualizar=" + JSON.stringify(aguinaldo));
        console.log(cur);
        $(".actualizar-ips #id_contrato").val("0");
        $("#id_ips").val("0");
        $("#modal-generico").modal("hide");
        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        buscarAguinaldo();
    }

//    console.log(cur);
    limpiarAguinaldo();
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarAguinaldo() {
    var contenido = dameContenido("paginas/planillas/agregar-aguinaldo.php");
    $("#contenido-aguinaldo").html(contenido);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarAguinaldo() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#descuento_tb").html("NO HAY RESULTADOS");
    } else {
        let fecha_desde = $("#desde").val() + "-01";
        let fecha_hasta = $("#hasta").val() + "-01";
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
        let descuento = ejecutarAjax("controladores/aguinaldo.php",
                "b_filtros=" + JSON.stringify(filtro));
//        console.log(descuento);
        if (descuento === "0") {
            $("#aguinaldo_tb").html("NO HAY RESULTADOS");
        } else {
            let fila = ``;
            let json_descuento = JSON.parse(descuento);
            json_descuento.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.agui_id}</td>`;
                fila += `<td>${item.agui_fecha}</td>`;
                fila += `<td>${item.personal}</td>`;
                fila += `<td>${formatearNumero(item.agui_sal_bas)}</td>`;
                fila += `<td>${formatearNumero(item.agui_tot_ing)}</td>`;
                fila += `<td>${formatearNumero(item.agui_tot_egr)}</td>`;
                fila += `<td>${formatearNumero(item.agui_sal_net)}</td>`;
                fila += `<td>${item.agui_estado}</td>`;
                fila += `<td>
                                <button hidden class='btn btn-warning editar-aguinaldo'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-aguinaldo'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-aguinaldo'><i class="ti ti-printer"></i></button>
                            </td>`;
                fila += `</tr>`;
            });
            $("#aguinaldo_tb").html(fila);
        }

    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function grillaAguinaldo() {



    let descuento = ejecutarAjax("controladores/aguinaldo.php",
            "grilla=1");
    console.log(descuento);
    if (descuento === "0") {
        $("#aguinaldo_tb").html("NO HAY RESULTADOS");
    } else {
        let fila = ``;
        let json_descuento = JSON.parse(descuento);
        json_descuento.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.agui_id}</td>`;
            fila += `<td>${item.agui_fecha}</td>`;
            fila += `<td>${item.personal}</td>`;
            fila += `<td>${formatearNumero(item.agui_sal_bas)}</td>`;
            fila += `<td>${formatearNumero(item.agui_tot_ing)}</td>`;
            fila += `<td>${formatearNumero(item.agui_tot_egr)}</td>`;
            fila += `<td>${formatearNumero(item.agui_sal_net)}</td>`;
            fila += `<td>${item.agui_estado}</td>`;
            fila += `<td>
                                <button hidden class='btn btn-warning editar-aguinaldo'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-aguinaldo'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-aguinaldo'><i class="ti ti-printer"></i></button>
                            </td>`;
            fila += `</tr>`;
        });
        $("#aguinaldo_tb").html(fila);
    }


}


//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-aguinaldo", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/aguinaldo.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        grillaAguinaldo();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-aguinaldo", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/planillas/imprimirAguinaldo.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });
});
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function generarPlanillaAguinaldo() {
    let anio = $("#anio").val();


    open("paginas/planillas/imprimirPlanillaAguinaldo.php?anio=" + anio);
}