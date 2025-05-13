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
    $fatture=$db->getFattureCliente($_SESSION["user"]->getId());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatture</title>
</head>
<body>
    <table>
        <tr>
            <th>ID fattura</th>
            <th>Importo</th>
            <th>idBuono</th>
            <th>Tipologia Merce</th>
            <th>Peso</th>
        </tr>
        <?php
            foreach($fatture as $fattura){
                echo "<tr>";
                echo "<td>". $fattura->getId() ."</td>";
                echo "<td>". $fattura->getImporto() ."</td>";
                echo "<td>". $fattura->getIdBuono() ."</td>";
                echo "<td>". $fattura->getMerce() ."</td>";
                echo "<td>". $fattura->getPeso() ."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <br><br>
    <a href="cliente.php"><button>Torna alla Home</button></a>
</body>
</html>