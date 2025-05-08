<?php
    require_once("../classi/DB.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_GET["err"])){
        echo $_GET["err"] . "<br>";
    }

    if(isset($_POST["login"])){
        $db=new DB();
        $utente=$db->getUtente($_POST["username"], $_POST["password"]);

        if($utente==null){
            header("location: index.php?err=credenziali errate");
            exit;
        }

        $_SESSION["user"]=$utente;

        if($utente->getRuolo()=="cliente"){
            header("location: ../cliente/cliente.php");
            exit;
        }
        else if($utente->getRuolo()=="personale"){
            header("location: ../personale/personale.php");
            exit;
        }
        else if($utente->getRuolo()=="autotrasportatore"){
            header("location: ../autotrasportatore/autotrasportatore.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal</title>
    <link rel="stylesheet" href="bootstrap.css">
    <script src="bootstrap.js"></script>
</head>
<body>
    <a href="signup.php"><button type="button" class="btn btn-primary">Registrati</button></a><br>
    
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>