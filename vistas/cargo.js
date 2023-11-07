

function mostrarCargo() {
    var contenido = dameContenido("paginas/referenciales/cargo.php");
    $("#contenido-page").html(contenido);
    cargarTablaCargo();
    
    }
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------





function guardarCargo() {


    var descripcion = "", activo = "";

    if ($("#id_cargo").val() === '0') {

        descripcion = $("#cargo_descripcion").val();
        activo = $("#cargo_estado").val();

        if (descripcion.trim().length === 0) {
            alert("DEBE INGRESAR UNA DESCRIPCION");
            $("#cargo_descripcion").focus();
            return;

        }

      

        var lista = {
            'descripcion': descripcion,
            'salario': $("#cargo_salario").val(),
            'estado': activo
          
        };



        // Definición de la función soloTexto
function soloTexto(e) {
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex = /^[\ba-zA-Z\s-]$/;
    if (AllowRegex.test(character)) return true;
    return false;
}



         //QUE NO GUARDE SIN AGREGAR SALARIO 
        var salario = $("#cargo_salario").val();
        if (salario.trim().length === 0 || isNaN(parseFloat(salario))) {
            alert("DEBE INGRESAR EL SALARIO");
            $("#cargo_salario").focus();
            return;
        }

         // Validación para el salario
        var salario = $("#cargo_salario").val();

        if (isNaN(salario) || salario.trim() === "" || salario.includes("-")) {
            alert("NO ACEPTA NUMEROS NEGATIVOS");
            $("#cargo_salario").focus();
            return;
        }




        var existe = ejecutarAjax("controladores/cargo.php", "b_nombre_exacto=" + descripcion.trim());
        if (existe === '0') {
            let r = ejecutarAjax("controladores/cargo.php", "guardar=" + JSON.stringify(lista));
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

        descripcion = $('.modal-editar-cargo #cargo_descripcion').val();
        activo = $('.modal-editar-cargo #cargo_estado').val();

        if (descripcion.trim().length === 0) {
            mensaje_dialogo_info("DEBE INGRESAR LA DESCRIPCION", "ATENCION");
            $('.modal-editar-cargo #cargo_descripcion').focus();
            return;

        }
        var lista = {
            'descripcion': descripcion,
            'estado': activo,
            'salario': $("#cargo_salario").val(),
            'id_cargo': $("#id_cargo").val()
        };

        console.log($("#nombre_antiguo_cargo").val().trim());
        console.log($(".modal-editar-cargo #cargo_descripcion").val().trim());
        if ($("#nombre_antiguo_cargo").val().trim() !== $(".modal-editar-cargo #cargo_descripcion").val().trim()) {

            var existe = ejecutarAjax("controladores/cargo.php", "b_nombre_exacto=" + descripcion.trim());

            if (existe !== '0') {
                alertify.alert('WARNING', "El registro ya existe!");
                return;
            } else {
                ejecutarAjax("controladores/cargo.php", "actualizar=" + JSON.stringify(lista));
                $("#id_cargo").val("0");

                alertify.alert(
                        'INFORMACION',
                        'Actualizado correctamente!',
                        function ()
                        {
                            alertify.success('Actualizado');
                        });
            }
        } else {
            ejecutarAjax("controladores/cargo.php", "actualizar=" + JSON.stringify(lista));
            $("#id_cargo").val("0");
            alertify.alert(
                    'INFORMACION',
                    'Actualizado correctamente!',
                    function ()
                    {
                        alertify.success('Actualizado');
                    });
        }




    }
    //Guardar mediante enter tambien 
    $("#cargo_salario").keydown(function (event) {
        if (event.keyCode === 13) { // Verifica si la tecla presionada es "Enter" (código 13)
            event.preventDefault(); // Evita que se envíe el formulario por defecto
            guardarCargo(); // Llama a la función guardarCargo para guardar los datos
        }
    });


    cargarTablaCargo();
    limpiarCampoCargo();
    $("#modal-generico").modal("hide");






}
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
function cargarTablaCargo() {
    var lista = ejecutarAjax("controladores/cargo.php",
            "dame_todo=1");

    var fila = "";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.car_id}</td>`;
            fila += `<td>${item.car_descri}</td>`;
            fila += `<td>${formatearNumero(item.salario)}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td><button class='btn btn-warning editar-cargo'>Editar</button>
             <button class='btn btn-danger eliminar-cargo'>Eliminar</button></td>`;
            fila += `</tr>`;
        });

    }
    $("#cargo_tb").html(fila);
}







//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function limpiarCampoCargo() {

    $("#cargo_descripcion").val("");
    $("#cargo_estado").val("1");
    $("#cargo_salario").val("");

}
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("click", ".editar-cargo", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();

//    console.log(id);

    var registro = ejecutarAjax("controladores/cargo.php",
            "id=" + id);

    if (registro === '0') {

    } else {
        var json_color = JSON.parse(registro);

        var modal = dameContenido("paginas/modal-generico.php");
        var contenido = dameContenido("paginas/referenciales/cargo.php");
        $("#modal-generico").remove();
        $("html").append(modal);
        $("#modal-generico").addClass("modal-editar-cargo");
        $("#contenido-modal").html(contenido);

        $(".modal-title").text("Editar Registro");
        $(".modal-editar-cargo #tabla").remove();


        $(".modal-editar-cargo #cargo_descripcion").val(json_color[0]['car_descri']);
        $(".modal-editar-cargo #cargo_estado").val(json_color[0]['estado']);
        $(".modal-editar-cargo #cargo_salario").val(json_color[0]['salario']);
        $("#id_cargo").val(json_color[0]['car_id']);
        $("#nombre_antiguo_departamento").val(json_color[0]['car_descri']);

        $("#modal-generico").modal("show");

    }
});
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$(document).on("click", ".eliminar-cargo", function (evt) {
    var tr = $(this).closest("tr");
    var id = $(tr).find("td").filter(":eq(0)").text();
    alertify.confirm('ATENCION', 'Desea eliminar el registro?',
            function () {
                var r = ejecutarAjax
                        ("controladores/cargo.php",
                                "eliminar=" + id);
                console.log(r);
                if (r.includes("Cannot delete or update a parent row: a foreign key constraint fails")) {
                    var r = ejecutarAjax
                            ("controladores/cargo.php",
                                    "desactivar=" + id);
                }

                alertify.success('Eliminado');
                cargarTablaCargo();
            }
    , function () {
        alertify.error('Cancelado');
    });
});
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

$(document).on("keyup", "#b_nombre_cargo", function (evt) {
    if (evt.keyCode === 13) {
        var lista = ejecutarAjax("controladores/cargo.php", "b_nombre=" + $(this).val().trim());
        console.log(lista);
        var fila = "";

        if (lista === '0') {
            fila = 'No hay registros';
        } else {
            var json_lista = JSON.parse(lista);
            json_lista.map(function (item) {
                fila += `<tr>`;
                fila += `<td>${item.car_id}</td>`;
                fila += `<td>${item.car_descri}</td>`;
                fila += `<td>${formatearNumero(item.salario)}</td>`;
                fila += `<td>${item.estado}</td>`;
                fila += `<td><button class='btn btn-warning editar-cargo'>Editar</button>
             <button class='btn btn-danger eliminar-cargo'>Eliminar</button></td>`;
                fila += `</tr>`;
            });

        }
        $("#cargo_tb").html(fila);
    }

});

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function cargarListaCargo(componente) {
    var lista = ejecutarAjax("controladores/cargo.php",
        "dame_activos=1");

    var fila = "<option value='0'>Selecciona un cargo</option>";

    if (lista === '0') {
        fila = 'No hay registros';
    } else {
        var json_lista = JSON.parse(lista);
        json_lista.map(function (item) {
            fila += `<option value='${item.car_id}'>${item.car_descri}</option>`;
        });

    }
    $(componente).html(fila);
}

