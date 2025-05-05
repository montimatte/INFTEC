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
    $ritiranti;
    if(isset($_POST["invia"])){
        $db->registraRitiro($_POST["ritirante"],$_POST["buono"]);
        $db->updateBuono($_POST["buono"],"usato");
        header("location: registraRitiro.php?err=operazione completata");
        exit;
    }
    else{
        $ritiranti=$db->getUtenteByRuolo("autotrasportatore");
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
    <form action="registraRitiro.php" method="post">
        <select name="ritirante">
            <?php
                foreach($ritiranti as $ritirante){
                    $id=$ritirante->getId();
                    $username=$ritirante->getUsername();
                    echo"<option value='$id'>$username</option>";
                }
            ?>
        </select>
        <input type="number" name="buono" min="1" placeholder="ID buono" required>
        <input type="submit" name="invia" value="Registra">
    </form>
    <br><br>
    <a href="personale.php"><button>Torna alla Home</button></a>
</body>
</html>