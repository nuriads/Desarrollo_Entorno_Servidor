<?php

/*
 *  Funciones para limpiar la entrada de posibles inyecciones
 */

use Dompdf\Dompdf;

require "vendor/autoload.php";


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

function crearNombreImagen($id){
    $strid=strval($id);
   
    $url="";
    $nceros=8-strlen($strid);
    $cadenaDeceros="";

    for($i=1;$i<=$nceros;$i++){
        $cadenaDeceros.="0";
    }
    $imgname= $cadenaDeceros.$strid.".jpg";
    return $imgname;
}
//MEJORA
function imagenPerfil($id,$nombre,$apellido){
 
    $imgname= crearNombreImagen($id);
    
    if(file_exists(__DIR__."/../uploads/".$imgname)){
        $url="./app/uploads/" . $imgname;
    }else{
        $url="https://robohash.org/" . $nombre . $apellido . ".png";
    }
   
    return $url;
}

//MEJORA SUBIR IMAGEN

function checkImagen(array $imagen){

     //MEJORA SUBIR
     $msg="";
     $limitebytes=1000000;
    
     if($imagen["error"]>0){
         $msg.= "error, no se subió la imagen";
     }   

    if($imagen["size"]>$limitebytes){
        $msg.="error, la imagen debe pesar menos de 1000kb";
    }
    if($imagen["type"] != "image/jpeg"){
        $msg.="error, la imagen debe ser .jpg";
      
    }
        
     
     return $msg;
}



 function generarPDF($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    
    $html='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    
        <style>
            table{
                margin: 0px auto;
                padding: 30px;
                width: 1000px;
            }
            th{
                padding: 10px;
                font-size: 30px;
                background-color:darkturquoise;
            }
    
            td{
                padding: 10px;
                font-size: 20px;
                border-bottom: 1px solid darkturquoise;
            }
        </style>
    </head>
    <body>
      
       <table>
        <th>'.$cli->first_name. ' '.$cli->last_name .'</th>
        <tr>
            <td>Id: '. $cli->id.'</td>
        </tr>
        <tr>
            <td>email:'.$cli->email.'</td>
        </tr>
        <tr>
            <td>Genero:'.$cli->gender.'</td>
        </tr>
        <tr>
            <td>Dirección ip:'.$cli->ip_address.'</td>
        </tr>
        <tr>
            <td>Teléfono:'.$cli->telefono .'</td>
        </tr>
      
       </table>
    </body>
    </html>';

   $dompdf=new Dompdf();
   $dompdf->loadHtml($html);
   $dompdf->render;
   $contenido = $dompdf->output();
   $nombreDelDocumento = "1_hola.pdf";
    $bytes = file_put_contents($nombreDelDocumento, $contenido);
 }
