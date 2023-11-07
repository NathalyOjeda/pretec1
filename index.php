
<?php

include_once './controladores/usuarioSession.php';
include_once './controladores/usuarioActivo.php';
include_once './controladores/intentos.php';
$error_sesion = "";
$usuario = new UsuarioSession();
$usuario_activo = new UsuarioActivo();


if ($usuario->usuarioLogeado()) {
    //pasamos los datos de sesion a la clase usuario activo
    $usuario_activo->setNombre($usuario->getNombre());
    $usuario_activo->setId_cliente($usuario->getIdCliente());
    $usuario_activo->setId_sucursal($usuario->getIdSucursal());
    $usuario_activo->setNombre_sucursal($usuario->getSucursal());
    $usuario_activo->setRol($usuario->getRol());
    
    include_once 'menu.php';
//    echo "usuario logeado";
} else if (isset($_POST['usuario']) && isset($_POST['pass'])) {


    if ($usuario->existeUsuario($_POST['usuario'], $_POST['pass'])) {
//      
//        echo strval($usuario->getIdCliente());
        //pasamos los datos de sesion a la clase usuario activo
        $usuario_activo->setNombre($usuario->getNombre());
        $usuario_activo->setId_cliente($usuario->getIdCliente());
        $usuario_activo->setId_sucursal($usuario->getIdSucursal());
        $usuario_activo->setNombre_sucursal($usuario->getSucursal());
        $usuario_activo->setRol($usuario->getRol());
        $usuario->actualizatIntentos($_POST['usuario'], 0);

        include_once 'menu.php';
    } else {
        
        if (isset($_POST['usuario'])) {
            $intentos = $usuario->dameIntentos($_POST['usuario']);
            $limite = $usuario->dameLimiteIntentos($_POST['usuario']);
            
//            if ($_SESSION['usuario_intento'] == $_POST['usuario']) {
                

                if ($intentos >= $limite) {
                    $usuario->bloquearUsuario($_POST['usuario']);
                    $error_sesion = 'Usuario bloqueado contacta con el administrador';
                } else {
//                    $_SESSION['usuario_intento'] = $_POST['usuario'];
                    $restantes = $limite - $intentos;
                    $error_sesion = 'Contraseña incorrecta. Tienes ' . $restantes . ' intentos.';
                    $intentos++;
                    $usuario->actualizatIntentos($_POST['usuario'], $intentos);
                }
//            } else {
//
//                $_SESSION['usuario_intento'] = $_POST['usuario'];
//            }
        }
//         $error_sesion = 'Usuario no encontrado o bloqueado, contacte con el administrador';
//        echo $error_sesion;
        include_once 'login.php';
    }
} else {
//    echo "login";
   

    include_once 'login.php';
}
?>

