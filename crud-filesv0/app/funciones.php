<?php
include_once 'app/config.php';

// Cargo los datos segun el formato de configuración
function cargarDatos(){
    $funcion =__FUNCTION__.TIPO; // cargarDatostxt 
    //__FUNCTION__ es una constante que retorna el nombre de la funcion. es decir en este caso 
    //cargarDatos, y se le concatena TIPO que es una constante que esta definida en config.php
    return $funcion();
}

function volcarDatos($valores){
    $funcion =__FUNCTION__.TIPO;
    $funcion($valores);
}

// ----------------------------------------------------
// FICHERO DE TEXT 
//Carga los datos de un fichero de texto en una tabla
function cargarDatostxt(){
    // Si no existe lo creo
    $tabla=[]; 
    if (!is_readable(FILEUSER) ){
        // El directorio donde se crea tiene que tener permisos adecuados
        $fich = @fopen(FILEUSER,"w") or die ("Error al crear el fichero.");
        fclose($fich);
    }
    $fich = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura
    //La función fopen() devuelve un identificador de recurso o FALSE si la operación no pudo realizarse correctamente.
    while ($linea = fgets($fich)) { //fgets lee una linea del fichero
        $partes = explode('|', trim($linea));
        //trim — Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
        //explode() Devuelve un array de string

        // Escribimos la correspondiente fila en tabla
        $tabla[]= [ $partes[0],$partes[1],$partes[2],$partes[3]];
    }
    fclose($fich);
    return $tabla;
}
//Vuelca los datos a un fichero de texto
function volcarDatostxt($tvalores){
    $cadena="";

    for ($i=0;$i<=sizeof($tvalores)-1;$i++){
        $cadena.=implode("|", $tvalores[$i]);
        $cadena.="\n";//no me hace el salto de linea ???
    }
    
    $fichero=@fopen(FILEUSER, 'w');
    fwrite($fichero,$cadena); 
    //fwrite() ->All the existing data will be ERASED and we start with an empty file.
    fclose($fichero);
    
}

// ----------------------------------------------------
// FICHERO DE CSV

function cargarDatoscsv (){
    $tabla=[]; 
    if (!is_readable(FILEUSER) ){
        // El directorio donde se crea tiene que tener permisos adecuados
        $fich = @fopen(FILEUSER,"w") or die ("Error al crear el fichero.");
        fclose($fich);
    }
    $fich = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura
    //La función fopen() devuelve un identificador de recurso o FALSE si la operación no pudo realizarse correctamente.
    while ($linea = fgets($fich)) { //fgets lee una linea del fichero
        $partes = explode(',', trim($linea));
        //trim — Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
        //explode() Devuelve un array de string

        // Escribimos la correspondiente fila en tabla
        $tabla[]= [ $partes[0],$partes[1],$partes[2],$partes[3]];
    }
    fclose($fich);
    return $tabla;


}

//Vuelca los datos a un fichero de csv
function volcarDatoscsv($tvalores){
  

}

// ----------------------------------------------------
// FICHERO DE JSON
function cargarDatosjson (){
   //Comprobar si existe el archivo 
   if(!is_file(FILEUSER)) return false;

   //Cargar el contenido del archivo 
   $contenido = file_get_contents(FILEUSER);
   if($contenido === false){
    return false;
   } 

   //Convertir el contenido a un array
   $tabla = json_decode($contenido, true);
   if(is_null($tabla)) return false;

   return $tabla;
}

function volcarDatosjson($tvalores){
    
    $fich=@fopen(FILEUSER, "w");
   $cadena=json_encode($tvalores);
   fwrite($fich,$cadena);
    
    
}




// MUESTRA LOS DATOS DE LA TABLA DE ALMACENADA EN AL SESSION 
function mostrarDatos (){
    
    $titulos = [ "Nombre","login","Password","Comentario"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < CAMPOSVISIBLES; $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }  
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $id=0;
    $nusuarios = count($_SESSION['tuser']);
    for($id=0; $id< $nusuarios ; $id++){
        $msg .= "<tr>";
        $datosusuario = $_SESSION['tuser'][$id];
        for ($j=0; $j < CAMPOSVISIBLES; $j++){
            $msg .= "<td>$datosusuario[$j]</td>";
        }
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$datosusuario[0]',$id);\" >Borrar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$id\">Modificar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$id\" >Detalles</a></td>\n";
        $msg .="</tr>\n";
        
    }
    $msg .= "</table>";
   
    return $msg;    
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */


// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
  // Sin implementar
    
}

