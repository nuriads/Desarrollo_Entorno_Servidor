<?php
include_once 'funciones.php';
$mensaje=$_REQUEST['comentario'];
$detalles=[];
$detalles=detalles($mensaje);
?>
<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= $detalles['longitud']?></td></tr>
<tr><td>Nº de palabras:    </td><td><?= $detalles['npalabras']?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= $detalles['letramasrepe']?></td></tr>
<tr><td>Palabra + repetida:</td><td><?= $detalles['palabramasrepe']?></td></tr>
</table>
</div>

