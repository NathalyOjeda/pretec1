<?php

class UsuarioActivo{
    private $nombre;
    private $cedula;
    private $id_cliente;
    private $id_sucursal;
    private $nombre_sucursal;
    private $rol;
    
    function getNombre_sucursal() {
        return $this->nombre_sucursal;
    }

    function getRol() {
        return $this->rol;
    }

    function setNombre_sucursal($nombre_sucursal) {
        $this->nombre_sucursal = $nombre_sucursal;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

        
    function getNombre() {
        return $this->nombre;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    function getId_sucursal() {
        return $this->id_sucursal;
    }

    function setId_sucursal($id_sucursal) {
        $this->id_sucursal = $id_sucursal;
    }




    
}

