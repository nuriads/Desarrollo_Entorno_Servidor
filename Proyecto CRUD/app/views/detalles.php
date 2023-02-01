<hr>
<button onclick="location.href='./'"> Volver </button>
<br><br>
<?php


$contenido=file_get_contents( 'http://ip-api.com/json/'.$cli->ip_address);
$codpais= json_decode($contenido);
$imgerror='&#10060';


$url=imagenPerfil($cli->id,$cli->first_name,$cli->last_name); 

?>
<?= $codpais->status=="fail"?$imgerror:""?>
<img class="bandera" src=<?=$codpais->status=="success"?"https://flagcdn.com/16x12/".strtolower($codpais->countryCode).".png":""?> alt="">

<table>
    <tr>
        <td>id:</td>
        <td><input type="number" name="id" value="<?= $cli->id ?>" readonly> </td>
        <td rowspan="7">
            <img src="<?= $url ?>"></img>
        </td>
    </tr>
    <tr>
        <td>first_name:</td>
        <td><input type="text" name="first_name" value="<?= $cli->first_name ?>" readonly> </td>
    </tr>
    </tr>
    <tr>
        <td>last_name:</td>
        <td><input type="text" name="last_name" value="<?= $cli->last_name ?>" readonly></td>
    </tr>
    </tr>
    <tr>
        <td>email:</td>
        <td><input type="email" name="email" value="<?= $cli->email ?>" readonly></td>
    </tr>
    </tr>
    <tr>
        <td>gender</td>
        <td><input type="text" name="gender" value="<?= $cli->gender ?>" readonly></td>
    </tr>
    </tr>
    <tr>
        <td>ip_address:</td>
        <td><input type="text" name="ip_address" value="<?= $cli->ip_address ?>" readonly></td>
    </tr>
    </tr>
    <tr>
        <td>telefono:</td>
        <td><input type="tel" name="telefono" value="<?= $cli->telefono ?>" readonly></td>
    </tr>
    </tr>
</table>

<form action="pdf.php">
<input type="hidden" name="id" value="<?= $cli->id ?>">
<button type="submit" value="PDF">Imprimir</button>
</form>

<form>
    <input type="hidden" name="id" value="<?= $cli->id ?>">
  
    <br>
    <br>
    <button type="submit" name="nav-detalles" value="Anterior"> Anterior << </button>
            <button type="submit" name="nav-detalles" value="Siguiente"> Siguiente >> </button>
</form>
