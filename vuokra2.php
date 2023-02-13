<?php
session_start();


if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}
$username = $_SESSION["username"];

$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

$alku_aika = strtotime($start_time);
$loppu_aika = strtotime($end_time);

$seconds = $loppu_aika - $alku_aika;
$hours = $seconds / 3600;

$option = $_POST['option'];

// Tietokantayhteys
$servername = "localhost";
$user = "root";
$password = "Juures2";
$dbname = "fillaritsyga";

// Luodaan yhteys
$conn = new mysqli($servername, $user, $password, $dbname);

// Tarkistetaan yhteys
if ($conn->connect_error) {
    die("Yhteysvirhe: " . $conn->connect_error);
}


// Haetaan kayttaja_id taulusta kayttaja
$kayttaja_query = "SELECT id FROM kayttaja WHERE kayttajatunnus = '$username'";
$kayttaja_result = $conn->query($kayttaja_query);
$kayttaja = $kayttaja_result->fetch_assoc();
$kayttaja_id = $kayttaja["id"];

if ($_POST['option'] == 0) {
    echo "<script type='text/javascript'>alert('Valitse vuokrattava pyörä!'); window.location.href='vuokra.php';</script>";
    exit();
}

// Luodaan sql-lause varauksen lisäämiseksi
$sql = "INSERT INTO vuokraus (paivamaara, aika, tunnit, kayttaja_id, Pyora_ID)
VALUES ('$date', '$start_time', '$hours','$kayttaja_id', $option)";


if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Varaus onnistui!');
    window.location.href = 'vuokraukset.php';
    </script>";
    exit;
} else {
    echo "<script type='text/javascript'>
    alert('Varaus epäonnistui!');
    window.location.href = 'vuokra.php';
    </script>";
    exit;
}


$conn->close();
?>
