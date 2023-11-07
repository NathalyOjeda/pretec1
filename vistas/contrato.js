function mostrarContrato() {
    var contenido = dameContenido("paginas/personal/contrato.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarContrato() {
    var contenido = dameContenido("paginas/personal/agregar-contrato.php");
    $("#contenido-contrato").html(contenido);
    dameFechaActual("fecha_inicio");
    dameFechaActual("fecha_fin");
    cargarListaCargo("#cargo_lst");
    $("#fecha_inicio").attr('min', dameFechaActualSQL());
    $("#fecha_fin").attr('min', dameFechaActualSQL());
    cargarListaDepartamento("#departamento_lst");
    let clau = dameContenido("paginas/personal/claupsula.php");
    $("#clausula").html(clau);
    actualizarContrato();

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarContrato() {
    var contenido = dameContenido("paginas/personal/consultar-contrato.php");
    $("#contenido-contrato").html(contenido);

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function actualizarContrato() {
    let fecha_actual = dameFechaActualSQL();


    $("#dia").text(fecha_actual.split("-")[2]);
    $("#mes").text(dameNombreMes(fecha_actual.split("-")[1]));
    $("#anio").text(fecha_actual.split("-")[0]);

    if ($("#cod_empleado").val().trim().length === 0) {
        $("#nombre").text("");
        $("#edad").text("");
        $("#sexo").text("");
        $("#estado").text("");
        $("#nacionalidad").text("");
        $("#cedula_con").text("");
        $("#direccion").text("");
        $("#ciudad").text("");
    } else {
        let personal = ejecutarAjax("controladores/empleado.php",
                "id=" + $("#cod_empleado").val());
        if (personal !== "0") {
            let json_personal = JSON.parse(personal);
            $("#nombre").text(json_personal[0]['per_nom'] + " " + json_personal[0]['per_apell']);
            $("#edad").text(calcularEdad(json_personal[0]['per_nacim']));
            $("#sexo").text(json_personal[0]['per_genero']);
            $("#estado").text(json_personal[0]['per_est_civ']);
            $("#nacionalidad").text(json_personal[0]['per_nacion']);
            $("#cedula_con").text(json_personal[0]['cedula']);
            $("#direccion").text(json_personal[0]['per_direc']);
            $("#ciudad").text(json_personal[0]['per_ciud']);
        }
    }
//    console.log($("#cargo_lst option:selected").text());
    if ($("#cargo_lst").val() === "0") {
        $("#cargo").text("SIN ESPECIFICAR");
    } else {

        $("#cargo").text($("#cargo_lst option:selected").text());
    }

    $("#sueldo_con").text($("#salario").val());

    $("#inicio_fecha").text($("#fecha_inicio").val());
}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", "#cod_empleado", function (evt) {
    if (evt.keyCode === 13) {
        if ($("#cod_empleado").val().trim().length === 0) {
            let modal = dameContenido("paginas/modal-generico.php");
            let contenido = dameContenido("paginas/buscadores/buscadorEmpleado.php");
            $("html").append(modal);
            $("#modal-generico").addClass("buscador-contrato-empleado");
            $("#contenido-modal").html(contenido);
            $("#modal-generico").modal("show");
        }
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".buscador-contrato-empleado .seleccionar-empleado-busqueda", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let nombre = $(this).closest("tr").find("td").filter(":eq(1)").text();
    let cedula = $(this).closest("tr").find("td").filter(":eq(2)").text();

    $("#cod_empleado").val(id);
    $("#nombre_personal").val(nombre);
    $("#cedula_personal").val(cedula);

    $("#cod_personal").attr('readonly', true);
    $("#modal-generico").modal("hide");
    actualizarContrato();
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("change", "#fecha_inicio, #cargo_lst", function (evt) {
    actualizarContrato();
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#salario", function (evt) {
    $("#salario").val(formatearNumero($("#salario").val()));
    actualizarContrato();
});

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cancelarPersonal() {
    $("#cod_empleado").val("");
    $("#nombre_personal").val("");
    $("#apellido_personal").val("");
    $("#cedula_personal").val("");

    $("#cod_empleado").removeAttr('readonly');
    $("#cod_empleado").focus();

    actualizarContrato();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarContrato() {


    if ($("#nombre_personal").val().trim().length === 0) {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }


    if ($("#cargo_lst").val() === "0") {
        mensaje_dialogo_info("Debes seleccionar un cargo.", "ATENCION");
        return;
    }
    if ($("#departamento_lst").val() === "0") {
        mensaje_dialogo_info("Debes seleccionar un departamento.", "ATENCION");
        return;
    }




    if ($("#id_contrato").val() === "0") {

        let existe = ejecutarAjax("controladores/contrato.php",
                "id_func=" + $("#cod_empleado").val());

        if (existe !== '0') {

            mensaje_dialogo_info("El empleado " + $("#nombre_personal").val() + " \n\
        tiene un contrato vigente, que vence en la fecha "
                    + existe, "ATENCION");
            return;
        }

        let contrato = {

            'con_emis': $("#fecha_inicio").val(),
            'contrat_clau': $("#clausula").html(),
            'con_fin': $("#fecha_fin").val(),
            'con_salario': quitarDecimalesConvertir($("#salario").val()),
            'car_id': $("#cargo_lst").val(),
            'dep_id': $("#departamento_lst").val(),
            'func_id': $("#cod_empleado").val(),
            'profesion': ($("#obrero").is(":checked")) ? "OBRERO" : "EMPLEADO",
            'con_estado': $("#estado_a").val()

        };

         console.log(contrato);
        let cur = ejecutarAjax("controladores/contrato.php",
                "guardar=" + JSON.stringify(contrato));

        console.log(cur);
        let id = ejecutarAjax("controladores/contrato.php",
                "ultimoID=1");

        $("#perfil_tb tr").each(function (evt) {
            if ($(this).find("input").is(":checked")) {

                let perfil = {
                    'con_id': id,
                    'id_per_carg': $(this).find("td:eq(0)").text(),
                    'estado': 1
                };

                let rd = ejecutarAjax("controladores/contrato_perfil.php",
                        "guardar=" + JSON.stringify(perfil));
            }
        });

        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

        alertify.confirm('ANTENCION', 'Desea imprimir elS contrato?', function () {
            window.open("paginas/personal/imprimirContrato.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    } else {
        let contrato = {

            'con_id': $("#id_contrato").val(),
            'con_emis': $("#fecha_inicio").val(),
            'contrat_clau': $("#clausula").html(),
            'con_fin': $("#fecha_fin").val(),
            'con_salario': quitarDecimalesConvertir($("#salario").val()),
            'car_id': $("#cargo_lst").val(),
            'dep_id': $("#departamento_lst").val(),
            'func_id': $("#cod_empleado").val(),
            'con_estado': $("#estado_a").val()

        };
        let cur = ejecutarAjax("controladores/contrato.php",
                "actualizar=" + JSON.stringify(contrato));


        $("#perfil_tb tr").each(function (evt) {
            if ($(this).find("input").is(":checked")) {

                let perfil = {
                    'con_id': id,
                    'id_per_carg': $(this).find("td:eq(0)").text(),
                    'estado': 1
                };

                let rd = ejecutarAjax("controladores/contrato_perfil.php",
                        "guardar=" + JSON.stringify(perfil));
            }
        });

        console.log(cur);
        $("#id_contrato").val("0");
        $("#modal-generico").modal("hide");

        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        cargarTablaConsultaContrato();

    }

//    console.log(cur);
    limpiarContrato();

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarContrato() {
    $("#cod_empleado").val("");
    $("#nombre_personal").val("");
    $("#cedula_personal").val("");
    $("#estado_a").val("1");

    $("#cargo_lst").val("0");
    $("#departamento_lst").val("0");
    $("#salario").val("0");
    $("#cod_empleado").removeAttr('readonly');
    dameFechaActual("fecha_inicio");
    dameFechaActual("fecha_fin");
    $("#fecha_inicio").attr('min', dameFechaActualSQL());
    $("#fecha_fin").attr('min', dameFechaActualSQL());
    $("#perfil_tb").html("");
    actualizarContrato();

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#b_nombre_contrato", function (evt) {
    if (evt.keyCode === 13) {
        cargarTablaConsultaContrato();
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cargarTablaConsultaContrato() {
    if ($("#b_nombre_contrato").val().trim().length === 0) {
        $("#contrato_tb").html("NO HAY RESULTADOS");
    } else {
        let curriculum = ejecutarAjax("controladores/contrato.php",
                "b_nombre=" + $("#b_nombre_contrato").val());

        if (curriculum === "0") {
            $("#contrato_tb").html("NO HAY RESULTADOS");

        } else {
            let fila = ``;
            let json_curr = JSON.parse(curriculum);
            json_curr.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.con_id}</td>`;
                fila += `<td>${item.personal}</td>`;
                fila += `<td>${item.cedula}</td>`;
                fila += `<td>${item.con_emis}</td>`;
                fila += `<td>${item.con_fin}</td>`;
                fila += `<td>${item.cargo}</td>`;
                fila += `<td>${formatearNumero(item.con_salario)}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
                                <button class='btn btn-danger anular-contrato'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-contrato'><i class="ti ti-printer"></i></button>

                            </td>`;
                fila += `</tr>`;
            });

            $("#contrato_tb").html(fila);

        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-contrato", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    let contrato = ejecutarAjax("controladores/contrato.php",
            "id=" + id);

    let json_contrato = JSON.parse(contrato);

    let empleado = ejecutarAjax("controladores/empleado.php",
            "id=" + json_contrato[0]['func_id']);

    let json_empleado = JSON.parse(empleado);
    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/personal/agregar-contrato.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-contrato");
    $("#contenido-modal").html(contenido);
    dameFechaActual("fecha_inicio");
    dameFechaActual("fecha_fin");
    cargarListaCargo("#cargo_lst");
    $("#fecha_inicio").attr('min', dameFechaActualSQL());
    $("#fecha_fin").attr('min', dameFechaActualSQL());
    cargarListaDepartamento("#departamento_lst");
    $(".actualizar-contrato #id_contrato").val(id);
    $(".actualizar-contrato #fecha_inicio").val(json_contrato[0]['con_emis']);
    $(".actualizar-contrato #fecha_fin").val(json_contrato[0]['con_fin']);
    $(".actualizar-contrato #salario").val(formatearNumero(json_contrato[0]['con_salario']));
    $(".actualizar-contrato #cargo_lst").val(json_contrato[0]['car_id']);
    $(".actualizar-contrato #departamento_lst").val(json_contrato[0]['dep_id']);
    $(".actualizar-contrato #clausula").html(json_contrato[0]['contrat_clau']);
    $(".actualizar-contrato #estado_a").val(json_contrato[0]['con_estado']);
    $(".actualizar-contrato #cod_empleado").val(json_contrato[0]['func_id']);
    $(".actualizar-contrato #nombre_personal").val(json_empleado[0]['per_nom']);
    $(".actualizar-contrato #apellido_personal").val(json_empleado[0]['per_apell']);
    $(".actualizar-contrato #cedula_personal").val(json_empleado[0]['cedula']);
    $(".actualizar-contrato .cancelar-btn").attr('hidden', true);
    $("#modal-generico").modal("show");
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-contrato", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_aguinaldo=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Aguinaldos, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_asistencia=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Asistencia, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_bonificacion=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Bonificación Familiar, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_descuento=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Descuentos, no puede ser anulado",
                    "Atención");
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_det_ips=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Detalle de IPS, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_det_min=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Detalle del Ministerio, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_det_salario=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Detalle del Salario, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_legajo_funcionario=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Detalle Legajo del funcionario, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_permiso=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Permisos, no puede ser anulado",
                    "Atención");
            return;
        }

        if (ejecutarAjax("controladores/contrato.php",
                "existe_en_vacaciones=" + id) === "1") {
            mensaje_dialogo_info("El contrato \n\
                    esta siendo utilizado en Vacaciones, no puede ser anulado",
                    "Atención");
            return;
        }




        let cur = ejecutarAjax("controladores/contrato.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        cargarTablaConsultaContrato();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-contrato", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/personal/imprimirContrato.php?id=" + id);
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

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("change", "#cargo_lst", function (evt) {
    let datos = ejecutarAjax("controladores/perfil_cargo.php",
            "id=" + $("#cargo_lst").val());
    fila = "";
    if (datos === "0") {
        fila = "NO HAY PERFIL DISPONIBLE";
    } else {
        let json_data = JSON.parse(datos);

        json_data.map(function (item) {
            fila += `<tr>`;
            fila += `<td hidden>${item.id_per_carg}</td>`;
            fila += `<td>${item.descripcion}</td>`;
            fila += `<td><input type="checkbox" class="form-control form-control-sm"></input></td>`;
            fila += `</tr>`;
        });
    }
    $("#perfil_tb").html(fila);
});