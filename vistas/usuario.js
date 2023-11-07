function dameSucursalPorNombreUsuario(){
    var sucursal = ejecutarAjax("controladores/usuario.php",
    "nombre_usuario="+$("#usuario").val());
    
    if(sucursal === "0"){
        $("#sucursal").val("Sucursal no encontrado");
    }else{
        
        $("#sucursal").val(sucursal);
        
    }
        
}


