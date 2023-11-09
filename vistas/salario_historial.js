function mostrarSalaroHistorial() {
    var contenido = dameContenido("paginas/personal/salario.php");
    $("#contenido-page").html(contenido);

}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarAgregarSalaroHistorial() {
    var contenido = dameContenido("paginas/personal/agregar-salario.php");
    $("#contenido-salario").html(contenido);
    dameFechaActual("fecha");
    

}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function mostrarConsultarSalaroHistorial() {
    var contenido = dameContenido("paginas/personal/consultar-salario.php");
    $("#contenido-salario").html(contenido);
    dameFechaActual("desde_dt");
    dameFechaActual("hasta_dt");
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
function guardarHistorialSalario() {


    if ($("#id_contrato").val() === "0") {
        mensaje_dialogo_info("Debes buscar un empleado", "ATENCION");
        return;
    }
    


   if(quitarDecimalesConvertir($("#salario_anterior").val()) >= quitarDecimalesConvertir($("#salario").val())){
       mensaje_dialogo_info("El salario nuevo no puede ser menor o igual al salario anterior", "ATENCION");
        return;
   }


        let salario = {

            'con_id': $("#id_contrato").val(),
            'fecha': $("#fecha").val(),
            'monto': quitarDecimalesConvertir($("#salario").val()),
            'estado': 'ACTIVO'
           
        };

        let res = ejecutarAjax("controladores/historial_salario.php",
                "desactivar_anteriores=" + $("#id_contrato").val());
        console.log(res);
                
        res = ejecutarAjax("controladores/historial_salario.php",
                "guardar=" + JSON.stringify(salario));
        console.log(res);

        res = ejecutarAjax("controladores/contrato.php",
                "actualizar_salario="+JSON.stringify({
                    'salario' : quitarDecimalesConvertir($("#salario").val()),
                    'con_id' : $("#id_contrato").val()
                }));
        console.log(res);
                
                
        mensaje_dialogo_info("Guardado Correctamente", "EXITOSO");

        alertify.confirm('ANTENCION', 'Desea imprimir el Informe individual?', function () {
            //window.open("paginas/planillas/imprimirSalario.php?id=" + id);
        }
        , function () {
            alertify.error('Operación cancelada');
        });
    

    


}

//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
function buscarHistorialSalario(){
    
    let data = ejecutarAjax("controladores/historial_salario.php", 
    "buscar_salario="+JSON.stringify({
        'desde' : $("#desde_dt").val(),
        'hasta' : $("#hasta_dt").val(),
        'con_id' : $("#id_contrato").val()
    }));
    
    console.log(data);
    let fila = "";
    if(data === "0"){
        fila = "NO HAY RESULTADOS";
    }else{
        let json_data = JSON.parse(data);
        json_data.map(function (item) {
            fila += `<tr>`;
            fila += `<td>${item.id_historial_salario}</td>`;
            fila += `<td>${item.fecha}</td>`;
            fila += `<td>${formatearNumero(item.monto)}</td>`;
            fila += `<td>${item.estado}</td>`;
            fila += `<td>
                        <button class='btn btn-danger eliminar-historial'><i class="ti ti-trash"></i></button>
                    </td>`;
            fila += `</tr>`;
        });
    }
    $("#salario_tb").html(fila);
}
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------------------
$(document).on("click", ".eliminar-historial", function (evt) {
    let id = $(this).closest("tr").find("td").filter(":eq(0)").text();

    alertify.confirm('ANTENCION', 'Desea Eliminar el registro?', function () {
        let cur = ejecutarAjax("controladores/historial_salario.php",
                "eliminar=" + id);
        mensaje_dialogo_info("Eliminado Correctamente", "EXITOSO");
        buscarHistorialSalario();
        alertify.success('Eliminado');
    }
    , function () {
        alertify.error('Operación cancelada');
    });

});
$(document).on("keyup", ".salario_historial", function (evt) {
    if($("#id_contrato").val() !== "0"){
        let data = ejecutarAjax("controladores/contrato.php", "id="+$("#id_contrato").val());
        let json_data = JSON.parse(data);
        $("#salario_anterior").val(formatearNumero(json_data[0]['con_salario']));
        
    }
});