function mostrarPersonal() {
    var contenido = dameContenido("paginas/referenciales/personal.php");
    $("#contenido-page").html(contenido);
    dameFechaActual("personal_fecha_nacimiento");
    cargarTablaPersonal();
}

//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
function guardarPersonal() {

    if ($("#id_personal").val() === '0') {

        if (!validarCampoDeTextoID("personal_nombre", "DEBES INGRESAR UN NOMBRE"))
            return;
        if (!validarCampoDeTextoID("personal_apellido", "DEBES INGRESAR UN APELLIDO"))
            return;
        if (!validarCampoDeTextoID("personal_direccion", "DEBES INGRESAR UNA DIRECCION"))
            return;
        if (!validarCampoDeTextoID("personal_ciudad", "DEBES INGRESAR UNA CIUDAD"))
            return;
        if (!validarCampoDeTextoID("personal_correo", "DEBES INGRESAR UN CORREO"))
            return;
        if (!validarCampoDeTextoID("personal_telefono", "DEBES INGRESAR UN NUMERO DE TELEFONO"))
            return;


        var lista = {
            'nombre': $("#personal_nombre").val(),
            'apellido': $("#personal_apellido").val(),
            'cedula': $("#personal_cedula").val(),
            'fecha_nacimiento': $("#personal_fecha_nacimiento").val(),
            'direccion': $("#personal_direccion").val(),
            'genero': $("#personal_genero").val(),
            'ciudad': $("#personal_ciudad").val(),
            'nacion': $("#personal_nacion").val(),
            'estado_civil': $("#personal_estado_civil").val(),
            'correo': $("#personal_correo").val(),
            'telefono': $("#personal_telefono").val()

        };

        var existe = ejecutarAjax("controladores/personal.php", "b_nombre_exacto=" + ($("#personal_cedula").val()));
        if (existe === '0') {
            var r = ejecutarAjax("controladores/personal.php", "guardar=" + JSON.stringify(lista));
            console.log(r);
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

//        descripcion = $('.modal-editar-departamento #departamentos_descripcion').val();
//        activo = $('.modal-editar-departamento #departamento_estado').val();

        if (!validarCampoDeTextoComponente(".modal-editar-personal #personal_nombre", "DEBES INGRESAR UN NOMBRE"))
            return;
        if (!validarCampoDeTextoComponente(".modal-editar-personal #personal_apellido", "DEBES INGRESAR UN APELLIDO"))
            return;
        if (!validarCampoDeTextoComponente(".modal-editar-personal #personal_direccion", "DEBES INGRESAR UNA DIRECCION"))
            return;
        if (!validarCampoDeTextoComponente(".modal-editar-personal #personal_ciudad", "DEBES INGRESAR UNA CIUDAD"))
            return;
        if (!validarCampoDeTextoComponente(".modal-editar-personal #personal_correo", "DEBES INGRESAR UN CORREO"))
            return;
        if (!validarCampoDeTextoComponente(".modal-editar-personal #personal_telefono", "DEBES INGRESAR UN NUMERO DE TELEFONO"))
            return;

        var lista = {
            'id_personal': $("#id_personal").val(),
            'nombre': $(".modal-editar-personal #personal_nombre").val(),
            'apellido': $(".modal-editar-personal #personal_apellido").val(),
            'cedula': $(".modal-editar-personal #personal_cedula").val(),
            'fecha_nacimiento': $(".modal-editar-personal #personal_fecha_nacimiento").val(),
            'direccion': $(".modal-editar-personal #personal_direccion").val(),
            'genero': $(".modal-editar-personal #personal_genero").val(),
            'ciudad': $(".modal-editar-personal #personal_ciudad").val(),
            'nacion': $(".modal-editar-personal #personal_nacion").val(),
            'estado_civil': $(".modal-editar-personal #personal_estado_civil").val(),
            'correo': $(".modal-editar-personal #personal_correo").val(),
            'telefono': $(".modal-editar-personal #personal_telefono").val()

        };

        let nombre_apellido = $(".modal-editar-personal #personal_cedula").val();


        if ($("#nombre_antiguo_personal").val().trim() !== nombre_apellido.trim()) {

            var existe = ejecutarAjax("controladores/personal.php", "b_nombre_exacto=" + nombre_apellido.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/personal.php", "actualizar=" + JSON.stringify(lista));
                $("#id_personal").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/personal.php", "actualizar=" + JSON.stringify(lista));
            $("#id_personal").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }

    cargarTablaPersonal();
    limpiarCampoPersonal();
    $("#modal-generico").modal("hide");


}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaPersonal() {
    var lista = ejecutarAjax("controladores/personal.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.per_id}</td>`;
            fila += `<td>${item.per_nom}</td>`;
            fila += `<td>${item.per_apell}</td>`;
            fila += `<td>${item.cedula}</td>`;
            fila += `<td>${item.per_nacim}</td>`;
            fila += `<td>${item.per_direc}</td>`;
            fila += `<td>${item.per_genero}</td>`;
            fila += `<td>${item.per_ciud}</td>`;
            fila += `<td>${item.per_nacion}</td>`;
            fila += `<td>${item.per_est_civ}</td>`;
            fila += `<td>${item.per_correo}</td>`;
            fila += `<td>${item.per_telfono}</td>`;
            fila += `<td><button class='btn btn-warning editar-personal'>Editar</button>
             <button class='btn btn-danger eliminar-personal'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#personal_tb").html(fila);
}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoPersonal() {
    $("#personal_nombre").val("");
    $("#personal_apellido").val("");
    dameFechaActual("personal_fecha_nacimiento");
    $("#personal_direccion").val("");
    $("#personal_genero").val("MASCULINO");
    $("#personal_ciudad").val("");
    $("#personal_nacion").val("");
    $("#personal_estado_civil").val("SOLTERO");
    $("#personal_correo").val("");
    $("#personal_telefono").val("");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-personal", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/personal.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_objeto = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/personal.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-personal");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-personal #tabla").remove();


        $(".modal-editar-personal #personal_nombre").val(json_objeto[0]['per_nom']);
        $(".modal-editar-personal #personal_apellido").val(json_objeto[0]['per_apell']);
        $(".modal-editar-personal #personal_cedula").val(json_objeto[0]['cedula']);
        $(".modal-editar-personal #personal_fecha_nacimiento").val(json_objeto[0]['per_nacim']);
        $(".modal-editar-personal #personal_direccion").val(json_objeto[0]['per_direc']);
        $(".modal-editar-personal #personal_genero").val(json_objeto[0]['per_genero']);
        $(".modal-editar-personal #personal_ciudad").val(json_objeto[0]['per_ciud']);
        $(".modal-editar-personal #personal_nacion").val(json_objeto[0]['per_nacion']);
        $(".modal-editar-personal #personal_estado_civil").val(json_objeto[0]['per_est_civ']);
        $(".modal-editar-personal #personal_correo").val(json_objeto[0]['per_correo']);
        $(".modal-editar-personal #personal_telefono").val(json_objeto[0]['per_telfono']);
        $("#nombre_antiguo_personal").val(json_objeto[0]['cedula']);
        $("#id_personal").val(json_objeto[0]['per_id']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-personal", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/personal.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/personal.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaPersonal();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#personal_busqueda_nombre", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/personal.php", "b_nombre=" + $(this).val().trim());
//        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.per_id}</td>`;
                fila += `<td>${item.per_nom}</td>`;
                fila += `<td>${item.per_apell}</td>`;
                fila += `<td>${item.cedula}</td>`;
                fila += `<td>${item.per_nacim}</td>`;
                fila += `<td>${item.per_direc}</td>`;
                fila += `<td>${item.per_genero}</td>`;
                fila += `<td>${item.per_ciud}</td>`;
                fila += `<td>${item.per_nacion}</td>`;
                fila += `<td>${item.per_est_civ}</td>`;
                fila += `<td>${item.per_correo}</td>`;
                fila += `<td>${item.per_telfono}</td>`;
                fila += `<td><button class='btn btn-warning editar-personal'>Editar</button>
             <button class='btn btn-danger eliminar-personal'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#personal_tb").html(fila);
    }

});

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
$(document).on("keyup", "#b_nombre_cliente", function (evt) {
    let nombre = $(this).val();

    if (nombre.trim().length === 0) {
        $("#resultado_personal_tb").html("NO HAY RESULTADOS");
        
    } else {
        let personales = ejecutarAjax("controladores/personal.php",
                "b_nombre=" + nombre);
        if (personales === '0') {
            $("#resultado_personal_tb").html("NO HAY RESULTADOS");
        } else {
            let json_personales = JSON.parse(personales);
            let fila = "";
            json_personales.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.per_id}</td>`;
                fila += `<td>${item.per_nom}</td>`;
                fila += `<td>${item.per_apell}</td>`;
                fila += `<td>${item.cedula}</td>`;
                fila += `<td><button class='btn btn-primary seleccionar-personal'>Seleccionar</button></td>`;
                fila += `</tr>`;
            });
            
            $("#resultado_personal_tb").html(fila);
        }
    }
});