<?php
require "databaza.php";

$database = new databaza();

if(isset($_POST['meno'], $_POST['inputPassword'], $_POST['inputPasswordRep'])) {
    $udaj = new prihlasovacieUdaje($_POST['meno'], $_POST['inputPassword'], $_POST['inputPasswordRep']);
    $pom = $database->save($udaj);

    if($pom)
    {
        header("Location: uspesReg.html" );
    }
    else{
        echo '<script>alert("Nepodarilo sa zaregistrovať.")</script>';
    }

}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Semestrálna práca</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        

        <link rel = "stylesheet" href = "css/main.css">

    <body>
        <nav id="navbar" class="navbar sticky-top navbar-expand-md navbar-light mb-4" style="background-color:coral;">

            <a class="navbar-brand disabled">
                <img width="40" height="40" src="https://image.flaticon.com/icons/png/512/31/31087.png" alt="ob">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">

                <li class="nav-item ">
                    <a id="Home" class="nav-link" href="index.html">Home</a>
                </li>

                <li class="nav-item ">
                  <a id="Price" class="nav-link" href="price.html">Ceny</a>
                </li>

                  <li class="nav-item ">
                      <a id="Registr" class="nav-link disabled" href="#">Registracia</a>
                  </li>

              </ul>
            </div>

            <div>
              <a class="btn btn-block btn-warning" href="aHeslo.php">ADMIN</a>
              </div>

          </nav>

          <div  class="naStred">
          <div class="nadpis">
          <form class="form-signin" method="post" >
            <img class="mb-4" width="65" height="65" src="https://cdn.onlinewebfonts.com/svg/img_532171.png" alt="">
            <h1 class="h3 mb-3 font-weight-normal">Zadajte vaše údaje</h1>

            <label for="meno" class="sr-only">Login</label>
            <input type="text" id="meno" name="meno" class="form-control" placeholder="Login" required autofocus>

            <br>

            <label for="inputPassword" class="sr-only">Heslo</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Heslo" required>

            <br>

            <label for="inputPasswordRep" class="sr-only">Zopakuj heslo</label>
            <input type="password" id="inputPasswordRep" name="inputPasswordRep" class="form-control" placeholder="Zopakuj heslo" required>
              <br>

                  <button class="btn btn-block btn-warning" type="submit" >Registracia</button>

          </form>
        </div>
    </div>
    </body>
</html>