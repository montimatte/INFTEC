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
    $polizza;
    $ritiranti;
    if(isset($_POST["richiedi"])){
        $polizza=$db->getPolizzaById($_POST["richiedi"]);
        $ritiranti=$db->getUtenteByRuolo("autotrasportatore");
    }
    else if (isset($_POST["invia"])){
        $db->inviaRichiesta($_SESSION["user"]->getId(),$_POST["ritirante"],$_POST["invia"],$_POST["quantita"]);
        header("location: visualizzaPolizze.php?err=richiesta inviata");
        exit;
    }
    else{
        header("location: visualizzaPolizze.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richiedi Buono</title>
</head>
<body>
<table>
    <tr>
        <th>ID Polizza</th>
        <th>Merce</th>
        <th>Peso</th>
        <th>Giorni di Magazzinaggio</th>
        <th>Tariffa giornaliera</th>
    </tr>
    <tr>
        <?php
            echo "<td>". $polizza->getId() . "</td>";
            echo "<td>". $polizza->getTipologiaMerce() . "</td>";
            echo "<td>". $polizza->getPeso() . "</td>";
            echo "<td>". $polizza->getGiorniMagazzinaggio() . "</td>";
            echo "<td>". $polizza->getTariffa(). "</td>";
        ?>
    </tr>

    <form action="richiediBuono.php" method="post">
        <input type="number" name="quantita" placeholder="Quantità" min="1" max=<?php echo $polizza->getPeso(); ?> required><br>
        <label>Ritirante: </label>
        <select name="ritirante">
            <?php
                foreach($ritiranti as $ritirante){
                    $id=$ritirante->getId();
                    $username=$ritirante->getUsername();
                    echo"<option value='$id'>$username</option>";
                }
            ?>
        </select><br>
        <button name="invia" value=<?php echo $polizza->getId(); ?>>Invia Richiesta</button><br>
    </form>
    <br>
    <a href="visualizzaPolizze.php"><button>Torna Indietro</button></a>
</body>
</html>