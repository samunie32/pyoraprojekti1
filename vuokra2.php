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
$loppu_aika = strtotime($start_time);

$seconds = $loppu_aika - $alku_aika;
$hours = $seconds / 3600;
//$pyora_id = $_POST['pyora_id'];
$pyora_id = (int)$_POST['option'];

// Tietokantayhteys
$servername = "localhost";
$user = "root";
$password = "1234";
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


// Luodaan sql-lause varauksen lisäämiseksi
$sql = "INSERT INTO vuokraus (paivamaara, aika, tunnit,kayttaja_id)
VALUES ('$date', '$start_time', '$hours','$kayttaja_id')";

// Suoritetaan sql-lause
if ($conn->query($sql) === TRUE) {
    echo "Varaus lisätty onnistuneesti.";
} else {
    echo "Virhe lisättäessä varausta: " . $conn->error;
}

$conn->close();
?>

<div class="footer">
    <h2>Yhteystiedot </h2>
    <h5>Puhelin: +358 000 000 00</h5>
    <h5>Sähköposti: parhaatpyorat@on.com</h5>
    <h5>Lähin myymälä: Ei ole.</h5>
</div>
<link rel="stylesheet" href="tyyli2.css">
</body>
<script>

    var modal = document.getElementById('id01');


    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>

