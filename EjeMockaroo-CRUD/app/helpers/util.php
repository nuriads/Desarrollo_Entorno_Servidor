<?php

/*
 *  Funciones para limpiar la entrada de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

//MEJORA:Mejorar las operaciones de Nuevo y Modificar para que chequee que los datos son correctos: correo electrónico (no repetido), IP y teléfono con formato 999-999-9999
function datosCheck(array $datos){
    $db = AccesoDatos::getModelo();
    $msg=$db->chequear($datos['email'],$datos['ip_address']);
    if(preg_match("/[0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]\z/",$datos['telefono'])==0){
        $msg.="El teléfono no tiene el formato adecuado";
    }
    
    return $msg;

}

//MEJORA
function imagenPerfil($id,$nombre,$apellido){
 
    $strid=strval($id);
   
    $url="";
    $nceros=8-strlen($strid);
    $cadenaDeceros="";

    for($i=1;$i<=$nceros;$i++){
        $cadenaDeceros.="0";
    }
    $imgname= $cadenaDeceros.$strid.".jpg";
    
    if(file_exists(__DIR__."/../uploads/".$imgname)){
        $url="app/uploads/" . $imgname;
    }else{
        $url="https://robohash.org/" . $nombre . $apellido . ".png";
    }
   
 
    return $url;
}