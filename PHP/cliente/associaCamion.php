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
        echo '
        <div class="alert alert-warning" role="alert">'.
            "ERRORE: NESSUN AUTOTRASPORTRATORE NEL DB".
        '</div>';
    }
    $camions=$db->getCamion($_SESSION["user"]->getId());
    if($camions==null){
        echo '
        <div class="alert alert-warning" role="alert">'.
            "ERRORE: NESSUN CAMION NEL DB".
        '</div>';
    }
    $ritiranti=$db->getRitirantiByCliente($_SESSION["user"]->getId());
    if($ritiranti==null){
        echo '
        <div class="alert alert-warning" role="alert">'.
            "ERRORE: NESSUN RITIRANTE NEL DB".
        '</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associa Camion</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    <form action="associaCamion.php" method="post">
        <div class="mb-3 row">
            <div class="col-auto">
                <label>Camion:</label>
                <select class="form-select" name="camion">
                    <?php
                        foreach($camions as $camion){
                            echo"<option value='$camion'>$camion</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-auto">
                <label>Autotrasportatore:</label>
                <select class="form-select" name="autotrasportatore">
                    <?php
                        foreach($autotrasportatori as $autotrasportatore){
                            $id=$autotrasportatore->getId();
                            $username=$autotrasportatore->getUsername();
                            echo"<option value='$id'>$username</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <button class="btn btn-secondary" name="associa">Associa</button>
    </form>

    <br>
    
    <div class="row gy-2 gx-3 align-items-center">
        <div class="col-auto">
            <table class="table table-striped">
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
        </div>
    </div>

    <br>
    <a href="cliente.php"><button class="btn btn-outline-primary">Torna alla Home</button></a>
</body>
</html>