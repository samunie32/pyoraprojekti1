<?php
session_start();
$username = $_POST["uname"];
$password = $_POST["psw"];




// Tietokannan yhteyden muodostaminen
$servername = "localhost";
$dbusername = "root";
$dbpassword = "1234";
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
        echo "<script type='text/javascript'>
    alert('Väärä salasana. Yritä uudelleen.');
    window.location.href = 'index.html';
    </script>";
    }
} else {
    echo "<script type='text/javascript'>
    alert('Käyttäjää ei löytynyt. Yritä uudelleen.');
    window.location.href = 'index.html';
    </script>";
}

mysqli_close($conn);
?>








