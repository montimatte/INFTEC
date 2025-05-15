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
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    <br>
    <form class="row gy-2 gx-3 align-items-center" action="registraCamion.php" method="post">
        <div class="col-auto">
            <input class="form-control" type="text" name="targa" placeholder="Targa" required>
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" name="registra">Registra</button>
        </div>
    </form>
    <br>
    <a href="cliente.php"><button class="btn btn-outline-primary">Torna alla Home</button></a>
</body>
</html>