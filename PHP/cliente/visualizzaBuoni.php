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

    $db=new DB();
    $buoni=$db->getBuoniCliente($_SESSION["user"]->getId());
    if($buoni==null){
        echo '
        <div class="alert alert-warning" role="alert">'.
            "ERRORE: NESSUN BUONO NEL DB".
        '</div>';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Stato Buoni</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    <table class="table table-striped">
        <tr>
            <th>ID buono</th>
            <th>ID polizza</th>
            <th>Peso</th>
            <th>Tipologia Merce</th>
            <th>Targa</th>
            <th>Autotrasportatore</th>
            <th>Stato</th>
        </tr>
        <?php
            foreach($buoni as $buono){
                echo "<tr>";
                echo "<td>".$buono->getId() ."</td>";
                echo "<td>".$buono->getIdPolizza() ."</td>";
                echo "<td>".$buono->getPeso() ."</td>";
                echo "<td>".$buono->getTipologiaMerce() ."</td>";
                echo "<td>".$buono->getTarga() ."</td>";
                echo "<td>".$buono->getAutotrasportatore() ."</td>";

                $stato=$buono->getStato();
                if($stato=="accettato"){
                    echo "<td class='link-success'>$stato</td>";
                }
                else if($stato== "rifiutato"){
                    echo "<td class='link-danger'>$stato</td>";
                }
                else if($stato== "in attesa"){
                    echo "<td class='link-warning'>$stato</td>";
                }
                else{
                    echo "<td class='link-secondary'>$stato</td>";
                }

                echo "</tr>";
            }
        ?>
    </table>

    <a href="cliente.php"><button class="btn btn-outline-primary">Torna alla Home</button></a>
</body>
</html>