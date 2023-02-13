<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION["username"];

$servername = "localhost";
$user = "root";
$password = "1234";
$dbname = "fillaritsyga";

// Luodaan yhteys tietokantaan
$conn = new mysqli($servername, $user, $password, $dbname);

// Tarkistetaan, onko yhteys onnistunut
if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

// SQL-kysely
$sql = "DELETE FROM vuokraus
WHERE kayttaja_id = (SELECT ID FROM kayttaja WHERE kayttajatunnus = '$username')";

// Suoritetaan kysely
$result = $conn->query($sql);

// Tarkistetaan, onko kysely onnistunut
if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Varauksen peruminen onnistui!');
    window.location.href = 'vuokraukset.php';
    </script>";
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
