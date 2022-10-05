<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5dados</title>

    <style>
        .dadosj1{
            font-size: 4rem;
            color: red;
        }
        .dadosj2{
            font-size: 4rem;
            color: blue;
        }
        .negrita{
            font-size: 1rem;
            font-weight: bold;
        }
        .ganador1{
            font-weight: bold;
            text-align: center;
            border: 2px dotted red;
        }

        .ganador2{
            font-weight: bold;
            text-align: center;
            border: 2px dotted blue;

        }
        .empate{
            font-weight: bold;
            text-align: center;
            border: 2px dotted green;
        }
    </style>
</head>
<body>
    
    <?php
    $mensajes=["instrucciones"=>"Actualice la página para mostrar una nueva tirada","Ganador1"=>"Ha ganado el gugador 1",
    "Ganador2"=>"Ha ganado el gugador 2"];
    $dados=[1=> "&#9856", 2=>"&#9857", 3=>"&#9858",4=>"&#9859",5=>"&#9860",
    6=>"&#9861"];
    $ndados=5;
    $resuj1=[];
    $resuj2=[];

    echo "<p>$mensajes[instrucciones]</p> </br>";


   for($i=1;$i<=$ndados;$i++){
       $resuj1[]=random_int(1,6);
       $resuj2[]=random_int(1,6);
   }

   $resultadofinal=[];
   $resultadofinal=setganador($resuj1,$resuj2,$dados);
   mostraresu($resuj1,$resuj2,$dados,$resultadofinal);
  

   function mostraresu(array $resuj1, array $resuj2, array $dados, array $resultadofinal){
        echo "<table>";
        echo"<tr>
             <td class='negrita'>Jugador 1: </td>
             <td class='dadosj1'>";
        foreach($resuj1 as $valor){
            echo "$dados[$valor]";
        }
        echo "</td>";
        echo "<td class='negrita'>$resultadofinal[puntosj1] puntos</td>";
        echo"</tr>"; 
        //sd
        echo"<tr> 
             <td class='negrita'>Jugador 2: </td>
             <td class='dadosj2'>";


        foreach($resuj2 as $valor){
            echo "$dados[$valor]";
        }
        echo "</td>";
        echo "<td class='negrita'>$resultadofinal[puntosj2] puntos</td>";
        echo"</tr>";   

        switch($resultadofinal["ganador"]){
            case 1: echo "<tr><td colspan='2' class='ganador1'>Ha ganado el jugador 1</td></tr>"; break;
            case 2: echo "<tr><td colspan='2'  class='ganador2'>Ha ganado el jugador 2</td></tr>"; break;
            case 0: echo "<tr><td colspan='2'  class='empate'>Empate</td></tr>"; break;
       }
       echo "</table>";
   }

   function setganador(array $resuj1, array $resuj2): array{

        //Eliminamos el mayor y el menor dado del J1
        unset($resuj1[array_search(min($resuj1),$resuj1)]);
        unset($resuj1[array_search(max($resuj1),$resuj1)]);

        //Eliminamos el mayor y el menor dado del J2
        unset($resuj2[array_search(min($resuj2),$resuj2)]);
        unset($resuj2[array_search(max($resuj2),$resuj2)]);

        //Sumamos los valores de cada array
        $totalj1=array_sum($resuj1);
        $totalj2=array_sum($resuj2);
         
        if($totalj1>$totalj2){
            $ganador=1;
        }elseif($totalj1<$totalj2){
            $ganador=2;
        }else{
            $ganador=0;
        }

        $resultados=["puntosj1"=>$totalj1, "puntosj2"=>$totalj2,"ganador"=>$ganador];
        return $resultados;
   }
  
    
    ?>
</body>
</html>