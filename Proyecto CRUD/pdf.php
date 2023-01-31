<?php


require_once 'app/helpers/util.php';
require_once 'app/config/configDB.php';

require_once 'app/models/Cliente.php';
require_once 'app/models/AccesoDatos.php';
require_once 'app/controllers/crudclientes.php';

use Dompdf\Dompdf;
require "vendor/autoload.php";

$id=$_GET['id'];
 $db = AccesoDatos::getModelo();
 $cli = $db->getCliente($id);

 $url=imagenPerfil($cli->id,$cli->first_name,$cli->last_name); 
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
             width: 700px;
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
     <td><img src="'.$url.'"></img></td>
     </tr>
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
$dompdf->render();
$dompdf->stream("documento.pdf", array('Attachment'=>'0'));
?>