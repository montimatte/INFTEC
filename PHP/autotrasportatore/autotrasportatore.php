<?php
    require_once("../classi/DB.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SESSION["user"]->getRuolo() != "autotrasportatore"){
        header("location: ../index.php?err=non puoi visualizzare quella pagina");
        exit;
    }

    if(isset($_GET["err"])){
        echo '
        <div class="alert alert-warning" role="alert">'.
            $_GET["err"].
        '</div>';
    }

    $db=new DB();
    $buoni=$db->getBuoniAutotrasportatore($_SESSION["user"]->getId());
    if($buoni==null){
        echo '
        <div class="alert alert-warning" role="alert">
            ERRORE: NESSUN BUONO NEL DB
        </div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Buoni</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <form action="../index.php" method="post">
            <button class="btn btn-outline-primary" type="submit" name="Logout">Logout</button>
        </form>
    </div>
    <br>

    <table class="table table-striped">
        <tr>
            <th>ID buono</th>
            <th>Cliente</th>
            <th>Peso</th>
            <th>ID polizza</th>
            <th>Tipologia Merce</th>
        </tr>
        <?php
            echo "<tr>";
            foreach($buoni as $buono){
                echo "<td>". $buono->getId() ."</td>";
                echo "<td>". $buono->getCliente() ."</td>";
                echo "<td>". $buono->getPeso() ."</td>";
                echo "<td>". $buono->getIdPolizza() ."</td>";
                echo "<td>". $buono->getTipologiaMerce() ."</td>";

            }
            echo "</tr>";
        ?>
    </table>
</body>
</html>