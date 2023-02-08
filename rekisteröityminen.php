<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "fillaritsyga";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
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
    header("Location:rekisteri.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


