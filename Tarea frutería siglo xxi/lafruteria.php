<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();

    if(isset($_GET["nombre"])){
        $nombre=$_GET["nombre"];
    
        //En la variable global session que es un array creo las claves platano etc para contabilizar el total 
        $_SESSION["nombreCliente"]=$nombre;
        $_SESSION["Platanos"]=0;
        $_SESSION["Naranjas"]=0;
        $_SESSION["Limones"]=0;
    
        if($_SESSION["nombreCliente"]==null || $_SESSION["nombreCliente"]=="" ){
    
            echo "sesión no iniciada";
        } else{
            echo "Sesión iniciada";
            header("refresh:3;url=compra.php");
        }

    }
    
    
    if($_POST["accion"]=="Anotar"){

        $fruta=$_POST["fruta"];
        $cantidad=$_POST["cantidad"];

        switch($fruta){
            case "naranjas": $_SESSION["Naranjas"]+=$cantidad ;
                break;
            case "limones": $_SESSION["Limones"]+=$cantidad ;
                break;
            case "platanos":$_SESSION["Platanos"]+=$cantidad;
                break;
        }

        include_once "compra.php";
        echo "Este es su pedido:";
        echo "<table style='border: 1px solid black'> 
        <tr>
        <td>Limones  " . $_SESSION['Limones'] . "</td>
        </tr> 
        <tr>
        <td> Naranjas  " . $_SESSION['Naranjas']. " </tr></td>
        </table>";

        
        
    }
 
    if($_POST["accion"]=="Terminar"){

        include_once "adios.php";
        session_destroy();
    }
    
    ?>
</body>
</html>