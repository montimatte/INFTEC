<?php
    require_once("classi/DB.php");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="visualizzaPolizze.php"><button>Visualizza Polizze</button></a>
    <a href="associa.php"><button>Associa un autotrasportatore</button></a>
    <a href="fatture.php"><button>Visualizza fatture</button></a>

    <form action="../index.php" method="post">
        <input type="submit" name="Logout" value="Logout">
    </form>
</body>
</html>