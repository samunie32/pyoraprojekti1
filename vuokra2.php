<?php
session_start();
$username = $_SESSION['username'];

$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$hours = $end_time - $start_time;


// Tietokantayhteys
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "fillaritsyga";

// Luodaan yhteys
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkistetaan yhteys
if ($conn->connect_error) {
    die("Yhteysvirhe: " . $conn->connect_error);
}

// Haetaan kayttaja_id taulusta kayttaja
$kayttaja_query = "SELECT id FROM kayttaja WHERE kayttajatunnus = '$username'";
$kayttaja_result = $conn->query($kayttaja_query);
$kayttaja = $kayttaja_result->fetch_assoc();
$kayttaja_id = $kayttaja['id'];

if(isset($_POST['submit'])) {
    $selected_val = $_POST['option'];  // Storing Selected Value In Variable
    $query = "SELECT id FROM pyora WHERE merkki = '$selected_val'";
    $result = mysqli_query($conn, $query);
    $pyora = $result->fetch_assoc();
    $pyora_id=$pyora['id'];

}
// Luodaan sql-lause varauksen lisäämiseksi
$sql = "INSERT INTO vuokraus (paivamaara, aika, tunnit, kayttaja_id, pyora_id)
VALUES ('$date', '$start_time', '$hours', '$kayttaja_id', '$pyora_id')";

// Suoritetaan sql-lause
if ($conn->query($sql) === TRUE) {
    echo "Varaus lisätty onnistuneesti.";
} else {
    echo "Virhe lisättäessä varausta: " . $conn->error;
}

$conn->close();
?>
