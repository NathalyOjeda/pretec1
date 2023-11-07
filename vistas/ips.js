function mostrarIPS() {
    var contenido = dameContenido("paginas/planillas/ips.php");
    $("#contenido-page").html(contenido);
    dameFechaActual("periodo");


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarIPS() {
    var contenido = dameContenido("paginas/planillas/agregar-ips.php");
    $("#contenido-ips").html(contenido);
    dameMesActual("fecha");
    $("#fecha").attr("min", dameMesActualSQL());
    cargarGrilla();



}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarIPS() {
    var contenido = dameContenido("paginas/planillas/consultar-ips.php");
    $("#contenido-ips").html(contenido);
    dameMesActual("desde");
    dameMesActual("hasta");
    
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarGenerarPlanillaIPS() {
    var contenido = dameContenido("paginas/planillas/generar-planilla-ips.php");
    $("#contenido-ips").html(contenido);
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
$(document).on("keyup", "#cedula_contrato_i", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#cedula_contrato_i").val().trim().length === 0) {
            mensaje_dialogo_info("Debes ingresar un número de cédula válido",
                    "ATENCION");
        } else {
            let funcionario = ejecutarAjax("controladores/contrato.php",
                    "b_cedula=" + $("#cedula_contrato_i").val());
            if (funcionario === "0") {
                mensaje_dialogo_info("No se encontro número de cédula",
                        "ATENCION");
                $("#id_contrato").val("0");

            } else {
                let json_funcionario = JSON.parse(funcionario);
                $("#id_contrato").val(json_funcionario[0]['con_id']);
                $("#nombre_contrato").val(json_funcionario[0]['personal']);

                let contrato = ejecutarAjax("controladores/contrato.php",
                        "id=" + json_funcionario[0]['con_id']);

                let json_contrato = JSON.parse(contrato);
                let salario = parseInt(json_contrato[0]['con_salario']);
                $("#salario").val(formatearNumero(salario));
                $("#aporte").val(salario * 0.09);


            }

        }
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarIPS() {


    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }
    if ($("#descripcion").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar una descripción", "ATENCION");
        return;
    }

    let existe_data = {
        'id_contrato': $("#id_contrato").val(),
        'fecha': $("#fecha").val() + "-01"
    };
    var existe = ejecutarAjax("controladores/ips.php",
            "existe_en_mes=" + JSON.stringify(existe_data));

    if (existe !== "0") {
        mensaje_dialogo_info("El empleado ya ha registrado su Aporte este mes.",
                "ATENCION");
        return;
    }

    if ($("#id_ips").val() === "0") {


        let ips = {

            'con_id': $("#id_contrato").val(),
            'det_ips_fe_pg': $("#fecha").val() + "-01",
            'det_ips_des': $("#descripcion").val(),
            'det_ips_aport': $("#aporte").val(),
            'det_ips_estado': $("#estado_a").val()

        };

        let cur = ejecutarAjax("controladores/ips.php",
                "guardar=" + JSON.stringify(ips));


        let id = ejecutarAjax("controladores/ips.php",
                "ultimoID=1");
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");
        cargarGrilla();
        alertify.confirm('ANTENCION', 'Desea imprimir el Informe individual?', function () {
            window.open("paginas/planillas/imprimirIPS.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    } else {
        let ips = {

            'det_ips_id': $("#id_ips").val(),
            'con_id': $("#id_contrato").val(),
            'det_ips_fe_pg': $("#fecha").val() + "-01",
            'det_ips_des': $("#descripcion").val(),
            'det_ips_aport': $("#aporte").val(),
            'det_ips_estado': $("#estado_a").val()

        };
        let cur = ejecutarAjax("controladores/ips.php",
                "actualizar=" + JSON.stringify(ips));
        console.log(cur);
        $(".actualizar-ips #id_contrato").val("0");
        $("#id_ips").val("0");
        $("#modal-generico").modal("hide");

        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        buscarIPS();

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
function buscarIPS() {
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
        let descuento = ejecutarAjax("controladores/ips.php",
                "b_filtros=" + JSON.stringify(filtro));
//        console.log(descuento);
        if (descuento === "0") {
            $("#descuento_tb").html("NO HAY RESULTADOS");

        } else {
            let fila = ``;
            let json_descuento = JSON.parse(descuento);
            json_descuento.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.det_ips_id}</td>`;
                fila += `<td>${item.det_ips_fe_pg}</td>`;
                fila += `<td>${item.det_ips_des}</td>`;
                fila += `<td>${formatearNumero(item.det_ips_aport)}</td>`;
                fila += `<td>${item.det_ips_estado}</td>`;
                fila += `<td>
                                <button hidden class='btn btn-warning editar-ips'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-ips'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-ips'><i class="ti ti-printer"></i></button>
                            </td>`;
                fila += `</tr>`;
            });

            $("#ips_tb").html(fila);

        }

    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cargarTodoIPS() {



    let descuento = ejecutarAjax("controladores/ips.php",
            "b_filtros_todo=1");
//        console.log(descuento);
    if (descuento === "0") {
        $("#descuento_tb").html("NO HAY RESULTADOS");

    } else {
        let fila = ``;
        let json_descuento = JSON.parse(descuento);
        json_descuento.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.det_ips_id}</td>`;
            fila += `<td>${item.det_ips_fe_pg}</td>`;
            fila += `<td>${item.det_ips_des}</td>`;
            fila += `<td>${formatearNumero(item.det_ips_aport)}</td>`;
            fila += `<td>${item.det_ips_estado}</td>`;
            fila += `<td>
                                <button hidden class='btn btn-warning editar-ips'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-ips'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-ips'><i class="ti ti-printer"></i></button>
                            </td>`;
            fila += `</tr>`;
        });

        $("#ips_tb").html(fila);

    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cargarGrilla() {



    let descuento = ejecutarAjax("controladores/ips.php",
            "grilla=1");
//        console.log(descuento);
    if (descuento === "0") {
        $("#grilla_ips").html("NO HAY RESULTADOS");

    } else {
        let fila = ``;
        let json_descuento = JSON.parse(descuento);
        json_descuento.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.det_ips_id}</td>`;
            fila += `<td>${item.det_ips_fe_pg}</td>`;
            fila += `<td>${item.personal}</td>`;
            fila += `<td>${item.cedula}</td>`;
            fila += `<td>${item.car_descri}</td>`;
            fila += `<td>${formatearNumero(item.con_salario)}</td>`;
            fila += `<td>${formatearNumero(item.det_ips_aport)}</td>`;
            fila += `<td>${item.det_ips_estado}</td>`;
            fila += `<td>
                                <button hidden class='btn btn-warning editar-ips'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-ips'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-ips'><i class="ti ti-printer"></i></button>
                            </td>`;
            fila += `</tr>`;
        });

        $("#grilla_ips").html(fila);

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-ips", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    let sancion = ejecutarAjax("controladores/ips.php",
            "id=" + id);

    let json_sancion = JSON.parse(sancion);




    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/planillas/agregar-ips.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-ips");
    $("#contenido-modal").html(contenido);
    dameMesActual("fecha");
    $("#fecha").attr("min", dameMesActualSQL());

    $(".actualizar-ips .panel-empleado").attr("hidden", true);
    $(".actualizar-ips #id_ips").val(id);
    $(".actualizar-ips #id_contrato").val(json_sancion[0]['con_id']);
    $(".actualizar-ips #fecha").val(json_sancion[0]['det_ips_fe_pg']);
    $(".actualizar-ips #estado_a").val(json_sancion[0]['det_ips_estado']);
    $(".actualizar-ips #aporte").val(json_sancion[0]['det_ips_aport']);
    $(".actualizar-ips #descripcion").val(json_sancion[0]['det_ips_des']);

    $("#modal-generico").modal("show");
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-ips", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/ips.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        
        cargarTodoIPS();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-ips", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/planillas/imprimirIPS.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function generarPlanillaIPS() {
    let fecha_desde = $("#desde").val() + "-01";
    let fecha_hasta = $("#hasta").val() + "-01";



    if (fecha_desde > fecha_hasta) {
        mensaje_dialogo_info("Verifica el periodo de fecha",
                "ATENCION");
        return;
    }

    open("paginas/planillas/imprimirPlanillaIPS.php?desde=" + fecha_desde + "&hasta=" + fecha_hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function generarPlanillaIPS2() {
//    let fecha_desde = $("#desde").val() + "-01";
//    let fecha_hasta = $("#hasta").val() + "-01";
    let periodo_actual =  $("#periodo").val();
    let periodo_anterior =  "";
    let desde_anterior = "";
    let hasta_anterior = "";
    let desde_actual = "";
    let hasta_actual = "";
    if(parseInt(periodo_actual.split("-")[1]) - 1 === 0 ){
        
        desde_anterior =  (parseInt(periodo_actual.split("-")[0]) - 1)+"-12-01";
        hasta_anterior =  (parseInt(periodo_actual.split("-")[0]) - 1)+"-12-30";
    }else{
        desde_anterior =  periodo_actual.split("-")[0]+"-"+(parseInt(periodo_actual.split("-")[1]) - 1)+"-01";
        desde_anterior =  periodo_actual.split("-")[0]+"-"+(parseInt(periodo_actual.split("-")[1]) - 1)+"-30";
        
    }

    desde_actual =  periodo_actual.split("-")[0]+"-"+(parseInt(periodo_actual.split("-")[1]))+"-01";
    hasta_actual =  periodo_actual.split("-")[0]+"-"+(parseInt(periodo_actual.split("-")[1]))+"-30";

    open("paginas/planillas/imprimirIPS.php?desde_anterior=" + desde_anterior + 
            "&hasta_anterior=" + hasta_anterior+"&desde_actual=" + desde_actual
            +"&hasta_actual=" + hasta_actual+"&periodo_actual=" +$("#periodo").val() );
}