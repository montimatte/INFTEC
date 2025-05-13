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
    
    $buoni;
    if(isset($_POST["invia"])){
        $ris=$db->registraRitiro($_POST["invia"]);
        if($ris!=null){
            header("location: registraRitiro.php?err=$ris");
            exit;
        }

        $ris=$db->updateBuono($_POST["invia"],"usato");
        if($ris!=null){
            header("location: registraRitiro.php?err=$ris");
            exit;
        }

        $ris=$db->generaFattura($_POST["invia"]);
        if($ris!=null){
            header("location: registraRitiro.php?err=$ris");
            exit;
        }


        header("location: registraRitiro.php?err=operazione completata");
        exit;
    }
    else{
        $buoni=$db->getBuoniByStato("accettato");
        if($buoni==null){
            echo "ERRORE: NESSUN BUONO NEL DB";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registra Ritiro</title>
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
                echo "<td>". $buono->getTarga() ."</td>";
                echo "<td>". $buono->getAutotrasportatore() ."</td>";
               
                echo "<td>
                    <form action='registraRitiro.php' method='post'>
                        <button name='invia' value='$id'>Registra Ritiro</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        ?>
    </table>
    <br><br>
    <a href="personale.php"><button>Torna alla Home</button></a>
</body>
</html>