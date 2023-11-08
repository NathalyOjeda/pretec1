function mostrarMinisterio() {
    var contenido = dameContenido("paginas/planillas/ministerio.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarMinisterio() {
    var contenido = dameContenido("paginas/planillas/agregar-ministerio.php");
    $("#contenido-ministerio").html(contenido);
    dameFechaActual("fecha");
    $("#fecha").attr("min", dameFechaActualSQL());
    cargarGrillaMinisterio();



}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarMinisterio() {
    var contenido = dameContenido("paginas/planillas/consultar-ministerio.php");
    $("#contenido-ministerio").html(contenido);
    dameFechaActual("desde");
    dameFechaActual("hasta");
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarGenerarPlanillaMinisterio() {
    var contenido = dameContenido("paginas/planillas/generar-planilla-ministerio.php");
    $("#contenido-ministerio").html(contenido);
    dameFechaActual("desde");
    dameFechaActual("hasta");
}





//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarMinisterio() {


    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }
    if ($("#descripcion").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar una descripción", "ATENCION");
        return;
    }
    if ($("#patrol").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar un patrol válido", "ATENCION");
        return;
    }

//    let existe_data = {
//        'id_contrato': $("#id_contrato").val(),
//        'fecha': $("#fecha").val() + "-01"
//    };
//    var existe = ejecutarAjax("controladores/ips.php",
//            "existe_en_mes=" + JSON.stringify(existe_data));

//    if (existe !== "0") {
//        mensaje_dialogo_info("El empleado ya ha registrado su Aporte este mes.",
//                "ATENCION");
//        return;
//    }

    if ($("#id_ministerio").val() === "0") {


        let ips = {

            'con_id': $("#id_contrato").val(),
            'det_mjt_patrl': $("#patrol").val(),
            'det_min_trab_desc': $("#descripcion").val(),
            'det_mjt_fe_pla': $("#fecha").val(),
            'det_mjt_esta': $("#estado_a").val()

        };

        let cur = ejecutarAjax("controladores/ministerio.php",
                "guardar=" + JSON.stringify(ips));


        let id = ejecutarAjax("controladores/ministerio.php",
                "ultimoID=1");
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

        alertify.confirm('ANTENCION', 'Desea imprimir el Informe individual?', function () {
            window.open("paginas/planillas/imprimirMinisterio.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    } else {
        let ips = {

            'det_min_trab_id': $("#id_ministerio").val(),
            'con_id': $("#id_contrato").val(),
            'det_mjt_patrl': $("#patrol").val(),
            'det_min_trab_desc': $("#descripcion").val(),
            'det_mjt_fe_pla': $("#fecha").val(),
            'det_mjt_esta': $("#estado_a").val()

        };
        let cur = ejecutarAjax("controladores/ministerio.php",
                "actualizar=" + JSON.stringify(ips));
        console.log(cur);
        $(".actualizar-ips #id_contrato").val("0");
        $("#id_ministerio").val("0");
        $("#modal-generico").modal("hide");

        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        buscarMinisterio();

    }

//    console.log(cur);
    cargarGrillaMinisterio();
    limpiarMinisterio();

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarMinisterio() {
    $("#cedula_contrato_b").val("");
    $("#nombre_contrato").val("");
    $("#patrol").val("");
    $("#descripcion").val("");
    $("#estado_a").val("ACTIVO");


    dameFechaActual("fecha");
    $("#fecha").attr("min", dameFechaActualSQL());





}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarMinisterio() {

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
    let descuento = ejecutarAjax("controladores/ministerio.php",
            "b_filtros=" + JSON.stringify(filtro));
//        console.log(descuento);
    if (descuento === "0") {
        $("#ministerio_tb").html("NO HAY RESULTADOS");

    } else {
        let fila = ``;
        let json_descuento = JSON.parse(descuento);
        json_descuento.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.det_min_trab_id}</td>`;
            fila += `<td>${item.det_mjt_fe_pla}</td>`;
            fila += `<td>${item.det_mjt_patrl}</td>`;
            fila += `<td>${item.det_min_trab_desc}</td>`;
            fila += `<td>${item.det_mjt_esta}</td>`;
            fila += `<td>
                                <button class='btn btn-warning editar-ministerio'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-ministerio'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-ministerio'><i class="ti ti-printer"></i></button>
                            </td>`;
            fila += `</tr>`;
        });

        $("#ministerio_tb").html(fila);

    }


}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-ministerio", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    let sancion = ejecutarAjax("controladores/ministerio.php",
            "id=" + id);

    let json_sancion = JSON.parse(sancion);




    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/planillas/agregar-ministerio.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-ministerio");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha");
    $("#fecha").attr("min", dameFechaActualSQL());

    $(".actualizar-ministerio .panel-empleado").attr("hidden", true);
    $(".actualizar-ministerio #id_ministerio").val(id);
    $(".actualizar-ministerio #id_contrato").val(json_sancion[0]['con_id']);
    $(".actualizar-ministerio #fecha").val(json_sancion[0]['det_mjt_fe_pla']);
    $(".actualizar-ministerio #estado_a").val(json_sancion[0]['det_mjt_esta']);
    $(".actualizar-ministerio #patrol").val(json_sancion[0]['det_mjt_patrl']);
    $(".actualizar-ministerio #descripcion").val(json_sancion[0]['det_min_trab_desc']);

    $("#modal-generico").modal("show");
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-ministerio", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/ministerio.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        buscarMinisterio();
        cargarGrillaMinisterio();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-ministerio", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/planillas/imprimirMinisterio.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function generarPlanillaMinisterio() {
    let fecha_desde = $("#desde").val();
    let fecha_hasta = $("#hasta").val();



    if (fecha_desde > fecha_hasta) {
        mensaje_dialogo_info("Verifica el periodo de fecha",
                "ATENCION");
        return;
    }

    open("paginas/planillas/imprimirPlanillaMinisterio.php?desde=" + fecha_desde + "&hasta=" + fecha_hasta);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cargarGrillaMinisterio() {


    let descuento = ejecutarAjax("controladores/ministerio.php",
            "grilla=1");
//        console.log(descuento);
    if (descuento === "0") {
        $("#grilla_ministerio").html("NO HAY RESULTADOS");

    } else {
        let fila = ``;
        let json_descuento = JSON.parse(descuento);
        json_descuento.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.det_min_trab_id}</td>`;
            fila += `<td>${item.det_mjt_fe_pla}</td>`;
            fila += `<td>${item.personal}</td>`;
            fila += `<td>${item.cedula}</td>`;
            fila += `<td>${item.car_descri}</td>`;
            fila += `<td>${item.det_mjt_patrl}</td>`;
            fila += `<td>${item.det_min_trab_desc}</td>`;
            fila += `<td>${item.det_mjt_esta}</td>`;
            fila += `<td>
                                <button class='btn btn-warning editar-ministerio'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-ministerio'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-ministerio'><i class="ti ti-printer"></i></button>
                            </td>`;
            fila += `</tr>`;
        });

        $("#grilla_ministerio").html(fila);

    }


}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function generarPlanillaMinisterio2() {


    if ($("#tipo_ministerio").val() === "1") {

        open("paginas/planillas/imprimirPlanillaMinisterio.php");
    }

}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function generarXMLPlanillaMinisterio2() {


    if ($("#tipo_ministerio").val() === "1") {
        xmlEmpleados();

    }

}


function OBJtoXML(obj) {
    var xml = '';
    for (var prop in obj) {
        xml += obj[prop] instanceof Array ? '' : "<" + prop + ">";
        if (obj[prop] instanceof Array) {
            for (var array in obj[prop]) {
                xml += "<" + prop + ">";
                xml += OBJtoXML(new Object(obj[prop][array]));
                xml += "</" + prop + ">";
            }
        } else if (typeof obj[prop] == "object") {
            xml += OBJtoXML(new Object(obj[prop]));
        } else {
            xml += obj[prop];
        }
        xml += obj[prop] instanceof Array ? '' : "</" + prop + ">";
    }
    var xml = xml.replace(/<\/?[0-9]{1,}>/g, '');
    return xml
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function xmlEmpleados() {
    let data = ejecutarAjax("controladores/ministerio.php", "paraxmlempleados=1");

    let xml = (OBJtoXML(JSON.parse(data)));

    let filename = 'people.xml';
    let text = '<?xml version="1.0"?>'+xml;

    let element = document.createElement('a');
    element.setAttribute('href', 'data:text/xml;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}