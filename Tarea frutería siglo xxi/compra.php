<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>La frutería del siglo XXI</h1>
    <form action="lafruteria.php" method="post">
        <h4>REALICE SU COMPRA <?php echo $_SESSION['nombreCliente']?> </h4>
      <p>Selecciona la fruta:
        <select name="fruta" id="fruta">
            <option value="naranjas">Naranjas</option>
            <option value="limones">Limones</option>
            <option value="limones">Platanos</option>
        </select>
        Cantidad:
        <input  name="cantidad" type="number">
        <input type="submit" name="accion" value="Anotar">	
        <input type="submit" name="accion" value="Terminar">
      </p>
       
      
    </form>
</body>
</html>