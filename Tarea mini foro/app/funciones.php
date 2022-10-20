<?php
function usuarioOk($usuario, $contraseña) :bool {
  $ok=false;
  if(strlen($usuario) >=8 && $contraseña==strrev($usuario)){
      $ok=true;
  }
   return ($ok);
    
}

function detalles(string $mensaje) : array{
   $info=["longitud"=> 0,"npalabras"=>0,"letramasrepe"=>"", "palabramasrepe"=>""];

   //LONGITUD MSJ
   $info["longitud"]=strlen($mensaje);
   //NÚMERO DE PALABRAS
   $info["npalabras"]=str_word_count($mensaje);

   //LETRA MÁS REPETIDA
   //Creo un array en el que almaceno con la función count chars en la clave las letras (el código ascii) y en el valor las veces que se repite cada una.
   $caracteres=[];
   $caracteres=count_chars($mensaje,1);
   //quito del array el carácter 32 que es el espacio.
   unset($caracteres[32]);
   print_r($caracteres);
   $vecesrepe=0;//lo utilizo de contador tanto para las letras como las palabras
   foreach($caracteres as $letra=>$frecuencia){
      if($frecuencia>$vecesrepe){
         $vecesrepe=$frecuencia;
      }
   }
   //compruebo si la letra más repetida ha empatado con otra o no. busco en el array las teras con la frecuencia mas repetida.
   $letramasrepe="";
   foreach($caracteres as $letra=>$frecuencia){
         if($frecuencia==$vecesrepe){
            $letramasrepe=$letramasrepe . chr($letra);
            if(strlen($letramasrepe)>=1){
               $letramasrepe=$letramasrepe . ",";
            }
         }
      
     
   }
   $letramasrepe=substr($letramasrepe,0,strlen($letramasrepe)-1);//?
   $info["letramasrepe"]=$letramasrepe;


   //PALABRA MÁS REPETIDA
   $vecesrepe=0; //Reinicio el contador
   $max=0;
   $listapalabras=str_word_count($mensaje,1);
   for($i=0;$i<=sizeof($listapalabras)-1;$i++){
      for($f=0;$f<=sizeof($listapalabras)-1;$f++){
         if($i==$f){
            $f++;
         }else{
            
            if($listapalabras[$i]==$listapalabras[$f]){
               $vecesrepe++;
            }
         }
      }
      if($vecesrepe>$max){
         $max=$vecesrepe;
         $palabra=$listapalabras[$i];
      }
   }
   $info["palabramasrepe"]=$palabra;
return $info;
}
?>