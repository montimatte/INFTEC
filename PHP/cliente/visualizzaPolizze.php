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
    $polizze=$db->getPolizze();
    if($polizze==null){
        echo "ERRORE: NESSUNA POLIZZA NEL DB";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Polizze</title>
</head>
<body>
    <form method="post" action="richiediBuono.php">
        <table>
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
                    echo "<tr>";
                    echo "<td>". $id . "</td>";
                    echo "<td>". $polizza->getTipologiaMerce() . "</td>";
                    echo "<td>". $polizza->getPeso() . "</td>";
                    echo "<td>". $polizza->getGiorniMagazzinaggio() . "</td>";
                    echo "<td>". $polizza->getTariffa(). "</td>";
                    echo "<td><button name='richiedi' value='".$id."'>Richiedi un Buono</button></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </form>
    <a href="cliente.php"><button>Torna alla Home</button></a>
</body>
</html>