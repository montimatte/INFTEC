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
    $polizze=$db->getPolizze();
    if($polizze==null){
        echo '
        <div class="alert alert-warning" role="alert">'.
            "ERRORE: NESSUNA POLIZZA NEL DB".
        '</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Polizze</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    <form method="post" action="richiediBuono.php">
        <table class="table table-striped">
            <tr>
                <th>ID Polizza</th>
                <th>Merce</th>
                <th>Peso</th>
                <th>Giorni di Magazzinaggio</th>
                <th>Tariffa giornaliera</th>
                <th></th>
            </tr>
            <?php
                foreach($polizze as $polizza){
                    $id=$polizza->getId();
                    $tot=$db->getQuantitaRichiestaPolizza($id);
                    echo "<tr>";
                    echo "<td>". $id . "</td>";
                    echo "<td>". $polizza->getTipologiaMerce() . "</td>";
                    echo "<td>". $polizza->getPeso()." - (".$polizza->getPeso()-$tot. " rimanenti)</td>";
                    echo "<td>". $polizza->getGiorniMagazzinaggio() . "</td>";
                    echo "<td>". $polizza->getTariffa(). "</td>";
                    echo "<td><button class='btn btn-secondary' name='richiedi' value='".$id."'>Richiedi un Buono</button></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </form>

    <a href="cliente.php"><button class="btn btn-outline-primary">Torna alla Home</button></a>
</body>
</html>