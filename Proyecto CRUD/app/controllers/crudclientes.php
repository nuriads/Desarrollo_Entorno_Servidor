<?php

function crudBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarCliente($id);
}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function crudAlta(){
    $cli = new Cliente();
    $orden= "Nuevo";
    include_once "app/views/formulario.php";
}

function crudDetalles($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}

function crudDetallesSiguiente($id){
    $num=intval($id)+1;
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente(strval($num));
    include_once "app/views/detalles.php";
}

function crudDetallesAnterior($id){
    $num=intval($id)-1;
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente(strval($num));
    include_once "app/views/detalles.php";
}

function crudModificarSiguiente($id){
    $num=intval($id)+1;
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente(strval($num));
    $orden="Modificar";
    include_once "app/views/formulario.php";
}

function crudModificarAnterior($id){
    $num=intval($id)-1;
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente(strval($num));
    $orden="Modificar";
    include_once "app/views/formulario.php";
}

function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";
    include_once "app/views/formulario.php";
}

function crudPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $msg=datosCheck($_POST);
    $msg.=checkImagen($_FILES["imagen"]);
    if($msg!=""){
        echo $msg;
        $cli = new Cliente();
        $cli->first_name    =$_POST['first_name'];
        $cli->last_name     =$_POST['last_name'];
        $cli->email         =$_POST['email'];	
        $cli->gender        =$_POST['gender'];
        $cli->ip_address    =$_POST['ip_address'];
        $cli->telefono      =$_POST['telefono'];
        $orden= "Nuevo";

        include_once "app/views/formulario.php";

    }else{
        $cli = new Cliente();
        $cli->id            =$_POST['id'];
        $cli->first_name    =$_POST['first_name'];
        $cli->last_name     =$_POST['last_name'];
        $cli->email         =$_POST['email'];	
        $cli->gender        =$_POST['gender'];
        $cli->ip_address    =$_POST['ip_address'];
        $cli->telefono      =$_POST['telefono'];
        $db = AccesoDatos::getModelo();
        $db->addCliente($cli);

        $nomImg=crearNombreImagen($cli->id);
        $ruta="app/uploads/". $nomImg;
        $resu=@move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta);

    }
    
    
}

function crudPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();

    $msg=checkImagen($_FILES["imagen"]);

    if($msg!=""){
        echo $msg;
        $cli = new Cliente();
        $cli->first_name    =$_POST['first_name'];
        $cli->last_name     =$_POST['last_name'];
        $cli->email         =$_POST['email'];	
        $cli->gender        =$_POST['gender'];
        $cli->ip_address    =$_POST['ip_address'];
        $cli->telefono      =$_POST['telefono'];
        $orden= "Modificar";
        include_once "app/views/formulario.php"; 
    }else{
        $cli->id            =$_POST['id'];
        $cli->first_name    =$_POST['first_name'];
        $cli->last_name     =$_POST['last_name'];
        $cli->email         =$_POST['email'];	
        $cli->gender        =$_POST['gender'];
        $cli->ip_address    =$_POST['ip_address'];
        $cli->telefono      =$_POST['telefono'];
        $db = AccesoDatos::getModelo();
        $db->modCliente($cli);
    
        $nomImg=crearNombreImagen($_POST['id']);
        $ruta="app/uploads/". $nomImg;
        $resu=@move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta);
    }

  
    
}
