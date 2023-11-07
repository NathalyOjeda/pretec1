<?php

include_once 'conexion/db.php';

class UsuarioSession {

    public function __construct() {
        session_start();
    }

    public function existeUsuario($usuario, $pass) {

        //conversor  a md5
        $passMD5 = md5($pass);
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT
            u.usu_id,
            CONCAT(p.per_nom, ' ', p.per_apell) as nombre_apellido,
            e.suc_id,
            u.usu_nivel as rol,
            s.suc_descri as sucursal
            FROM usuario u 
            JOIN empleados e 
            ON e.func_id = u.func_id
            JOIN curriculum cu 
            ON cu.cur_id = e.cur_id
            JOIN personal  p 
            ON p.per_id = cu.per_id
            JOIN sucursal s 
            ON s.suc_id = e.suc_id 
            WHERE u.usu_log LIKE :usuario and u.usu_pass LIKE :pass AND u.usu_estado LIKE 'ACTIVO'");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario, 'pass' => $passMD5]);

        if ($query->rowCount()) {

            foreach ($query as $user) {
                $_SESSION['id_usuario'] = $user['usu_id'];
                $_SESSION['nombre_apellido'] = $user['nombre_apellido'];
                $_SESSION['sucursal'] = $user['sucursal'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['id_sucursal'] = $user['suc_id'];

                return true;
            }
        } else {
            return false;
        }
    }
    public function bloquearUsuario($usuario) {

        
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("UPDATE usuario SET usu_estado = 'BLOQUEADO' 
        WHERE  usu_log LIKE :usuario");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario]);

       
    }
    public function actualizatIntentos($usuario, $intentos) {

        
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("UPDATE usuario SET usu_intentos = :intentos 
        WHERE  usu_log LIKE :usuario");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario, 'intentos' => $intentos]);

       
    }
    public function dameIntentos($usuario) {

        
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT usu_intentos FROM usuario  
        WHERE  usu_log LIKE :usuario limit 1");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario]);
        
        if ($query->rowCount()) {

            foreach ($query as $user) {
               

                return $user['usu_intentos'];
            }
        } else {
            return 0;
        }

       
    }
    public function dameLimiteIntentos($usuario) {

        
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT usu_limite_intentos FROM usuario  
        WHERE  usu_log LIKE :usuario");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario]);

        if ($query->rowCount()) {

            foreach ($query as $user) {
               

                return $user['usu_limite_intentos'];
            }
        } else {
            return 0;
        }
       
    }

    public function usuarioLogeado() {
        if (isset($_SESSION['id_usuario'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getNombre() {
        return $_SESSION['nombre_apellido'];
    }

    public function getIdCliente() {
        return $_SESSION['id_usuario'];
    }
    public function getIdSucursal() {
        return $_SESSION['id_sucursal'];
    }
    public function getSucursal() {
        return $_SESSION['sucursal'];
    }
    public function getRol() {
        return $_SESSION['rol'];
    }

//##############################################################################
//##############################################################################
//##############################PARA ADMINISTRADORES#######################
//##############################################################################
//##############################################################################

    public function existeAdmin($usuario, $pass) {

        //conversor  a md5
        $passMD5 = md5($pass);
        //instancia de la clase BD para conexiones con la base de datos
        $db = new DB();

        //preparamos la sentencia a ser ejecutada
        $query = $db->conectar()->prepare("SELECT nombre_apellido,"
                . "id_usuario FROM usuario WHERE nombre = :usuario "
                . "and clave = :pass;");
        //agregamos los valores a la consulta mediante la ayuda de un diccionario
        $query->execute(['usuario' => $usuario, 'pass' => $passMD5]);

        if ($query->rowCount()) {

            foreach ($query as $user) {
                $_SESSION['nombre_apellido_admin'] = $user['nombre_apellido'];
                $_SESSION['id_usuario'] = $user['id_usuario'];

                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @return boolean
     */
    public function adminLogeado() {
        if (isset($_SESSION['id_usuario'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getNombreAdmin() {
        return $_SESSION['nombre_apellido_admin'];
    }

    public function getIdAdmin() {
        return $_SESSION['id_usuario'];
    }

}
