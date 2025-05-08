<?php
    require_once("../classi/DB.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SESSION["user"]->getRuolo() != "cliente"){
        header("location: ../index.php?err=non puoi visualizzare quella pagina");
        exit;
    }

    if(isset($_GET["err"])){
        echo $_GET["err"] . "<br>";
    }

    $ritiranti=$db->getUtenteByRuolo("autotrasportatore");
    $camions=$db->getCamion($_SESSION["user"]->getId());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associa Camion</title>
</head>
<body>
    <form action="associaCamion" method="post">
        <label>Camion:</label>
        <select name="camion">
            <?php
                foreach($camions as $camion){
                    echo"<option value='$camion'>$camion</option>";
                }
            ?>
        </select>
        <br>
        <label>Autotrasportatore:</label>
        <select name="autotrasportatore">
            <?php
                foreach($ritiranti as $ritirante){
                    $id=$ritirante->getId();
                    $username=$ritirante->getUsername();
                    echo"<option value='$id'>$username</option>";
                }
            ?>
        </select>
        <input type="submit" name="associa" value="Associa">
    </form>
</body>
</html>