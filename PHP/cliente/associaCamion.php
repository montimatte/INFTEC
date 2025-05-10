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

    if(isset($_POST["associa"])){
        $ris=$db->associaCamion($_POST["camion"],$_POST["autotrasportatore"]);
        if($ris!=null){
            header("location: associaCamion.php?err=$ris");
            exit;
        }
        header("location: associaCamion.php?err=operazione completata");
        exit;
    }

    $autotrasportatori=$db->getUtenteByRuolo("autotrasportatore");
    if($autotrasportatori==null){
        echo "ERRORE: NESSUN AUTOTRASPORTRATORE NEL DB";
    }
    $camions=$db->getCamion($_SESSION["user"]->getId());
    if($camions==null){
        echo "ERRORE: NESSUN CAMION NEL DB";
    }
    $ritiranti=$db->getRitirantiByCliente($_SESSION["user"]->getId());
    if($ritiranti==null){
       echo "ERRORE: NESSUN RITIRANTE NEL DB";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associa Camion</title>
</head>
<body>
    <form action="associaCamion.php" method="post">
        <label>Camion:</label>
        <select name="camion">
            <?php
                foreach($camions as $camion){
                    echo"<option value='$camion'>$camion</option>";
                }
            ?>
        </select>
        <br>
        <label>Autotrasportatore:</label>
        <select name="autotrasportatore">
            <?php
                foreach($autotrasportatori as $autotrasportatore){
                    $id=$autotrasportatore->getId();
                    $username=$autotrasportatore->getUsername();
                    echo"<option value='$id'>$username</option>";
                }
            ?>
        </select>
        <input type="submit" name="associa" value="Associa">
    </form>
    <br><br>
    <a href="cliente.php"><button>Torna alla Home</button></a>
    <br><br>
    <table>
        <tr>
            <th>Targa</th>
            <th>Autotrasportatore</th>
        </tr>
        <?php
            foreach($ritiranti as $ritirante){
                echo"<tr>";
                echo"<td>".$ritirante->getTarga()."</td>";
                echo"<td>".$ritirante->getAutotrasportatore()."</td>";
                echo"</tr>";
            }
        ?>
    </table>
</body>
</html>