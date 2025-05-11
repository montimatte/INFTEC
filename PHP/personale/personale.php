<?php
    require_once("../classi/DB.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SESSION["user"]->getRuolo() != "personale"){
        header("location: ../index.php?err=non puoi visualizzare quella pagina");
        exit;
    }

    if(isset($_GET["err"])){
        echo $_GET["err"] . "<br>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="richiesteBuoni.php"><button>Visualizza richieste buoni</button></a>
    <a href="registraRitiro.php"><button>Registra ritiro merce</button></a>
    <a href="visualizzaRegistro.php"><button>Visualizza Registro</button></a>
    <form action="../index.php" method="post">
        <input type="submit" name="Logout" value="Logout">
    </form>
</body>
</html>