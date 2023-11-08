function mostrarPermiso() {
    var contenido = dameContenido("paginas/permisos_descuentos/permiso.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarPermiso() {
    var contenido = dameContenido("paginas/permisos_descuentos/agregar-permiso.php");
    $("#contenido-permiso").html(contenido);
    dameFechaActual("fecha_solicitud");
    dameFechaActual("fecha_desde");
    dameFechaActual("fecha_hasta");
    $("#fecha_desde").attr("min", dameFechaActualSQL());
    $("#fecha_hasta").attr("min", dameFechaActualSQL());
    $("#fecha_solicitud").attr("min", dameFechaActualSQL());
    cargarListaJustificacionPermiso("#justificacion_lst");


}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarPermiso() {
    var contenido = dameContenido("paginas/permisos_descuentos/consultar-permiso.php");
    $("#contenido-permiso").html(contenido);
    dameFechaActual("desde");
    dameFechaActual("hasta");
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#cedula_contrato_b", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#cedula_contrato_b").val().trim().length === 0) {
            mensaje_dialogo_info("Debes ingresar un número de cédula válido",
                    "ATENCION");
        } else {
            let funcionario = ejecutarAjax("controladores/contrato.php",
                    "b_cedula=" + $("#cedula_contrato_b").val());
                    console.log(funcionario);
            if (funcionario === "0") {
                mensaje_dialogo_info("El empleado no posee contrato activo",
                        "ATENCION");
                $("#id_contrato").val("0");

            } else {
                let json_funcionario = JSON.parse(funcionario);
                $("#id_contrato").val(json_funcionario[0]['con_id']);
                $("#nombre_contrato").val(json_funcionario[0]['personal']);
                


            }

        }
    }
});

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
function guardarPermiso() {


    if ($("#id_contraro").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }
    if ($("#descripcion").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar descripcion", "ATENCION");
        return;
    }


//    if ($("#justificacion_lst").val() === "0") {
//        mensaje_dialogo_info("Debes seleccionar una Justificación.", "ATENCION");
//        return;
//    }

    let fecha_solicitud = $("#fecha_solicitud").val();
    let fecha_desde = $("#fecha_desde").val();
    let fecha_hasta = $("#fecha_hasta").val();

    if (fecha_solicitud > fecha_desde) {
        mensaje_dialogo_info("La fecha de solicitud no puede ser mayor a la fecha desde",
                "ATENCION");
        return;
    }
    if (fecha_solicitud > fecha_hasta) {
        mensaje_dialogo_info("La fecha de solicitud no puede ser mayor a la fecha hasta",
                "ATENCION");
        return;
    }

    if (fecha_desde > fecha_hasta) {
        mensaje_dialogo_info("La fecha desde no puede ser mayor a la fecha hasta",
                "ATENCION");
        return;
    }



    if ($("#id_permiso").val() === "0") {



        let permiso = {

            'con_id': $("#id_contrato").val(),
            'jus_per_id': 0,
            'perm_descri': $("#descripcion").val(),
            'perm_fec_solic': $("#fecha_solicitud").val(),
            'perm_estado': "PENDIENTE",
            'perm_fec_desde': $("#fecha_desde").val(),
            'perm_fec_hasta': $("#fecha_hasta").val()

        };

        let cur = ejecutarAjax("controladores/permiso.php",
                "guardar=" + JSON.stringify(permiso));

        console.log(cur);
        let id = ejecutarAjax("controladores/permiso.php",
                "ultimoID=1");
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

        alertify.confirm('ANTENCION', 'Desea imprimir el permiso?', function () {
            window.open("paginas/permisos_descuentos/imprimirPermiso.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    } else {
        let permiso = {

            'perm_id': $("#id_permiso").val(),
            'con_id': $("#id_contrato").val(),
            'jus_per_id': 0,
            'perm_descri': $("#descripcion").val(),
            'perm_fec_solic': $("#fecha_solicitud").val(),
            'perm_estado': "PENDIENTE",
            'perm_fec_desde': $("#fecha_desde").val(),
            'perm_fec_hasta': $("#fecha_hasta").val()

        };
        let cur = ejecutarAjax("controladores/permiso.php",
                "actualizar=" + JSON.stringify(permiso));
        console.log(cur);
        buscarPermiso();
//        $("#id_contrato").val("0");
//        $("#id_permiso").val("0");
        $("#modal-generico").modal("hide");

        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");


    }

//    console.log(cur);
    limpiarPermiso();

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarPermiso() {
    $("#cedula_contrato_b").val("");
    $("#nombre_contrato").val("");
    $("#descripcion").val("");
    $("#estado_a").val("1");
    $("#justificacion_lst").val("0");

    dameFechaActual("fecha_solicitud");
    dameFechaActual("fecha_desde");
    dameFechaActual("fecha_hasta");
    $("#fecha_desde").attr("min", dameFechaActualSQL());
    $("#fecha_hasta").attr("min", dameFechaActualSQL());
    $("#fecha_solicitud").attr("min", dameFechaActualSQL());





}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarPermiso() {
    if ($("#nombre_contrato_c").val().trim().length === 0) {
        $("#permiso_tb").html("NO HAY RESULTADOS");
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
        let permiso = ejecutarAjax("controladores/permiso.php",
                "b_filtros=" + JSON.stringify(filtro));

        if (permiso === "0") {
            $("#contrato_tb").html("NO HAY RESULTADOS");

        } else {
            let fila = ``;
            let json_permiso = JSON.parse(permiso);
            json_permiso.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.perm_id}</td>`;
                fila += `<td>${item.perm_fec_solic}</td>`;
                fila += `<td>${item.perm_fec_desde}</td>`;
                fila += `<td>${item.perm_fec_hasta}</td>`;
                fila += `<td>${item.perm_descri}</td>`;
                fila += `<td>${item.perm_estado}</td>`;
                fila += `<td>
                                
                                <button class='btn btn-danger anular-permiso'><i class="ti ti-trash"></i></button>
                            </td>`;
//                fila += `<td>
//                                <button class='btn btn-warning editar-permiso'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-danger anular-permiso'><i class="ti ti-trash"></i></button>
//                                <button class='btn btn-primary imprimir-permiso'><i class="ti ti-printer"></i></button>
//                            </td>`;
                fila += `</tr>`;
            });

            $("#permiso_tb").html(fila);

        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-permiso", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    let permiso = ejecutarAjax("controladores/permiso.php",
            "id=" + id);

    let json_permiso = JSON.parse(permiso);




    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/permisos_descuentos/agregar-permiso.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-permiso");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_solicitud");
    dameFechaActual("fecha_desde");
    dameFechaActual("fecha_hasta");
    $("#fecha_desde").attr("min", dameFechaActualSQL());
    $("#fecha_hasta").attr("min", dameFechaActualSQL());
    $("#fecha_solicitud").attr("min", dameFechaActualSQL());
    cargarListaJustificacionPermiso("#justificacion_lst");


    $(".actualizar-permiso .panel-empleado").attr("hidden", true);
    $(".actualizar-permiso #id_permiso").val(id);
    $(".actualizar-permiso #id_contrato").val(json_permiso[0]['con_id']);
    $(".actualizar-permiso #fecha_solicitud").val(json_permiso[0]['perm_fec_solic']);
    $(".actualizar-permiso #justificacion_lst").val(json_permiso[0]['jus_per_id']);
    $(".actualizar-permiso #fecha_desde").val(json_permiso[0]['perm_fec_desde']);
    $(".actualizar-permiso #fecha_hasta").val(json_permiso[0]['perm_fec_hasta']);
    $(".actualizar-permiso #estado_a").val(json_permiso[0]['perm_estado']);
    $(".actualizar-permiso #descripcion").val(json_permiso[0]['perm_descri']);

    $("#modal-generico").modal("show");
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-permiso", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {


        let cur = ejecutarAjax("controladores/permiso.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        buscarPermiso();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-permiso", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/permisos_descuentos/imprimirPermiso.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", "#b_curriculum_personal", function (evt) {
    if (evt.keyCode === 13) {
        if ($("#b_curriculum_personal").val().trim().length === 0) {
            $("#resultado_curriculum_tb").html("NO HAY RESULTADOS");
        } else {
            let curriculum = ejecutarAjax("controladores/curriculum.php",
                    "b_nombre=" + $("#b_curriculum_personal").val());

            if (curriculum === "0") {
                $("#resultado_curriculum_tb").html("NO HAY RESULTADOS");

            } else {
                let fila = ``;
                let json_curr = JSON.parse(curriculum);
                json_curr.map(function (item) {
                    fila += `<tr>`;
                    fila += `<td>${item.cur_id}</td>`;
                    fila += `<td>${item.personal}</td>`;
                    fila += `<td>${item.cedula}</td>`;
                    fila += `<td>${item.cur_fecha}</td>`;
                    fila += `<td>${item.estado}</td>`;
                    fila += `<td>
                                <button class='btn btn-primary seleccionar-curriculum'>Seleccionar</button>
                                
                            </td>`;
                    fila += `</tr>`;
                });

                $("#resultado_curriculum_tb").html(fila);

            }

        }
    }
});
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", "#b_nombre_contrato_busqueda", function (evt) {
    if (evt.keyCode === 13) {
        if ($("#b_nombre_contrato_busqueda").val().trim().length === 0) {
            $("#resultado_contrato_tb").html("NO HAY RESULTADOS");
        } else {
            let contrato = ejecutarAjax("controladores/contrato.php",
                    "b_nombre_busquedas=" + $("#b_nombre_contrato_busqueda").val());
            console.log(contrato);
            if (contrato === "0") {
                $("#resultado_contrato_tb").html("NO HAY RESULTADOS");

            } else {
                let fila = ``;
                let json_contrato = JSON.parse(contrato);
                json_contrato.map(function (item) {
                    fila += `<tr>`;
                    fila += `<td>${item.con_id}</td>`;
                    fila += `<td>${item.personal}</td>`;
                    fila += `<td>${item.cedula}</td>`;
                    fila += `<td>${item.cargo}</td>`;
                    fila += `<td>
                                <button class='btn btn-primary seleccionar-contrato'>Seleccionar</button>
                                
                            </td>`;
                    fila += `</tr>`;
                });

                $("#resultado_contrato_tb").html(fila);

            }

        }
    }
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("change", "#cargo_lst", function (evt) {
    if ($("#cargo_lst").val() !== "0") {
        let cargo = ejecutarAjax("controladores/cargo.php",
                "id=" + $("#cargo_lst").val());

        let json_cargo = JSON.parse(cargo);

        $("#salario").val(formatearNumero(json_cargo[0]['salario']));

    } else {
        $("#salario").val("0");
    }
});