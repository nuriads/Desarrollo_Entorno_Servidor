<?php



function accionDetalles($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

function accionPostAlta(){
 
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $nuevo = [ $_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
    $_SESSION['tuser'][]= $nuevo;  
}

function accionBorrar($id){

    $arrayUsuarios = $_SESSION['tuser'];
    unset($arrayUsuarios[$id]);
    $arrayUsuarios = array_values($arrayUsuarios);
    $_SESSION["tuser"]=$arrayUsuarios;
  // header("refresh:1,url:../index.php"); //????
   include_once __DIR__."../index.php";
}


function accionModificar($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Modificar";
    include_once __DIR__."layout/formulario.php"; 
}

function accionTerminar(){
echo "confirmarTerminar();";
volcarDatos($_SESSION['tuser']);
session_destroy();
include_once __DIR__. "../index.php";//??

}

function accionPostModificar(){
    $arrayusu=$_SESSION['tuser'];

    foreach($arrayusu as $clave=>$arrayvalores){

        if ($arrayvalores[1]==$_POST["login"]){

            $arrayusu[$clave][0]=$_POST["nombre"];
            $arrayusu[$clave][2]=$_POST["clave"];
            $arrayusu[$clave][3]=$_POST["comentario"];
        }

    }
    $_SESSION["tuser"]=$arrayusu;
    include_once"../index.php";

}