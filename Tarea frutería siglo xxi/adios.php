<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

  <style>
    table{
        border: 1px solid black;
    }
  </style>
</head>
<body>
    <h1>La frutería del siglo XXI</h1>
    <p>Este es su pedido:</p>
    <table>
        <tr>
            <td>Platanos<? echo $_SESSION["Platanos"]; ?></td>
        </tr>
        
        <tr>
            <td>Naranjas<? echo $_SESSION["Naranjas"]; ?></td>
        </tr>
        <tr>
            <td>Limones<? echo $_SESSION['Limones']; ?></td>
    </tr>
    </table>

    <p>Muchas gracias por su pedido.</p>

    <button name="nuevocliente">Nuevo Cliente</button>
</body>
</html>