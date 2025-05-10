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

    if(isset($_POST["registra"])){
        $db=new DB();
        $ris=$db->registraCamion($_POST["targa"], $_SESSION["user"]->getId());
        if($ris!=null){
            header("location: registraCamion.php?err=$ris");
            exit;
        }
        header("location: registraCamion.php?err=operazione completata");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registra Camion</title>
</head>
<body>
    <form action="registraCamion.php" method="post">
        <input type="text" name="targa" placeholder="Targa" required>
        <input type="submit" name="registra" value="Registra">
    </form>
    <br>
    <a href="cliente.php"><button>Torna alla Home</button></a>
</body>
</html>