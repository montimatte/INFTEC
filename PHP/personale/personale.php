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
        echo '
        <div class="alert alert-warning" role="alert">'.
            $_GET["err"].
        '</div>';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="../my.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <form action="../index.php" method="post">
            <button class="btn btn-outline-primary" name="Logout">Logout</button>
        </form>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <form action="richiesteBuoni.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Visualizza Richieste Buoni</button>
        </form>
        <form action="registraRitiro.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Registra Ritiro Merce</button>
        </form>
        <form action="visualizzaRegistro.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Visualizza Registro</button>
        </form>
    </div>    
</body>
</html>
