<?php
include 'prihlasovacieUdaje.php';

class Databaza
{
    private const DB_HOST = "localhost";
    private const DB_NAME = "udaje";
    private const DB_USER = 'root';
    private const DB_PASS = 'dtb456';

    private $database;

    public function __construct()
    {
        try {
            $this->database = new PDO('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST, self::DB_USER, self::DB_PASS);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
   public function load()
    {
        $udaje = [];
        $dbUdaje = $this->database->query('SELECT * FROM prihludaje');

        foreach ($dbUdaje as $udaj)
        {
            $udaje[] = new prihlasovacieUdaje($udaj['login'], $udaj['heslo'], $udaj['heslo']);
        }
        return $udaje;
    }

    public function skontrolujLogin() : bool
    {
        $dbLogin = $this->database->query('SELECT login from prihludaje');

        foreach ($dbLogin as $login) {
            if ($login['login'] == $_POST['meno']) {
                return false;
            }
        }
        return true;
    }


    public function save(prihlasovacieUdaje $udaj) : bool
    {
        try {
            if($this->skontrolujLogin()) {
                if ($udaj->skontrolujHeslo()) {
                    $sql = 'INSERT INTO prihludaje(login, heslo) VALUES (?,?)';
                    $this->database->prepare($sql)->execute([$udaj->getLogin(), $udaj->getHeslo()]);
                    return true;
                } else {
                    echo '<script>alert("Zadane hesla sa nezhoduju.")</script>';
                    return false;
                }
            } else{
                echo '<script>alert("Zadany login uz existuje.")</script>';
                return false;
            }
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
            return false;
        }
    }

    public function noveHeslo($zadlogin, $noveHeslo): bool
    {
        try{
            $sql = "UPDATE prihludaje SET heslo=? WHERE login=?";
            $this->database->prepare($sql)->execute([$noveHeslo, $zadlogin]);
            return true;

        } catch (PDOException $e) {
            echo 'Failed: ' . $e->getMessage();
            return false;
        }


    }

    public function odstran($zadlogin): bool
    {
        try{
            $sql = "DELETE FROM prihludaje WHERE login=?";
            $this->database->prepare($sql)->execute([$zadlogin]);
            return true;
        } catch (PDOException $e) {
            echo 'Failed: ' . $e->getMessage();
            return false;
        }
    }
}