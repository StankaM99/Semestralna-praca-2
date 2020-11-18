<?php
require "databaza.php";
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
                <a id="Registr" class="nav-link" href="register.php">Registracia</a>
            </li>

        </ul>
    </div>

    <div>
        <a class="btn btn-block btn-warning" href="admin.php">ADMIN</a>
    </div>

</nav>

    <div class="register">
            <?php
            $database = new databaza();

            $udaje = $database->load();
            /** @var prihlasovacieUdaje $udaj */

            $x=1;
            echo '<h2>' . "Registrovaní užívatelia". '</h2>' ;
            echo '__________________________________________________';
            foreach($udaje as $udaj)
            {
            echo '<div>';
            echo '<p>' . "uzivatel $x :   login = " . $udaj->getLogin()." , heslo = " .  $udaj->getHeslo() . '</p>';
            $x++;
            echo '</div>';
            }
            ?>


            <form method="post">
                <div class="text">
                <br>
                <br>
                <label>Úprava údajov : </label>
                <div>
                    <label for="zmena_hesla">Zmena hesla : zadajte login</label>
                    <input type="text" name="zadany_login">
                </div>
                <div>
                    <label for="nove_heslo">Zadajte nové heslo :</label>
                    <input type="text" name="nove_heslo">
                </div>
                <input type="submit" name="uprava" value="Upraviť">
                    </div>
            </form>

            <?php
            $database = new databaza();

            if(isset($_POST['zadany_login']))
            {
                $pom = $database->noveHeslo($_POST['zadany_login'], $_POST['nove_heslo']);

                if($pom)
                {
                    header("Location: admin.php" );
                }
                else{
                    echo '<script>alert("Nepodarilo sa zmeniť heslo.")</script>';
                }
            }
            ?>

            <form method="post">
                <div class="text">
                <br>
                <div>
                    <label for="odstan">Odstránenie užívateľa : zadajte login</label>
                    <input type="text" name="login">
                </div>
                </div>
                <input type="submit" name="odstran" value="Odstrániť">

                <?php
                $database = new databaza();
                if(isset($_POST['login']))
                {
                    $pom = $database->odstran($_POST['login']);

                    if($pom)
                    {
                        header("Location: admin.php" );
                    }
                    else{
                        echo '<script>alert("Nepodarilo sa odstrániť používateľa.")</script>';
                    }
                }
                ?>

            </form>
    </div>

</body>
</html>