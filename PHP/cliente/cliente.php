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
    <script src="../bootstrap.js"></script>
</head>
<body>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <form action="../index.php" method="post">
            <button class="btn btn-outline-primary" name="logout">Logout</button>
        </form>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <form action="registraCamion.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Registra un Camion</button>
        </form>
        <form action="associaCamion.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Associa un Autotrasportatore ad un Camion</button>
        </form>
        <form action="visualizzaPolizze.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Visualizza Polizze e Richiedi un Buono</button>
        </form>
        <form action="visualizzaBuoni.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Visualizza Stato Buoni</button>
        </form>
        <form action="visualizzaFatture.php" class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-secondary">Visualizza Fatture</button>
        </form>
    </div> 
</body>
</html>