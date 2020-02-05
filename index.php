<?php

$controllerInicio = 'Inicio';
$controllerSesion = 'Sesion';
$controllerLogout = 'Logout';
$controllerUsuario = 'Usuario';
$controllerPersonal = 'Personal';


session_start();

$opcion = filter_input(INPUT_GET, "op");

// Todo esta lógica hara el papel de un FrontController
if (!isset($opcion) || empty($opcion)) { // por defecto, inicialmente
    require_once "controller/" . $controllerInicio . "Controller.php";
    //ucwords — Uppercase the first character of each word in a string
    $controllerInicio = ucwords($controllerInicio) . 'Controller';
    $controllerInicio = new $controllerInicio;
    //controlador y accion inicial

    $controllerInicio->Login();
} else if ($opcion == 1) { //si ingresamos a session

    require_once "controller/" . $controllerSesion . "Controller.php";
    $controllerSesion = ucwords($controllerSesion) . 'Controller';
    $controllerSesion = new $controllerSesion;
    $opcion = 1;
    $controllerSesion->sesionPrincipal();
} else if ($opcion == 2) { //si ingresamos a session

    require_once "controller/" . $controllerInicio . "Controller.php";
    $controllerInicio = ucwords($controllerInicio) . 'Controller';
    $controllerInicio = new $controllerInicio;
    $opcion = 2;
    $controllerInicio->Registro();
} else if ($opcion == 3) { //si ingresamos a session

    require_once "controller/" . $controllerInicio . "Controller.php";
    $controllerInicio = ucwords($controllerInicio) . 'Controller';
    $controllerInicio = new $controllerInicio;
    $opcion = 3;
    $controllerInicio->Recuperacion();
} else if ($opcion == 4) { //si ingresamos a session
 
    require_once "controller/" . $controllerUsuario . "Controller.php";
    $controllerUsuario = ucwords($controllerUsuario) . 'Controller';
    $controllerUsuario = new $controllerUsuario;
    $opcion = 4;
    $controllerUsuario->guardar();
} else if ($opcion == 5) { //si ingresamos a session
    require_once 'model/Conexion.php';
    if (!isset($_REQUEST['c'])) {
        require_once "controller/" . $controllerPersonal . "Controller.php";
        $controllerPersonal = ucwords($controllerPersonal) . 'Controller';
        $controllerPersonal = new $controllerPersonal;
        $opcion = 5;
        $controllerPersonal->consultar();
    } else {
        // Obtenemos el controlador que queremos cargar
        //strtolower — Make a string lowercase
        $controllerPersonal = ucwords($_REQUEST['c']);
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'consultar';

        // Instanciamos el controlador
        require_once "controller/" . $controllerPersonal . "Controller.php";
        $controllerPersonal = ucwords($controllerPersonal) . 'Controller';
        $controllerPersonal = new $controllerPersonal;

        // Llama la accion
        // call_user_func — Llamar a una llamada de retorno dada por el primer parámetro
        call_user_func(array($controllerPersonal, $accion));
    }
} else if ($opcion>5 ) { // cerramos sesion
    require_once "controller/" . $controllerLogout . "Controller.php";
    $controllerLogout = ucwords($controllerLogout) . 'Controller';
    $controllerLogout = new $controllerLogout;
    $opcion = null;
    $controllerLogout->LogoutPrincipal();
}
