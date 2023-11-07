// Validacion solo texto en un campo

 $("#miInput").on("input", function() {
                var inputValue = $(this).val();
                var regex = /^[a-zA-Z\s]*$/; // Expresión regular para texto (incluyendo espacios)
                if (!regex.test(inputValue)) {
                    $("#errorMensaje").text("Solo se permiten letras y espacios en blanco.");
                } else {
                    $("#errorMensaje").text("");
                }
});

//Validacion solo numeros

$("#miInput").on("input", function() {
                var inputValue = $(this).val();
                var regex = /^[0-9]*$/; // Expresión regular para números
                if (!regex.test(inputValue)) {
                    $("#errorMensaje").text("Solo se permiten números.");
                } else {
                    $("#errorMensaje").text("");
                }
});

//Validacion fecha (orden) y dia y mes dentro del rango
$("#fechaInput").on("blur", function() {
                var inputValue = $(this).val();
                var regex = /^(0[1-9]|[12]\d|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/; // Expresión regular para formato dd/mm/yyyy

                if (!regex.test(inputValue)) {
                    $("#errorMensaje").text("Formato de fecha no válido.");
                } else {
                    var parts = inputValue.split('/');
                    var day = parseInt(parts[0], 10);
                    var month = parseInt(parts[1], 10);

                    if (day < 1 || day > 31 || month < 1 || month > 12) {
                        $("#errorMensaje").text("Los días deben estar entre 1 y 31, y los meses entre 1 y 12.");
                    } else {
                        $("#errorMensaje").text("");
                    }
                }
});

/// no aceptar valores de numeros negativos, resalto que es para una validacion nueva donde no exita nada de validaciones 
var nombredelcampo = $("#iddeinterfaz").val();
if (isNaN(nombredelcampo) || nombredelcampo.trim() === "" || nombredelcampo.includes("-")) {
    alert("NO ACEPTA NUMEROS NEGATIVOS");
    $("#iddeinterfaz").focus();
    return;
}

// no aceptar valores de numeros negativos, resalto que es para una validaciondonde ya exista validacion
if(isNaN(nombredelcampo) || nombredelcampo.trim() === "" || nombredelcampo.includes("-")) {
    alert("NO ACEPTA NUMEROS NEGATIVOS");
    $("#iddeinterfaz").focus();
    return;
}
// este sirve para agregar algun campo de filtro dentro de alguna interfaz
<div class="col-md-3">
    <label for="nombre_busqueda">Buscar por nombre</label>
    <input type="text" id="nombre_busqueda" class="form-control" placeholder="Nombre del empleado">
</div>


//este codigo sirve para campos donde no debe de contener numeros en campos donde solo es letra

$(document).ready(function () {
    $("#justificacion_permiso_descripcion").on("input", function () {
        var descripcion = $(this).val();
        var contieneNumeros = /\d/.test(descripcion);
        if (contieneNumeros) {
            alert("Este campo solo puede contener letras.");
            // Elimina los números ingresados
            $(this).val(descripcion.replace(/\d/g, ''));
        }
    });
});