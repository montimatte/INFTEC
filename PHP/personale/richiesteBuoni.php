<?php
    require_once("classi/DB.php");

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
        $db->updateBuono($id,$stato);

        header("location: richesteBuoni.php?err=operazione completata");
        exit;
    }
    else{
        $buoni=$db->getBuoniByStato("in attesa");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richieste Buoni</title>
</head>
<body>
<table>
        <tr>
            <th>ID buono</th>
            <th>Cliente</th>
            <th>Peso</th>
            <th>ID polizza</th>
            <th>Tipologia Merce</th>
            <th></th>
        </tr>
        <?php
            echo "<tr>";
            foreach($buoni as $buono){
                $id=$buono->getId();
                echo "<td>". $id ."<td>";
                echo "<td>". $buono->getCliente() ."<td>";
                echo "<td>". $buono->getPeso() ."<td>";
                echo "<td>". $buono->getIdPolizza() ."<td>";
                echo "<td>". $buono->getTipologiaMerce() ."<td>";
                
                echo "<td>
                    <form action='richiesteBuoni.php' method='post'>
                        <button name='accetta' value='$id'>Accetta</button>
                        <button name='rifiuta' value='$id'>Rifiuta</button>
                    </form>
                </td>";

            }
            echo "</tr>";
        ?>
    </table>
    <br><br>
    <a href="personale.php"><button>Torna alla Home</button></a>
</body>
</html>