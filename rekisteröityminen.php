<?php
$servername = "localhost";
$username = "root";
$password = "Juures2";
$dbname = "fillaritsyga";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nimi = $_POST["nimi"];
$puhelin = $_POST["puhelin"];
$sahkoposti = $_POST["email"];
$kayttajatunnus = $_POST["kayttaja"];
$salasana = $_POST["psw"];

$sql = "INSERT INTO kayttaja (nimi, puhelin, sahkoposti, kayttajatunnus, salasana)
VALUES ('$nimi', '$puhelin', '$sahkoposti', '$kayttajatunnus', '$salasana')";

if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Rekisteröityminen onnistui! Voit nyt kirjautua sisään.');
    window.location.href = 'index.html';
    </script>";
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
