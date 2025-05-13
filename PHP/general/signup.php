<?php
    require_once("../classi/DB.php");

    if(isset($_GET["err"])){
        echo '
        <div class="alert alert-warning" role="alert">'.
            $_GET["err"].
        '</div>';
    }

    if(isset($_POST["signup"])){
        if(!empty($_POST["username"])&& !empty($_POST["password"])){
            $utente= new Utente(0,$_POST["username"],md5($_POST["password"]),$_POST["ruolo"]);
            $db=new DB();
            $ris=$db->addUtente($utente);
            if($ris!=null){
                header("location: signup.php?err=$ris");
                exit;
            }
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
    <link rel="stylesheet" href="../bootstrap.css">
    <script src="../bootstrap.js"></script>
</head>
<body>
    
    <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Registrazione</h3>
            <form action="signup.php" method="post">
                <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" name="username" id="typeEmailX-2" class="form-control form-control-lg" required/>
                <label class="form-label" for="typeEmailX-2">Username</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" required/>
                <label class="form-label" for="typePasswordX-2">Password</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <select name="ruolo" id="typeRoleX-2" class="form-select form-select-lg mb-3" aria-label="Large select example">
                        <option value="cliente">Cliente</option>
                        <option value="autotrasportatore">Autotrasportatore</option>
                    </select>
                <label class="form-label" for="typeRoleX-2">Ruolo</label>
                </div>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit" name="signup">Registrati</button>
            </form>

            <hr class="my-4">

            <a href="index.php"><button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit" name="login">Torna alla Login</button></a>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>