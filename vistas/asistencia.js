function mostrarAsistencia() {
    var contenido = dameContenido("paginas/personal/asistencia.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarAsistencia() {
    var contenido = dameContenido("paginas/personal/agregar-asistencia.php");
    $("#contenido-asistencia").html(contenido);
    $("#marcar_btn").attr("hidden", true);
    $("#hora_actual").text(dameHoraActual());
    $("#fecha_actual").text(dameFechaActualNormal());

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarAsistencia() {
    var contenido = dameContenido("paginas/personal/consultar-asistencia.php");
    $("#contenido-asistencia").html(contenido);
    dameFechaActual("desde");
    dameFechaActual("hasta");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#cedula_contrato", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#cedula_contrato").val().trim().length === 0) {
            mensaje_dialogo_info("Debes ingresar un número de cédula válido",
                    "ATENCION");
        } else {
            let funcionario = ejecutarAjax("controladores/contrato.php",
                    "b_cedula=" + $("#cedula_contrato").val());
            if (funcionario === "0") {
                mensaje_dialogo_info("No se encontro número de cédula",
                        "ATENCION");
                $("#id_contrato").val("0");

            } else {
                let json_funcionario = JSON.parse(funcionario);
                $("#id_contrato").val(json_funcionario[0]['con_id']);
                $("#nombre_contrato").val(json_funcionario[0]['personal']);

                buscarTipoMarcacion();


            }

        }
    }
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", "#nombre_contrato", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#nombre_contrato").val().trim().length === 0) {
            let modal = dameContenido("paginas/modal-generico.php");
            let contenido = dameContenido("paginas/buscadores/buscadorContrato.php");
            $("html").append(modal);
            $("#modal-generico").addClass("buscador-contrato-asistencia");
            $("#contenido-modal").html(contenido);
            $("#modal-generico").modal("show");
        } else {

        }
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarTipoMarcacion() {
    let asistencia = ejecutarAjax("controladores/asistencia.php",
            "buscar_asistencia=" + $("#id_contrato").val());

    let data = {
        'id' : $("#id_contrato").val(),
        'fecha' : dameFechaActualSQL()
    }
    let cantidad = ejecutarAjax("controladores/asistencia.php",
            "total_asistencia=" + JSON.stringify(data));
            console.log(cantidad);
            
    if(parseInt(cantidad) >= 2){
        mensaje_dialogo_info("Exedio el limite de 4 marcaciones en el día", "ATENCION");
        return;
    }
    
    if (asistencia === "0") {
        $("#tipo_marcacion").text("ENTRADA");
//        $("#marcar_btn").removeAttr("hidden");
        alertify.confirm('MARCACION', 'Desea hacer la marcacion de entrada?', function () {
            guardarAistencia();

        }
        , function () {
            alertify.error('Cancelado')
        });
    } else {
        $("#tipo_marcacion").text("SALIDA");
//        $("#marcar_btn").removeAttr("hidden");
        let json_asistencia = JSON.parse(asistencia);
        $("#id_asistencia").val(json_asistencia[0]["asi_id"]);
        alertify.confirm('MARCACION', 'Desea hacer la marcacion de salida?', function () {
            guardarAistencia();

        }
        , function () {
            alertify.error('Cancelado')
        })


    }

    $("#hora_actual").text(dameHoraActual());

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".buscador-contrato-asistencia .seleccionar-contrato", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let nombre = $(this).closest("tr").find("td").filter(":eq(1)").text();
    let cedula = $(this).closest("tr").find("td").filter(":eq(2)").text();

    $("#id_contrato").val(id);
    $("#nombre_contrato").val(nombre);
    $("#cedula_contrato").val(cedula);
    buscarTipoMarcacion();
    $("#modal-generico").modal("hide");
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarAsistencia() {
    $("#cedula_contrato").val("");
    $("#tipo_marcacion").text("-");
    $("#nombre_contrato").val("");
    $("#id_contrato").val("0");
    $("#cedula_contrato").focus();
    $("#marcar_btn").attr("hidden", true);
    $("#hora_actual").text(dameHoraActual());


}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarAistencia() {


    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Usted debe indentificarse para marcar horario",
                "ATENCION");
        return;
    }


    if ($("#tipo_marcacion").text() === "ENTRADA") {
        let entrada = {

            'asi_hor_entr': $("#hora_actual").text() + ":00",
            'asi_fech': dameFechaActualSQL(),
            'asi_descri': "MARCACION NORMAL",
            'con_id': $("#id_contrato").val()

        };

        let cur = ejecutarAjax("controladores/asistencia.php",
                "guardar=" + JSON.stringify(entrada));

        console.log(cur);

        mensaje_dialogo_info("Entrada guardada correctamente", "EXITOSO");
        limpiarAsistencia();
    } else {
        let salida = {

            'asi_hor_sali': $("#hora_actual").text() + ":00",
            'asi_id': $("#id_asistencia").val()

        };

        let cur = ejecutarAjax("controladores/asistencia.php",
                "actualizar_salida=" + JSON.stringify(salida));
        $("#id_asistencia").val("0");
        console.log(cur);

        mensaje_dialogo_info("Salida guardada correctamente", "EXITOSO");
        limpiarAsistencia();

    }


}




