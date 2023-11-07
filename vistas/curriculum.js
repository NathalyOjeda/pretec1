function mostrarCurriculum() {
    var contenido = dameContenido("paginas/personal/curriculum.php");
    $("#contenido-page").html(contenido);


}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarCurriculum() {
    var contenido = dameContenido("paginas/personal/agregar-curriculum.php");
    $("#contenido-curriculum").html(contenido);
    dameFechaActual("fecha");
    $("#fecha").attr('min', dameFechaActualSQL());
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarCurriculum() {
    var contenido = dameContenido("paginas/personal/consultar-curriculum.php");
    $("#contenido-curriculum").html(contenido);

}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", "#cod_personal", function (evt) {
    if (evt.keyCode === 13) {
        if ($("#cod_personal").val().trim().length === 0) {
            let modal = dameContenido("paginas/modal-generico.php");
            let contenido = dameContenido("paginas/buscadores/buscadorPersonal.php");
            $("html").append(modal);
            $("#modal-generico").addClass("buscador-curriculum-personal");
            $("#contenido-modal").html(contenido);
            $("#modal-generico").modal("show");
        }
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".buscador-curriculum-personal .seleccionar-personal", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let nombre = $(this).closest("tr").find("td").filter(":eq(1)").text();
    let apellido = $(this).closest("tr").find("td").filter(":eq(2)").text();
    let cedula = $(this).closest("tr").find("td").filter(":eq(3)").text();

    $("#cod_personal").val(id);
    $("#nombre_personal").val(nombre);
    $("#apellido_personal").val(apellido);
    $("#cedula_personal").val(cedula);

    $("#cod_personal").attr('readonly', true);
    $("#modal-generico").modal("hide");
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cancelarPersonal() {
    $("#cod_personal").val("");
    $("#nombre_personal").val("");
    $("#apellido_personal").val("");
    $("#cedula_personal").val("");

    $("#cod_personal").removeAttr('readonly');
    $("#cod_personal").focus();

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarCurriculum() {
    if ($("#estado").val() === '0') {
        mensaje_dialogo_info("Debes seleccionar un estado", "ATENCION");
        return;
    }

    if ($("#nombre_personal").val().trim().length === 0) {
        mensaje_dialogo_info("Debes buscar un personal", "ATENCION");
        return;
    }
    
    if ($("#descripcion_personal").val().trim().length === 0) {
        mensaje_dialogo_info("Debes buscar una descripción", "ATENCION");
        return;
    }
    



    if ($("#id_curriculum").val() === "0") {

        let cur_existe = ejecutarAjax("controladores/curriculum.php",
                "existe_personal=" + $("#cod_personal").val());

        if (cur_existe !== '0') {
            mensaje_dialogo_info("El personal " + $("#nombre_personal").val() + " \n\
        ya ha sido registrado.", "ATENCION");
            return;
        }

        let curriculum = {
            'cur_fecha': $("#fecha").val(),
            'cur_des': $("#descripcion_personal").val(),
            'per_id': $("#cod_personal").val(),
            'estado': $("#estado").val()

        };

        let cur = ejecutarAjax("controladores/curriculum.php",
                "guardar=" + JSON.stringify(curriculum));

        let id = ejecutarAjax("controladores/curriculum.php",
                "ultimoID=1");

        //guardamos los academicos
        $("#academico_tb tr").each(function (evt) {
            let academico = {
                'cur_id': id,
                'lugar': $(this).find("td").filter(":eq(0)").text(),
                'periodo': $(this).find("td").filter(":eq(1)").text(),
                'descripcion': $(this).find("td").filter(":eq(2)").text()
            };
            let aca = ejecutarAjax("controladores/curriculum_academico.php",
                    "guardar=" + JSON.stringify(academico));

        });
        //guardamos las referencial laborales
        $("#academico_tb tr").each(function (evt) {
            let ref = {
                'cur_id': id,
                'nombre_apellido': $(this).find("td").filter(":eq(0)").text(),
                'telefono': $(this).find("td").filter(":eq(1)").text(),
                'descripcion': $(this).find("td").filter(":eq(2)").text()
            };
            let ref_lab = ejecutarAjax("controladores/curriculum_ref_laboral.php",
                    "guardar=" + JSON.stringify(ref));

        });

        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

        alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
            window.open("paginas/personal/imprimirCurriculum.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });


    } else {
        let curriculum = {
            'cur_fecha': $("#fecha").val(),
            'cur_des': $("#descripcion_personal").val(),
            'per_id': $("#cod_personal").val(),
            'estado': $("#estado").val(),
            'cur_id': $("#id_curriculum").val()

        };
        let cur = ejecutarAjax("controladores/curriculum.php",
                "actualizar=" + JSON.stringify(curriculum));

        cur = ejecutarAjax("controladores/curriculum_academico.php",
                "eliminar=" + $("#id_curriculum").val());

        cur = ejecutarAjax("controladores/curriculum_ref_laboral.php",
                "eliminar=" + $("#id_curriculum").val());


        let id = $("#id_curriculum").val();
        //guardamos los academicos
        $("#academico_tb tr").each(function (evt) {
            let academico = {
                'cur_id': id,
                'lugar': $(this).find("td").filter(":eq(0)").text(),
                'periodo': $(this).find("td").filter(":eq(1)").text(),
                'descripcion': $(this).find("td").filter(":eq(2)").text()
            };
            let aca = ejecutarAjax("controladores/curriculum_academico.php",
                    "guardar=" + JSON.stringify(academico));

        });
        //guardamos las referencial laborales
        $("#ref_laboral_tb tr").each(function (evt) {
            let ref = {
                'cur_id': id,
                'nombre_apellido': $(this).find("td").filter(":eq(0)").text(),
                'telefono': $(this).find("td").filter(":eq(1)").text(),
                'descripcion': $(this).find("td").filter(":eq(2)").text()
            };
            let ref_lab = ejecutarAjax("controladores/curriculum_ref_laboral.php",
                    "guardar=" + JSON.stringify(ref));

        });



        $("#id_curriculum").val("0");
        $("#modal-generico").modal("hide");

        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        cargarTablaConsultaCurriculum();

    }

//    console.log(cur);
    limpiarCurriculum();

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function limpiarCurriculum() {
    $("#cod_personal").val("");
    $("#nombre_personal").val("");
    $("#apellido_personal").val("");
    $("#cedula_personal").val("");
    $("#descripcion_personal").val("");
    $("#estado").val("0");

    $("#cod_personal").removeAttr('readonly');
    dameFechaActual("fecha");
    $("#fecha").attr('min', dameFechaActualSQL());

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#b_nombre_curriculum", function (evt) {
    if (evt.keyCode === 13) {
        cargarTablaConsultaCurriculum();
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cargarTablaConsultaCurriculum() {
    if ($("#b_nombre_curriculum").val().trim().length === 0) {
        $("#resultado_personal_tb").html("NO HAY RESULTADOS");
    } else {
        let curriculum = ejecutarAjax("controladores/curriculum.php",
                "b_nombre=" + $("#b_nombre_curriculum").val());

        if (curriculum === "0") {
            $("#resultado_personal_tb").html("NO HAY RESULTADOS");

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
                                <button class='btn btn-warning editar-curriculum'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-curriculum'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-curriculum'><i class="ti ti-printer"></i></button>
                            </td>`;
                fila += `</tr>`;
            });

            $("#curriculum_tb").html(fila);

        }

    }
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-curriculum", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    let curriculum = ejecutarAjax("controladores/curriculum.php",
            "id=" + id);

    let json_curriculum = JSON.parse(curriculum);

    let personal = ejecutarAjax("controladores/personal.php",
            "id=" + json_curriculum[0]['per_id']);

    let json_personal = JSON.parse(personal);
    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/personal/agregar-curriculum.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-curriculum");
    $("#contenido-modal").html(contenido);
    $(".actualizar-curriculum #id_curriculum").val(id);
    $(".actualizar-curriculum #fecha").val(json_curriculum[0]['cur_fecha']);
    $(".actualizar-curriculum #estado").val(json_curriculum[0]['estado']);
    $(".actualizar-curriculum #cod_personal").val(json_curriculum[0]['per_id']);
    $(".actualizar-curriculum #nombre_personal").val(json_personal[0]['per_nom']);
    $(".actualizar-curriculum #apellido_personal").val(json_personal[0]['per_apell']);
    $(".actualizar-curriculum #cedula_personal").val(json_personal[0]['cedula']);
    $(".actualizar-curriculum #descripcion_personal").val(json_curriculum[0]['cur_des']);
    $(".actualizar-curriculum .cancelar-btn").attr('hidden', true);

    //cargamos la tabla de academico
    let academico = ejecutarAjax("controladores/curriculum_academico.php",
            "id=" + id);

    if (academico === "0") {

    } else {
        let json_acacemico = JSON.parse(academico);
        let fila = ``;

        json_acacemico.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.lugar}</td>`;
            fila += `<td>${item.periodo}</td>`;
            fila += `<td>${item.descripcion}</td>`;
            fila += `<td><button class="btn-sm btn btn-danger remover-item"><i class="ti ti-close"></i></button></td>`;
            fila += `</tr>`;
        });
        $("#academico_tb").html(fila);
    }
    let laborales = ejecutarAjax("controladores/curriculum_ref_laboral.php",
            "id=" + id);

    if (laborales === "0") {

    } else {
        let json_laborales = JSON.parse(laborales);
        let fila = ``;

        json_laborales.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.nombre_apellido}</td>`;
            fila += `<td>${item.telefono}</td>`;
            fila += `<td>${item.descripcion}</td>`;
            fila += `<td><button class="btn-sm btn btn-danger remover-item"><i class="ti ti-close"></i></button></td>`;
            fila += `</tr>`;
        });
        $("#ref_laboral_tb").html(fila);
    }
    
    
    
    $("#modal-generico").modal("show");
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-curriculum", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {
        let cur = ejecutarAjax("controladores/curriculum.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        cargarTablaConsultaCurriculum();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-curriculum", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/personal/imprimirCurriculum.php?id=" + id);
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
function agregarAcademico() {
    if ($("#lugar").val().trim().length === 0) {
        mensaje_dialogo_info("Debes agregar un lugar para los datos académicos",
                "ATENCION");
        return;
    }


    if ($("#periodo").val().trim().length === 0) {
        mensaje_dialogo_info("Debes agregar un periodo para los datos académicos",
                "ATENCION");
        return;

    }
    if ($("#descripcion_academico").val().trim().length === 0) {
        mensaje_dialogo_info("Debes agregar una descripción para los datos académicos",
                "ATENCION");
        return;
    }

    let fila = ``;
    fila += `<tr>`;
    fila += `<td>${$("#lugar").val()}</td>`;
    fila += `<td>${$("#periodo").val()}</td>`;
    fila += `<td>${$("#descripcion_academico").val()}</td>`;
    fila += `<td><button class="btn-sm btn btn-danger remover-item"><i class="ti ti-close"></i></button></td>`;
    fila += `</tr>`;


    $("#academico_tb").append(fila);

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function agregarRefLaboral() {
    if ($("#nombre_apellido_lab").val().trim().length === 0) {
        mensaje_dialogo_info("Debes agregar un nombre y apellido para los datos  de referencia laboral",
                "ATENCION");
        return;
    }
    if ($("#telefono_lab").val().trim().length === 0) {
        mensaje_dialogo_info("Debes agregar un telefono para los datos  de referencia laboral",
                "ATENCION");
        return;
    }
    if ($("#descripcion_lab").val().trim().length === 0) {
        mensaje_dialogo_info("Debes agregar una descripción para los datos  de referencia laboral",
                "ATENCION");
        return;
    }

    let fila = ``;
    fila += `<tr>`;
    fila += `<td>${$("#nombre_apellido_lab").val()}</td>`;
    fila += `<td>${$("#telefono_lab").val()}</td>`;
    fila += `<td>${$("#descripcion_lab").val()}</td>`;
    fila += `<td><button class="btn-sm btn btn-danger remover-item"><i class="ti ti-close"></i></button></td>`;
    fila += `</tr>`;


    $("#ref_laboral_tb").append(fila);

}