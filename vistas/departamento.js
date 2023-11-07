function mostrarDepartamento() {
    var contenido = dameContenido("paginas/referenciales/departamento.php");
    $("#contenido-page").html(contenido);
    cargarTablaDepartamento();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarDepartamento() {
    var descripcion = "", activo = "";

    if ($("#id_departamento").val() === '0') {

        descripcion = $("#departamentos_descripcion").val();
        activo = $("#departamento_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#departamentos_descripcion").focus();
            return;

        }

        var lista = {
            'descripcion': descripcion,
            'estado': activo
        };

        var existe = ejecutarAjax("controladores/departamento.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            ejecutarAjax("controladores/departamento.php", "guardar=" + JSON.stringify(lista));
            alertify.alert(
                    'INFORMACION',
                    'Guardado correctamente!',
                    function ()
                    {
                        alertify.success('Guardado');
                    });

        } else {
            alertify.alert('WARNING', "El registro ya existe!");
            return;
        }





    } else {

        descripcion = $('.modal-editar-departamento #departamentos_descripcion').val();
        activo = $('.modal-editar-departamento #departamento_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-departamento #departamentos_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'id_departamento': $("#id_departamento").val()
        };


        if ($("#nombre_antiguo_departamento").val().trim() !== $(".modal-editar-departamento #departamentos_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/departamento.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/departamento.php", "actualizar=" + JSON.stringify(lista));
                $("#id_departamento").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/departamento.php", "actualizar=" + JSON.stringify(lista));
            $("#id_departamento").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaDepartamento();
    limpiarCampoDepartamento();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaDepartamento() {
    var lista = ejecutarAjax("controladores/departamento.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.dep_id}</td>`;
            fila += `<td>${item.dep_descri}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-departamento'>Editar</button>
             <button class='btn btn-danger eliminar-departamento'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#departamento_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoDepartamento() {

    $("#departamentos_descripcion").val("");
    $("#departamento_estado").val("1");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-departamento", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/departamento.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/departamento.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-departamento");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-departamento #tabla").remove();


        $(".modal-editar-departamento #departamentos_descripcion").val(json_color[0]['dep_descri']);
        $(".modal-editar-departamento #departamento_estado").val(json_color[0]['estado']);
        $("#id_departamento").val(json_color[0]['dep_id']);
        $("#nombre_antiguo_departamento").val(json_color[0]['dep_descri']);

        $("#modal-generico").modal("show");

    }
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#departamentos_busqueda_nombre", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/departamento.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.dep_id}</td>`;
                fila += `<td>${item.dep_descri}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-departamento'>Editar</button>
             <button class='btn btn-danger eliminar-departamento'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#departamento_tb").html(fila);
    }

});
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaDepartamento(componente) {
    var lista = ejecutarAjax("controladores/departamento.php",
            "dame_activos=1");

    var fila = "<option value='0'>Selecciona un departamento</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
           fila += `<option value='${item.dep_id}'>${item.dep_descri}</option>`;
        });

    }
    $(componente).html(fila);
}