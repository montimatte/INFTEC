<?php
    require_once("classi/DB.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SESSION["user"]->getRuolo() != "autotrasportatore"){
        header("location: ../index.php?err=non puoi visualizzare quella pagina");
        exit;
    }

    if(isset($_GET["err"])){
        echo $_GET["err"] . "<br>";
    }

    $db=new DB();
    $buoni=$db->getBuonyByUtente($_SESSION["user"]->getId());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Buoni</title>
</head>
<body>
    <table>
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
                echo "<td>". $buono->getId() ."<td>";
                echo "<td>". $buono->getCliente() ."<td>";
                echo "<td>". $buono->getPeso() ."<td>";
                echo "<td>". $buono->getIdPolizza() ."<td>";
                echo "<td>". $buono->getTipologiaMerce() ."<td>";

            }
            echo "</tr>";
        ?>
    </table>

    <form action="../index.php" method="post">
        <input type="submit" name="Logout" value="Logout">
    </form>
</body>
</html>