<?php

session_start();
session_unset();
session_destroy();
session_start();


$_SESSION['usuario_intento'] = "";
header('location:../index.php');


