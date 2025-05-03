<?php
    require_once("classi/DB.php");

    if(isset($_GET["err"])){
        echo $_GET["err"] . "<br>";
    }

    if(isset($_POST["signup"])){
        if(!empty($_POST["username"])&& !empty($_POST["password"])){
            $utente= new Utente(0,$_POST["username"],md5($_POST["password"]),$_POST["ruolo"]);
            $db=new DB();
            $db->addUtente($utente);
            header("location: index.php?err=registrazione completata");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <form method="post" action="signup.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <label>Ruolo: </label>
        <select name="ruolo">
            <option value="cliente">Cliente</option>
            <option value="autotrasportatore">Autotrasportatore</option>
        </select>
        <br>
        <input type="submit" name="signup" value="Registrati">
    </form>
    <br>
    <a href="index.php"><button>Torna alla login</button></a>
</body>
</html>