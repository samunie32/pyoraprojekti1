<?php
$username = $_POST["uname"];
$password = $_POST["psw"];

// Tietokannan yhteyden muodostaminen
$servername = "localhost";
$dbusername = "root";
$dbpassword = "1234";
$dbname = "fillaritsygä";

// Luodaan yhteys tietokantaan
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Tarkistetaan yhteys
if (!$conn) {
    die("Tietokantayhteys epäonnistui: " . mysqli_connect_error());
}

// Valitaan tietokannan taulu ja haetaan käyttäjän tiedot
$sql = "SELECT käyttäjätunnus, salasana FROM käyttäjä WHERE käyttäjätunnus='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Käyttäjä löytyi, tarkistetaan salasana
    $row = mysqli_fetch_assoc($result);
    if($row["salasana"] == $password){
        header("Location: index.html");
        exit;
    } else{
        echo "Väärä salasana. Yritä uudelleen.";
    }
} else {
    echo "Käyttäjää ei löytynyt. Yritä uudelleen.";
}

// Suljetaan tietokantayhteys
mysqli_close($conn);
?>








