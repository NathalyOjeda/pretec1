function mostrarDescuento() {
    var contenido = dameContenido("paginas/permisos_descuentos/descuento.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarDescuento() {
    var contenido = dameContenido("paginas/permisos_descuentos/agregar-descuento.php");
    $("#contenido-descuento").html(contenido);
    dameFechaActual("fecha_descuento");
    $("#fecha_descuento").attr("min", dameFechaActualSQL());
    cargarListaMotivoDescuento("#motivo_lst");



}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarDescuento() {
    var contenido = dameContenido("paginas/permisos_descuentos/consultar-descuento.php");
    $("#contenido-descuento").html(contenido);
    dameFechaActual("desde");
    dameFechaActual("hasta");
}


//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarBusqueda() {
    $("#cedula_contrato_b").val("");
    $("#nombre_contrato").val("");
    $("#estado_a").val("ACTIVO");
    $("#id_contrato").val("0");
    $("#cedula_contrato_b").focus();



}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarDescuento() {


    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }


    if ($("#motivo_lst").val() === "0") {
        mensaje_dialogo_info("Debes seleccionar un motivo.", "ATENCION");
        return;
    }
    if ($("#monto").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar un monto.", "ATENCION");
        return;
    }





    if ($("#id_descuento").val() === "0") {


        $("#descuentos_tb tr").each(function (evt) {
            
            let descuento = {

                'con_id': $("#id_contrato").val(),
                'des_motiv_id': $(this).find("td:eq(0)").text(),
                'sanc_descri': "-",
                'des_fec': $("#fecha_descuento").val(),
                'estado': 'ACTIVO',
                'des_monto': quitarDecimalesConvertir($(this).find("td:eq(2)").text())

            };

            let cur = ejecutarAjax("controladores/descuento.php",
                    "guardar=" + JSON.stringify(descuento));
        });



        let id = ejecutarAjax("controladores/descuento.php",
                "ultimoID=1");
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

//        alertify.confirm('ANTENCION', 'Desea imprimir el descuento?', function () {
//            window.open("paginas/permisos_descuentos/imprimirDescuento.php?id=" + id);
//        }
//        , function () {
//            alertify.error('Operación cancelada');
//        });
    } else {
        let descuento = {

            'des_id': $("#id_descuento").val(),
            'con_id': $("#id_contrato").val(),
            'des_motiv_id': $("#motivo_lst").val(),
            'des_fec': $("#fecha_descuento").val(),
            'estado': $("#estado_a").val(),
            'des_monto': $("#monto").val()

        };
        let cur = ejecutarAjax("controladores/descuento.php",
                "actualizar=" + JSON.stringify(descuento));
        console.log(cur);
        $(".actualizar-descuento #id_contrato").val("0");
        $("#id_descuento").val("0");
        $("#modal-generico").modal("hide");

        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        buscarDescuento();

    }

//    console.log(cur);
    limpiarDescuento();

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarDescuento() {
    $("#cedula_contrato_b").val("");
    $("#nombre_contrato").val("");
    $("#monto").val("");
    $("#estado_a").val("ACTIVO");
    $("#motivo_lst").val("0");
    $("#descuentos_tb").html("");
    

    dameFechaActual("fecha_descuento");

    $("#fecha_descuento").attr("min", dameFechaActualSQL());





}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarDescuento() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#descuento_tb").html("NO HAY RESULTADOS");
    } else {
        let fecha_desde = $("#desde").val();
        let fecha_hasta = $("#hasta").val();


        if ($("#id_contrato").val() === "0") {
            mensaje_dialogo_info("Debes buscar un empleado",
                    "ATENCION");
            return;
        }

//        if (fecha_desde > fecha_hasta) {
//            mensaje_dialogo_info("Verifica el periodo de fecha",
//                    "ATENCION");
//            return;
//        }

        let filtro = {
            'id_contrato': $("#id_contrato").val(),
            'desde': fecha_desde,
            'hasta': fecha_hasta
        };
        let descuento = ejecutarAjax("controladores/descuento.php",
                "b_filtros=" + JSON.stringify(filtro));
        console.log(descuento);
        if (descuento === "0") {
            $("#descuento_tb").html("NO HAY RESULTADOS");

        } else {
            let fila = ``;
            let json_descuento = JSON.parse(descuento);
            json_descuento.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.des_id}</td>`;
                fila += `<td>${item.des_fec}</td>`;
                fila += `<td>${item.des_mot_desci}</td>`;
                fila += `<td>${formatearNumero(item.des_monto)}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
                                <button class='btn btn-danger anular-descuento'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-descuento'><i class="ti ti-printer"></i></button>
                            </td>`;
//                fila += `<td>
//                               <button class='btn btn-warning editar-descuento'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-danger anular-descuento'><i class="ti ti-trash"></i></button>
//                                <button class='btn btn-primary imprimir-descuento'><i class="ti ti-printer"></i></button>
//                            </td>`;
                fila += `</tr>`;
            });

            $("#descuento_tb").html(fila);

        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-descuento", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    let sancion = ejecutarAjax("controladores/descuento.php",
            "id=" + id);

    let json_sancion = JSON.parse(sancion);




    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/permisos_descuentos/agregar-descuento.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-descuento");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_descuento");
    $("#fecha_descuento").attr("min", dameFechaActualSQL());
    cargarListaMotivoDescuento("#motivo_lst");

    $(".actualizar-descuento .panel-empleado").attr("hidden", true);
    $(".actualizar-descuento #id_descuento").val(id);
    $(".actualizar-descuento #id_contrato").val(json_sancion[0]['con_id']);
    $(".actualizar-descuento #fecha_descuento").val(json_sancion[0]['des_fec']);
    $(".actualizar-descuento #motivo_lst").val(json_sancion[0]['des_motiv_id']);
    $(".actualizar-descuento #estado_a").val(json_sancion[0]['estado']);
    $(".actualizar-descuento #monto").val(json_sancion[0]['des_monto']);

    $("#modal-generico").modal("show");
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-descuento", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/descuento.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        buscarDescuento();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-descuento", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/permisos_descuentos/imprimirDescuento.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarDescuento() {
    let monto = $("#monto").val();
    let motivo = $("#motivo_lst").val();
    if (motivo === "0") {
        mensaje_dialogo_info("Debes seleccionar un motivo", "ATENCION");
        return;
    }
    
    if(monto.trim().length === 0){
        mensaje_dialogo_info("Debes ingresar un descuento", "ATENCION");
        return;
        
    }
    
    let repetido = false;
    $("#descuentos_tb tr").each(function (evt) {
        if (motivo === $(this).find("td:eq(0)").text()) {
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
    fila += `<td>${$("#motivo_lst option:selected").html()}</td>`;
    fila += `<td>${formatearNumero(monto)}</td>`;
    fila += `<td><button class='btn btn-danger eliminar-sancion'><i class="ti ti-trash"></i></button></td>`;
    fila += `</tr>`;
    $("#descuentos_tb").append(fila);
}