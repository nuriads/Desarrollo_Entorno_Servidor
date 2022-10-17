<?php

echo 'PHP version: ' . phpversion();

$mensaje= [
    0 => 'Subida correcta',
    1 => 'El tamaño del archivo excede el admitido por el servidor', // directivaupload_max_filesize en php.ini
    2 => 'El tamaño máximo de todos los ficheros excede el admitido por el servidor', // directiva MAX_FILE_SIZE en el formulario HTML
    3 => 'El archivo no se pudo subir completamente',
    4 => 'No se seleccionó ningún archivo para ser subido',
    6 => 'Formato del archivo no soportado, sólo se admite formato .png o .jpg',
    7 => 'No se pudo guardar el archivo en disco', // permisos
    8 => 'El nombre del fichero ya existe' // extensión PHP
   ];

   //ini_set("upload_max_filesize", "0,2M"); Esto no funciona para las versiones de php superiores a la 5.3
   $maxsizeimg=204800;//200kb en bytes
   $maxsizetotal=307200;//300kb en bytes
   $tamañototal=0;
for ($i = 1; $i <= 4; $i++) {
    
    $imagen = $_FILES["imagen".$i];
    $error=false;
    echo"<br>";
    
    if (isset($imagen)) {
        $nombreFichero = $imagen['name'];
        $tipoFichero = $imagen['type'];
        $tamanioFichero = $imagen['size'];
        $ubicacionTemporal = $imagen['tmp_name'];
        $errorFichero = $imagen['error'];
        $pathimagen = $_SERVER["DOCUMENT_ROOT"] . "/imgusers" . "/" . $imagen['name'];
        $pathcarpeta = $_SERVER["DOCUMENT_ROOT"] . "/imgusers";
        $tamañototal+=$tamanioFichero;
        
        //Comprobamos el tamaño de la imágen
        if ($tamanioFichero>$maxsizeimg) {
            $error=true;
            echo"Imagen $i : $mensaje[1] <br>";

        }

        //Comprobamos el tamaño de la suma de las imágenes
        if ($tamanioFichero>$maxsizeimg) {
            $error=true;
            echo"Imagen $i : $mensaje[2]<br>";
        }
        
        //Comprobamos el tipo de archivo. solo se permiten png o jpg.
        if ($tipoFichero != 'image/png' && $tipoFichero != 'image/jpg') {
            $error=true;
            echo "Imagen $i : $mensaje[6] <br>";
            header("refresh:3;url=index.html");
        }

        //Creamos un array para almacenar los nombres de los ficheros que existen en el directorio path
        $ficherosSubidos = [];
        //Scandir devuelve un array con los nombres de los ficheros en un directorio
        $ficherosSubidos = scandir($pathcarpeta);
        //recorremos el array y comprobamos si el nombre del fichero ya existe en el directorio.
        foreach ($ficherosSubidos as $valor) {
            if ($nombreFichero == $valor) {
                $error=true;
                echo "Imagen $i :  $mensaje[8] <br>";
            }
        }

       
    } else {
        $error=true;
        echo " $mensaje[4]";
        header("refresh:3;url=index.html");
       
    }
    if(!$error){
        echo "Imagen $i : $mensaje[0]";
        move_uploaded_file($imagen['tmp_name'], $pathimagen);
    }
   
}  
 
?>