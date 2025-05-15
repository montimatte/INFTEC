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
    $polizza;
    $ritiranti;
    if(isset($_POST["richiedi"])){
        $polizza=$db->getPolizzaById($_POST["richiedi"]);
        if($polizza==null){
            echo '
        <div class="alert alert-warning" role="alert">'.
            "ERRORE: NESSUNA POLIZZA NEL DB".
        '</div>';
        }
        $ritiranti=$db->getRitirantiByCliente($_SESSION["user"]->getId());
        if($ritiranti==null){
            echo '
            <div class="alert alert-warning" role="alert">'.
                "ERRORE: NESSUN RITIRANTE NEL DB".
            '</div>';
        }
    }
    else if (isset($_POST["invia"])){
        $ris=$db->inviaRichiesta($_SESSION["user"]->getId(),$_POST["ritirante"],$_POST["invia"],$_POST["quantita"]);
        if($ris!=null){
            header("location: visualizzaPolizze.php?err=$ris");
            exit;
        }
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
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    <table class="table table-striped">
        <tr>
            <th>ID Polizza</th>
            <th>Merce</th>
            <th>Peso</th>
            <th>Giorni di Magazzinaggio</th>
            <th>Tariffa giornaliera</th>
        </tr>
        <tr>
            <?php
                $id=$polizza->getId();
                $tot=$db->getQuantitaRichiestaPolizza($id);

                echo "<td>". $polizza->getId() . "</td>";
                echo "<td>". $polizza->getTipologiaMerce() . "</td>";
                echo "<td>". $polizza->getPeso()." - (".$polizza->getPeso()-$tot. " rimanenti)</td>";
                echo "<td>". $polizza->getGiorniMagazzinaggio() . "</td>";
                echo "<td>". $polizza->getTariffa(). "</td>";
            ?>
        </tr>
    </table>

    <form action="richiediBuono.php" method="post">
        <div class="mb-3 row">
            <div class="col-auto">
                <label>Quantità: </label>
                <input class="form-control" type="number" name="quantita" min="1" max=<?php echo $polizza->getPeso()-$tot; ?> required>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-auto">
                <label>Ritirante:</label>
                <select class="form-select" name="ritirante">
                    <?php
                        foreach($ritiranti as $ritirante){
                            $id=$ritirante->getId();
                            $idautotrasportatore=$ritirante->getIdAutotraportatore();
                            $autotrasportatore=$ritirante->getAutotrasportatore();
                            $targa=$ritirante->getTarga();
                            $str=$targa." - ".$autotrasportatore;
                            echo"<option value='$id'>$str</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <button class="btn btn-secondary" name="invia" value=<?php echo $polizza->getId();?>>Invia Richiesta</button>
    </form>

    <br>
    <a href="visualizzaPolizze.php"><button class="btn btn-outline-primary">Torna Indietro</button></a>
</body>
</html>