//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-asistencia", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    if ($(this).closest("tr").find("td").filter(":eq(3)").text() === "NO ASIGNADO") {
        mensaje_dialogo_info("No puedes editar un registro sin hora de salida",
                "ATENCION");
        return;
    }
    let asistencia = ejecutarAjax("controladores/asistencia.php",
            "id=" + id);

    let json_asistencia = JSON.parse(asistencia);



    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/personal/editar-asistencia.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-asistencia");
    $("#contenido-modal").html(contenido);

    $(".actualizar-asistencia #id_asistencia").val(id);
    $(".actualizar-asistencia #fecha").val(json_asistencia[0]['asi_fech']);
    $(".actualizar-asistencia #entrada").val(json_asistencia[0]['asi_hor_entr']);
    $(".actualizar-asistencia #salida").val(json_asistencia[0]['asi_hor_sali']);
    $(".actualizar-asistencia #descripcion").val(json_asistencia[0]['asi_descri']);
    $("#modal-generico").modal("show");
});


//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-asistencia", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/personal/imprimirAsistencia.php?id=" + id);
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

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#cedula_contrato_c", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#cedula_contrato_c").val().trim().length === 0) {
            mensaje_dialogo_info("Debes ingresar un número de cédula válido",
                    "ATENCION");
        } else {
            let funcionario = ejecutarAjax("controladores/contrato.php",
                    "b_cedula=" + $("#cedula_contrato_c").val());
            if (funcionario === "0") {
                mensaje_dialogo_info("No se encontro número de cédula",
                        "ATENCION");
                $("#id_contrato").val("0");

            } else {
                let json_funcionario = JSON.parse(funcionario);
                $("#id_contrato").val(json_funcionario[0]['con_id']);
                $("#nombre_contrato_c").val(json_funcionario[0]['personal']);



            }

        }
    }
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", "#nombre_contrato_c", function (evt) {

    if (evt.keyCode === 13) {
        if ($("#nombre_contrato_c").val().trim().length === 0) {
            let modal = dameContenido("paginas/modal-generico.php");
            let contenido = dameContenido("paginas/buscadores/buscadorContrato.php");
            $("html").append(modal);
            $("#modal-generico").addClass("buscador-contrato-asistencia-consulta");
            $("#contenido-modal").html(contenido);
            $("#modal-generico").modal("show");
        } else {

        }
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".buscador-contrato-asistencia-consulta .seleccionar-contrato", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let nombre = $(this).closest("tr").find("td").filter(":eq(1)").text();
    let cedula = $(this).closest("tr").find("td").filter(":eq(2)").text();

    $("#id_contrato").val(id);
    $("#nombre_contrato_c").val(nombre);
    $("#cedula_contrato_c").val(cedula);
    $("#modal-generico").modal("hide");
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function buscarAsistencias() {
    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un funcionario",
                "ATENCION");
        return;
    }

    let filtros = {
        'id_contrato': $("#id_contrato").val(),
        'desde': $("#desde").val(),
        'hasta': $("#hasta").val()
    };

    let asistencias = ejecutarAjax("controladores/asistencia.php",
            "b_asistancias_filtro=" + JSON.stringify(filtros));
//            console.log(asistencias);
    if (asistencias === "0") {
        $("#asistencia_tb").html("NO HAY RESULTADOS");
    } else {
        let json_asistencia = JSON.parse(asistencias);

        let filas = "";
        json_asistencia.map(function (item) {
            filas += `<tr>`;
            filas += `<td>${item.asi_id}</td>`;
            filas += `<td>${item.asi_fech}</td>`;
            filas += `<td>${item.asi_hor_entr}</td>`;
            filas += `<td>${item.asi_hor_sali}</td>`;
            filas += `<td>${item.asi_descri}</td>`;
//            filas += `<td>
//                                <button class='btn btn-warning editar-asistencia'><i class="ti ti-pencil"></i></button>
//                                <button class='btn btn-primary imprimir-asistencia'><i class="ti ti-printer"></i></button>
//                            </td>`;
            filas += `</tr>`;
        });
        $("#asistencia_tb").html(filas);

    }
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function actualizarAsistencia() {
    let entrada = $("#entrada").val();
    let salida = $("#salida").val();

    if (salida.trim().length > 0) {
        if (entrada > salida) {
            mensaje_dialogo_info("La hora de entrada no puede ser mayor al de salida",
                    "ATENCION");
            return;
        }
    }

    if ($("#descripcion").val().trim().length === 0) {
        mensaje_dialogo_info("Debes ingresar una descripcion",
                "ATENCION");
        return;

    }

    let asistencia = {
        'asi_fech': $("#fecha").val(),
        'asi_hor_entr': $("#entrada").val(),
        'asi_hor_sali': $("#salida").val(),
        'asi_descri': $("#descripcion").val(),
        'asi_id': $("#id_asistencia").val()
    };

    let r = ejecutarAjax("controladores/asistencia.php",
            "actualizar=" + JSON.stringify(asistencia));
//    console.log(r);
    $("#modal-generico").modal("hide");
    mensaje_dialogo_info("Actualizado correctamente", "EXITOSO");
    buscarAsistencias();
}