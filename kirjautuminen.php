<?php
session_start();
$username = $_POST["uname"];
$password = $_POST["psw"];

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// Tietokannan yhteyden muodostaminen
$servername = "localhost";
$dbusername = "root";
$dbpassword = "Juures2";
$dbname = "fillaritsyga";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Tietokantayhteys epäonnistui: " . mysqli_connect_error());
}

if ($username == "admin") {
    $_SESSION["username"] = $username;
    header("Location: admin.php");
    exit;
}

$sql = "SELECT kayttajatunnus, salasana FROM kayttaja WHERE kayttajatunnus='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if($row["salasana"] == $password){
        $_SESSION["username"] = $username;
        header("Location: vuokraukset.php");
        exit;
    } else{
        echo "Väärä salasana. Yritä uudelleen.";
    }
} else {
    echo "Käyttäjää ei löytynyt. Yritä uudelleen.";
}

mysqli_close($conn);
?>








