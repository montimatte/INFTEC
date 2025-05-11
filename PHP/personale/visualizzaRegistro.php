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

    $db=new DB();
    
    $records=$db->getRecord();
    if($records==null){
        echo "ERRORE: NESSUN RECORD NEL DB";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<table>
        <tr>
            <th>ID buono</th>
            <th>Cliente</th>
            <th>Peso</th>
            <th>ID polizza</th>
            <th>Tipologia Merce</th>
            <th>Targa</th>
            <th>Autotrasportatore</th>
            <th>Data e Ora Ritiro</th>
        </tr>
        <?php
            foreach($records as $record){
                echo "<tr>";
                echo "<td>". $record->getIdBuono() ."</td>";
                echo "<td>". $record->getCliente() ."</td>";
                echo "<td>". $record->getPeso() ."</td>";
                echo "<td>". $record->getIdPolizza() ."</td>";
                echo "<td>". $record->getTipologiaMerce() ."</td>";
                echo "<td>". $record->getTarga() ."</td>";
                echo "<td>". $record->getAutotrasportatore() ."</td>";
                echo "<td>". $record->getDataOraRitiro() ."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <br><br>
    <a href="personale.php"><button>Torna alla Home</button></a>
</body>
</html>