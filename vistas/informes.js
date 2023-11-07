function mostrarInformesReferenciales() {
    var contenido = dameContenido("paginas/informes/referenciales.php");
    $("#contenido-page").html(contenido);
    
}
function mostrarInformesMovimiento() {
    var contenido = dameContenido("paginas/informes/movimiento.php");
    $("#contenido-page").html(contenido);
    dameFechaActual("desde");
    dameFechaActual("hasta");
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
$(document).on("change", "#tipo", function (evt) {
    let tipo = $("#tipo").val();
    let opciones = "";
    switch (tipo) {
        case "Permisos":
            opciones = ` <option value="">Selecciona una especificacion</option>
                <option value="Permisos Todos">Todos</option>
                <option value="Permisos activos">Permisos activos</option>
                <option value="Permisos anulados">Permisos anulados</option>`;
            break;
        case "Sanciones":
            opciones = ` <option value="">Selecciona una especificacion</option>
                <option value="Sanciones Todos">Todos</option>
                <option value="Sanciones activos">Sanciones activos</option>
                <option value="Sanciones anulados">Sanciones anulados</option>`;
            break;
        case "Descuento":
            opciones = ` <option value="">Selecciona una especificacion</option>
                <option value="Descuento Todos">Todos</option>
                <option value="Descuento activos">Descuento activos</option>
                <option value="Descuento anulados">Descuento anulados</option>`;
            break;
        case "I.P.S":
            opciones = ` <option value="">Selecciona una especificacion</option>
                <option value="Todos I.P.S">Todos</option>
                <option value="I.P.S activos">I.P.S activos</option>
                <option value="I.P.S anulados">I.P.S anulados</option>`;
            break;
        case "MJT":
            opciones = ` <option value="">Selecciona una especificacion</option>
                <option value="Todos MJT">Todos</option>
                <option value="MJT activos">MJT activos</option>
                <option value="MJT anulados">MJT anulados</option>`;
            break;
        case "Salario":
            opciones = ` <option value="">Selecciona una especificacion</option>
                <option value="Todos Salario">Todos</option>
                <option value="Salario activos">Salario activos</option>
                <option value="Salario anulados">Salario anulados</option>`;
            break;
        case "Aguinaldo":
            opciones = ` <option value="">Selecciona una especificacion</option>
                <option value="Todos Aguinaldo">Todos</option>
                <option value="Aguinaldo activos">Aguinaldo activos</option>
                <option value="Aguinaldo anulados">Aguinaldo anulados</option>`;
            break;
            
        default:
            opciones = ` <option value="0">Selecciona tipo</option>`;
                
            break;
    }
    
    
    $("#especificacion").html(opciones)
});
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirInformeMovimiento(){
    let especificacion = $("#especificacion").val();
    switch (especificacion) {
        //-----------------------------------------------------------------
        //PERMISOS
        //-----------------------------------------------------------------
        case 'Permisos Todos':
            imprimirTodosPermisos();
            break;
        case 'Permisos activos':
            imprimirPermisosActivos();
            break;
        case 'Permisos anulados':
            imprimirPermisosAnulados();
            break;
        //-----------------------------------------------------------------
        //SANCIONES
        //-----------------------------------------------------------------
        case 'Sanciones Todos':
            imprimirTodosSanciones();
            break;
        case 'Sanciones activos':
            imprimirSancionesActivos();
            break;
        case 'Sanciones anulados':
            imprimirSancionesAnulados();
            break;
        //-----------------------------------------------------------------
        //DESCUENTO
        //-----------------------------------------------------------------
        case 'Descuento Todos':
            imprimirTodosDescuento();
            break;
        case 'Descuento activos':
            imprimirDescuentoActivos();
            break;
        case 'Descuento anulados':
            imprimirDescuentoAnulados();
            break;
        //-----------------------------------------------------------------
        //IPS
        //-----------------------------------------------------------------
        case 'Todos I.P.S':
            imprimirTodosIPS();
            break;
        case 'I.P.S activos':
            imprimirIPSActivos();
            break;
        case 'I.P.S anulados':
            imprimirIPSAnulados();
            break;
        //-----------------------------------------------------------------
        // MJT
        //-----------------------------------------------------------------
        case 'Todos MJT':
            imprimirTodosMJT();
            break;
        case 'MJT activos':
            imprimirMJTActivos();
            break;
        case 'MJT anulados':
            imprimirMJTAnulados();
            break;
        //-----------------------------------------------------------------
        // Salario
        //-----------------------------------------------------------------
        case 'Todos Salario':
            imprimirTodosSalario();
            break;
        case 'Salario activos':
            imprimirSalarioActivos();
            break;
        case 'Salario anulados':
            imprimirSalarioAnulados();
            break;
        //-----------------------------------------------------------------
        // Aguinaldo
        //-----------------------------------------------------------------
        case 'Todos Aguinaldo':
            imprimirTodosAguinaldo();
            break;
        case 'Aguinaldo activos':
            imprimirAguinaldoActivos();
            break;
        case 'Aguinaldo anulados':
            imprimirAguinaldoAnulados();
            break;
            
        default:
            
            break;
    }
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirTodosPermisos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirTodosPermiso.php?desde="+desde+"&hasta="+hasta);
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirPermisosActivos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirPermisoActivo.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirPermisosAnulados(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirPermisoAnulado.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirTodosSanciones(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirTodosSanciones.php?desde="+desde+"&hasta="+hasta);
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirSancionesActivos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirSancionesActivo.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirSancionesAnulados(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirSancionesAnulado.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirTodosDescuento(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirTodosDescuento.php?desde="+desde+"&hasta="+hasta);
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirDescuentoActivos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirDescuentoActivo.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirDescuentoAnulados(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirDescuentoAnulado.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirTodosIPS(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirTodosIPS.php?desde="+desde+"&hasta="+hasta);
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirIPSActivos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirIPSActivo.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirIPSAnulados(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirIPSAnulado.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function imprimirTodosMJT(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirTodosMJT.php?desde="+desde+"&hasta="+hasta);
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirMJTActivos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirMJTActivo.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirMJTAnulados(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirMJTAnulado.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function imprimirTodosSalario(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirTodosSalario.php?desde="+desde+"&hasta="+hasta);
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirSalarioActivos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirSalarioActivo.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirSalarioAnulados(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirSalarioAnulado.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
function imprimirTodosAguinaldo(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirTodosAguinaldo.php?desde="+desde+"&hasta="+hasta);
    
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirAguinaldoActivos(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirAguinaldoActivo.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

function imprimirAguinaldoAnulados(){
    let desde = $("#desde").val();
    let hasta = $("#hasta").val();
    open("paginas/informes/imprimirAguinaldoAnulado.php?desde="+desde+"&hasta="+hasta);
}
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
//---------------------------------------------------------------------------
