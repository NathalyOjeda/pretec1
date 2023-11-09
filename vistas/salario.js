function mostrarSalario() {
    var contenido = dameContenido("paginas/planillas/salario.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarSalario() {
    var contenido = dameContenido("paginas/planillas/agregar-salario.php");
    $("#contenido-salario").html(contenido);
    dameMesActual("mes_liquidacion");



}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarSalario() {
    var contenido = dameContenido("paginas/planillas/consultar-salario.php");
    $("#contenido-salario").html(contenido);
    dameMesActual("desde");
    dameMesActual("hasta");
    grillaSalario();
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarGenerarPlanillaSalario() {
    var contenido = dameContenido("paginas/planillas/generar-planilla-salario.php");
    $("#contenido-salario").html(contenido);
    dameMesActual("desde");
    dameMesActual("hasta");
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
$(document).on("keyup", "#cedula_contrato_s", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#cedula_contrato_s").val().trim().length === 0) {
            mensaje_dialogo_info("Debes ingresar un número de cédula válido",
                    "ATENCION");
        } else {
            let funcionario = ejecutarAjax("controladores/contrato.php",
                    "b_cedula=" + $("#cedula_contrato_s").val());
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
                calcularLiquidacion();

            }

        }
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function calcularLiquidacion() {
    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un funcionario por cedula",
                "ATENCION");
        return;
    }
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
        if(cantidad_boni > 3){
                cantidad_boni = 3;
            }
        let monto_bonificacion = (sueldo_minimo * 0.05) * cantidad_boni;
        $("#bonificacion").val(formatearNumero(monto_bonificacion));
        
        
    }
    
    //ingresos extras
    let datos = {
        'con_id' : $("#id_contrato").val(),
        'fecha' : $("#mes_liquidacion").val()
    };
    
    
    let ingresos = ejecutarAjax("controladores/ingresos.php",
    "segun_mes="+JSON.stringify(datos));
    

    $("#extra").val(formatearNumero(ingresos));
    let salario = quitarDecimalesConvertir($("#salario").val());
    
    //IPS APORTE
    $("#ips").val(formatearNumero(Math.round(salario * 0.09)));


    $(".descuento").remove();
    let contrato = ejecutarAjax("controladores/contrato.php",
            "id=" + $("#id_contrato").val());

    let json_contrato = JSON.parse(contrato);
    


    $("#salario_actual").val(formatearNumero($("#salario").val()));
    let sal_actual = quitarDecimalesConvertir($("#salario").val());

    //cargamos los descuentos
    let des_filtros = {
        'id_contrato': $("#id_contrato").val(),
        'desde': $("#mes_liquidacion").val() + "-01",
        'hasta': $("#mes_liquidacion").val() + "-31"
    };
    let des = ejecutarAjax("controladores/descuento.php",
            "descuentos_activos_periodo=" + JSON.stringify(des_filtros));

    if (des === "0") {

    } else {
        let fila = "";
        let json_des = JSON.parse(des);
        json_des.map(function (item) {
            fila += `<tr class="descuento">
                        <td>Descuento, ${item.des_mot_desci} - ${item.des_fec}</td>
                        <td>-</td>
                        <td><input type="text" class="form-control egreso " readonly value="${formatearNumero(item.des_monto)}"></td>
                    </tr>`;
        });
        $("#liquidacion_tb").append(fila);
    }
    //ips aporte
    
    //horas trabajadas
    let p_horas = {
        'id' : $("#id_contrato").val(),
        'fecha' : $("#anio").val()
    };
    let horas = ejecutarAjax("controladores/asistencia.php",
    "total_horas="+JSON.stringify(p_horas));
    
    $("#horas").val(horas);
    
    //vacaciones
    
    //cargamos los descuentos
    des_filtros = {
        'id_contrato': $("#id_contrato").val(),
        'desde': $("#mes_liquidacion").val() + "-01",
        'hasta': $("#mes_liquidacion").val() + "-31"
    };
    let vacaciones = ejecutarAjax("controladores/vacaciones.php",
            "pagadas=" + JSON.stringify(des_filtros));
            console.log(vacaciones);
    if(vacaciones === "0"){
        
    }else{
        let json_va =  JSON.parse(vacaciones);
        
        let dias =  quitarDecimalesConvertir(json_va[0]['dias']);
        let fila = `<tr class="descuento">
                        <td>Vacaciones</td>
                        <td><input type="text" class="form-control ingreso" readonly value="${formatearNumero(Math.round(dias * (sal_actual / 30)))}"></td>
                        <td>-</td>
                    </tr>`;
         $("#liquidacion_tb").append(fila);
        
    }
            
            

    


    totalIngresosEgresos();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function totalIngresosEgresos() {
    let total_ingreso = 0;
    $(".ingreso").each(function (evt) {
        total_ingreso += quitarDecimalesConvertir($(this).val());
    });

    let total_egreso = 0;
    $(".egreso").each(function (evt) {
        total_egreso += quitarDecimalesConvertir($(this).val());
    });

    $("#total_ingreso").text(formatearNumero(total_ingreso));
    $("#total_egreso").text(formatearNumero(total_egreso));
    $("#suelto_neto").text(formatearNumero(total_ingreso - total_egreso));

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarLiquidacion() {


    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }
    



//    let existe_data = {
//        'id_contrato': $("#id_contrato").val(),
//        'fecha': $("#fecha").val() + "-01"
//    };
//    var existe = ejecutarAjax("controladores/ips.php",
//            "existe_en_mes=" + JSON.stringify(existe_data));
//
//    if (existe !== "0") {
//        mensaje_dialogo_info("El empleado ya ha registrado su Aporte este mes.",
//                "ATENCION");
//        return;
//    }


    if ($("#id_salario").val() === "0") {


        let salario = {

            'con_id': $("#id_contrato").val(),
            'bon_flia': quitarDecimalesConvertir($("#bonificacion").val()),
            'sal_id': quitarDecimalesConvertir($("#salario").val()),
            'sal_mes': quitarDecimalesConvertir($("#suelto_neto").text()),
            'total_descuento': quitarDecimalesConvertir($("#total_egreso").text()),
            'sal_fec_emis': dameFechaActualSQL(),
            'ips': quitarDecimalesConvertir($("#ips").val()),
            'estado': 'ACTIVO',
            'total_extra': quitarDecimalesConvertir($("#extra").val())
        };

        let cur = ejecutarAjax("controladores/salario.php",
                "guardar=" + JSON.stringify(salario));

        console.log(cur);
        let id = ejecutarAjax("controladores/salario.php",
                "ultimoID=1");
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

        alertify.confirm('ANTENCION', 'Desea imprimir el Informe individual?', function () {
            window.open("paginas/planillas/imprimirSalario.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    } 

    

//    console.log(cur);
    limpiarIPS();

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarIPS() {
    $("#cedula_contrato_i").val("");
    $("#nombre_contrato").val("");
    $("#salario").val("");
    $("#aporte").val("");
    $("#descripcion").val("");
    $("#estado_a").val("ACTIVO");


    dameMesActual("fecha");
    $("#fecha").attr("min", dameMesActualSQL());





}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarSalario() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#descuento_tb").html("NO HAY RESULTADOS");
    } else {
        let fecha_desde = $("#desde").val() + "-01";
        let fecha_hasta = $("#hasta").val() + "-31";


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
        let descuento = ejecutarAjax("controladores/salario.php",
                "b_filtros=" + JSON.stringify(filtro));
//        console.log(descuento);
        if (descuento === "0") {
            $("#salario_tb").html("NO HAY RESULTADOS");

        } else {
            let fila = ``;
            let json_descuento = JSON.parse(descuento);
            json_descuento.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.det_salario_id}</td>`;
                fila += `<td>${item.sal_fec_emis}</td>`;
                fila += `<td>${item.personal}</td>`;
                fila += `<td>${formatearNumero(item.sal_id)}</td>`;
                fila += `<td>${formatearNumero(item.total_extra)}</td>`;
                fila += `<td>${formatearNumero(item.bon_flia)}</td>`;
                fila += `<td>${formatearNumero(item.total_descuento)}</td>`;
                fila += `<td>${formatearNumero(item.sal_mes)}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
                                <button hidden class='btn btn-warning editar-ips'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-salario'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-salario'><i class="ti ti-printer"></i></button>
                            </td>`;
                fila += `</tr>`;
            });

            $("#salario_tb").html(fila);

        }

    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function grillaSalario() {



    let descuento = ejecutarAjax("controladores/salario.php",
            "grilla=1");
    console.log(descuento);
    if (descuento === "0") {
        $("#salario_tb").html("NO HAY RESULTADOS");

    } else {
        let fila = ``;
        let json_descuento = JSON.parse(descuento);
        json_descuento.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.det_salario_id}</td>`;
            fila += `<td>${item.sal_fec_emis}</td>`;
            fila += `<td>${item.personal}</td>`;
            fila += `<td>${formatearNumero(item.sal_id)}</td>`;
            fila += `<td>${formatearNumero(item.total_extra)}</td>`;
            fila += `<td>${formatearNumero(item.bon_flia)}</td>`;
            fila += `<td>${formatearNumero(item.total_descuento)}</td>`;
            fila += `<td>${formatearNumero(item.sal_mes)}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td>
                                <button hidden class='btn btn-warning editar-ips'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-salario'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-salario'><i class="ti ti-printer"></i></button>
                            </td>`;
            fila += `</tr>`;
        });

        $("#salario_tb").html(fila);

    }


}



//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-salario", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/salario.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        grillaSalario();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-salario", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/planillas/imprimirSalario.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function generarPlanillaSalario() {
    let fecha_desde = $("#desde").val() + "-01";
    let fecha_hasta = $("#hasta").val() + "-31";



    if (fecha_desde > fecha_hasta) {
        mensaje_dialogo_info("Verifica el periodo de fecha",
                "ATENCION");
        return;
    }

    open("paginas/planillas/imprimirPlanillaSalario.php?desde=" + fecha_desde + "&hasta=" + fecha_hasta);
}