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
        echo '
        <div class="alert alert-warning" role="alert">'.
            $_GET["err"].
        '</div>';
    }

    $db=new DB();
    $buoni;

    if(isset($_POST["accetta"])||isset($_POST["rifiuta"])){
        $id;
        $stato;
        if(isset($_POST["accetta"])){
            $id=$_POST["accetta"];
            $stato="accettato";
        }
        else if(isset($_POST["rifiuta"])){
            $id=$_POST["rifiuta"];
            $stato="rifiutato";
        }
        $ris=$db->updateBuono($id,$stato);
        if($ris!=null){
            header("location: richiesteBuoni.php?err=$ris");
            exit;
        }

        header("location: richiesteBuoni.php?err=operazione completata");
        exit;
    }
    else{
        $buoni=$db->getBuoniByStato("in attesa");
        if($buoni==null){
            echo '
            <div class="alert alert-warning" role="alert">'.
                "ERRORE: NESSUN BUONO NEL DB".
            '</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richieste Buoni</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>

</head>
<body>
<table class="table table-striped">
        <tr>
            <th>ID buono</th>
            <th>Cliente</th>
            <th>Peso</th>
            <th>ID polizza</th>
            <th>Tipologia Merce</th>
            <th></th>
        </tr>
        <?php
            foreach($buoni as $buono){
                echo "<tr>";
                $id=$buono->getId();
                echo "<td>". $id ."</td>";
                echo "<td>". $buono->getCliente() ."</td>";
                echo "<td>". $buono->getPeso() ."</td>";
                echo "<td>". $buono->getIdPolizza() ."</td>";
                echo "<td>". $buono->getTipologiaMerce() ."</td>";
                
                echo "<td>
                    <form action='richiesteBuoni.php' method='post'>
                        <button class='btn btn-success' name='accetta' value='$id'>Accetta</button>
                        <button class='btn btn-danger' name='rifiuta' value='$id'>Rifiuta</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        ?>
    </table>
    <a href="personale.php"><button class="btn btn-outline-primary">Torna alla Home</button></a>
</body>
</html>