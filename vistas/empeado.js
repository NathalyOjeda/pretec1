function mostrarEmpleado() {
    var contenido = dameContenido("paginas/personal/empleado.php");
    $("#contenido-page").html(contenido);
    contenido = dameContenido("paginas/personal/agregar-empleado.php");
    $("#contenido-curriculum").html(contenido);
    dameFechaActual("fecha");
    $("#fecha").attr('min', dameFechaActualSQL());

}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarEmpleado() {
    var contenido = dameContenido("paginas/personal/agregar-empleado.php");
    $("#contenido-empleado").html(contenido);
    dameFechaActual("fecha_ingreso");
    dameFechaActual("fecha_baja");
    $("#fecha_ingreso").attr('min', dameFechaActualSQL());
    $("#fecha_baja").attr('min', dameFechaActualSQL());
    cargarListaSucursal("#sucursal_lst");
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarEmpleado() {
    var contenido = dameContenido("paginas/personal/consultar-empleado.php");
    $("#contenido-empleado").html(contenido);

}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("keyup", "#cod_curriculum", function (evt) {
    if (evt.keyCode === 13) {
        if ($("#cod_curriculum").val().trim().length === 0) {
            let modal = dameContenido("paginas/modal-generico.php");
            let contenido = dameContenido("paginas/buscadores/buscadorCurriculum.php");
            $("html").append(modal);
            $("#modal-generico").addClass("buscador-curriculum-personal");
            $("#contenido-modal").html(contenido);
            $("#modal-generico").modal("show");
        }
    }
});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".buscador-curriculum-personal .seleccionar-curriculum", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();
    let nombre = $(this).closest("tr").find("td").filter(":eq(1)").text();
    let cedula = $(this).closest("tr").find("td").filter(":eq(2)").text();

    $("#cod_curriculum").val(id);
    $("#nombre_personal").val(nombre);
    $("#cedula_personal").val(cedula);
    $("#cod_curriculum").attr("readonly", true);
    $("#modal-generico").modal("hide");


});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cancelarCurriculum() {
    $("#cod_curriculum").val("");
    $("#nombre_personal").val("");
    $("#cedula_personal").val("");

    $("#cod_curriculum").removeAttr('readonly');
    $("#cod_curriculum").focus();

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarEmpleado() {
    if ($("#estado").val() === '0') {
        mensaje_dialogo_info("Debes seleccionar un estado", "ATENCION");
        return;
    }

    if ($("#nombre_personal").val().trim().length === 0) {
        mensaje_dialogo_info("Debes buscar un personal", "ATENCION");
        return;
    }
    if ($("#sucursal_lst").val() === "0") {
        mensaje_dialogo_info("Debes seleccionar una sucursal", "ATENCION");
        return;
    }






    if ($("#id_empleado").val() === "0") {

        let cur_existe = ejecutarAjax("controladores/empleado.php",
                "id_existe=" + $("#cod_curriculum").val());

        if (cur_existe !== '0') {
            mensaje_dialogo_info("El curriculum ya ha sido registrado  ya ha sido registrado.", "ATENCION");
            return;
        }

        let empleado = {
            'func_ingreso': $("#fecha_ingreso").val(),
            'cur_id': $("#cod_curriculum").val(),
            'suc_id': $("#sucursal_lst").val(),
            'estado': $("#estado").val()

        };

        let cur = ejecutarAjax("controladores/empleado.php",
                "guardar=" + JSON.stringify(empleado));

        console.log(cur);
        let id = ejecutarAjax("controladores/empleado.php",
                "ultimoID=1");

        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

        alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
            window.open("paginas/personal/imprimirEmpleado.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    } else {
        
        
        
        let empleado = {
            'func_ingreso': $("#fecha_ingreso").val(),
            'func_baja': ($("#fecha_baja").val().trim().length === 0) ? null : $("#fecha_baja").val(),
            'cur_id': $("#cod_curriculum").val(),
            'suc_id': $("#sucursal_lst").val(),
            'func_id': $("#id_empleado").val(),
            'estado': $("#estado").val()

        };
        let cur = ejecutarAjax("controladores/empleado.php",
                "actualizar=" + JSON.stringify(empleado));
//        console.log(cur);
        $("#id_empleado").val("0");
        $("#modal-generico").modal("hide");

        mensaje_dialogo_info("Actualizado Correctamente", "EXITOSO");
        cargarTablaConsultaEmpleado();
//        cargarTablaConsultaCurriculum();

    }
    limpiarEmpleado();

//    console.log(cur);
//    limpiarCurriculum();
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarEmpleado() {
    dameFechaActual("fecha_ingreso");
    dameFechaActual("fecha_baja");
    $("#fecha_ingreso").attr('min', dameFechaActualSQL());
    $("#fecha_baja").attr('min', dameFechaActualSQL());
    cargarListaSucursal("#sucursal_lst");
    $("#cod_curriculum").val("");
    $("#nombre_personal").val("");
    $("#cedula_personal").val("");

    $("#cod_curriculum").removeAttr('readonly');
    $("#cod_curriculum").focus();
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#b_nombre_empleado", function (evt) {
    if (evt.keyCode === 13) {
        cargarTablaConsultaEmpleado();
    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function cargarTablaConsultaEmpleado() {
    if ($("#b_nombre_empleado").val().trim().length === 0) {
        $("#empleado_tb").html("NO HAY RESULTADOS");
    } else {
        let curriculum = ejecutarAjax("controladores/empleado.php",
                "b_nombre=" + $("#b_nombre_empleado").val());
//        console.log(curriculum);
        if (curriculum === "0") {
            $("#empleado_tb").html("NO HAY RESULTADOS");

        } else {
            let fila = ``;
            let json_curr = JSON.parse(curriculum);
            json_curr.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.func_id}</td>`;
                fila += `<td>${item.personal}</td>`;
                fila += `<td>${item.cedula}</td>`;
                fila += `<td>${item.func_ingreso}</td>`;
                fila += `<td>${item.func_baja}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
                                <button class='btn btn-warning editar-empleado'><i class="ti ti-pencil"></i></button>
                                <button class='btn btn-danger anular-empleado'><i class="ti ti-trash"></i></button>
                                <button class='btn btn-primary imprimir-empleado'><i class="ti ti-printer"></i></button>
                            </td>`;
                fila += `</tr>`;
            });

            $("#empleado_tb").html(fila);

        }

    }
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("click", ".editar-empleado", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    let empleado = ejecutarAjax("controladores/empleado.php",
            "id=" + id);
    console.log(empleado);
    let json_empleado = JSON.parse(empleado);

    $("#modal-generico").remove();
    let contenido = dameContenido("paginas/personal/agregar-empleado.php");
    let modal = dameContenido("paginas/modal-generico.php");
    $("html").append(modal);
    $("#modal-generico").addClass("actualizar-empleado");
    $("#contenido-modal").html(contenido);
    $(".actualizar-empleado #id_empleado").val(id);
    $(".actualizar-empleado #fecha_ingreso").val(json_empleado[0]['func_ingreso']);
    $(".actualizar-empleado #fecha_baja").val(json_empleado[0]['func_baja']);
    $(".actualizar-empleado #estado").val(json_empleado[0]['estado']);
    $(".actualizar-empleado #cod_curriculum").val(json_empleado[0]['cur_id']);
    $(".actualizar-empleado #nombre_personal").val(json_empleado[0]['per_nom']);
    $(".actualizar-empleado #apellido_personal").val(json_empleado[0]['per_apell']);
    $(".actualizar-empleado #cedula_personal").val(json_empleado[0]['cedula']);
    cargarListaSucursal(".actualizar-empleado #sucursal_lst");
    $(".actualizar-empleado #sucursal_lst").val(json_empleado[0]['suc_id']);
    $(".actualizar-empleado .cancelar-btn").attr('hidden', true);
    $("#modal-generico").modal("show");
});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".anular-empleado", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea anular el registro?', function () {
        let cur = ejecutarAjax("controladores/empleado.php",
                "anular=" + id);
        mensaje_dialogo_info("Anulado Correctamente", "EXITOSO");
        cargarTablaConsultaEmpleado();
        alertify.success('Anulado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".imprimir-empleado", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea imprimir el registro?', function () {
        window.open("paginas/personal/imprimirEmpleado.php?id=" + id);
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#b_nombre_empleados", function () {
   if ($("#b_nombre_empleados").val().trim().length === 0) {
        $("#resultado_empleado_tb").html("NO HAY RESULTADOS");
    } else {
        let empleado = ejecutarAjax("controladores/empleado.php",
                "b_nombre=" + $("#b_nombre_empleados").val());
//        console.log(curriculum);
        if (empleado === "0") {
            $("#resultado_empleado_tb").html("NO HAY RESULTADOS");

        } else {
            let fila = ``;
            let json_curr = JSON.parse(empleado);
            json_curr.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.func_id}</td>`;
                fila += `<td>${item.personal}</td>`;
                fila += `<td>${item.cedula}</td>`;
                fila += `<td>${item.func_ingreso}</td>`;
                fila += `<td>${item.func_baja}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td>
                                <button class='btn btn-primary seleccionar-empleado-busqueda'>Seleccionar</button>
                            </td>`;
                fila += `</tr>`;
            });

            $("#resultado_empleado_tb").html(fila);

        }

    } 
});
    
