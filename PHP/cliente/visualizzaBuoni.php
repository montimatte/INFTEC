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

    $db=new DB();
    $buoni=$db->getBuoniCliente($_SESSION["user"]->getId());
    if($buoni==null){
        echo "ERRORE: NESSUN BUONO NEL DB";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Stato Buoni</title>
</head>
<body>
    <table>
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
                echo "<td>".$buono->getStato() ."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <br><br>
    <a href="cliente.php"><button>Torna alla Home</button></a>
</body>
</html>