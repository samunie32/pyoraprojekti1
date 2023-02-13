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


// Luodaan sql-lause varauksen lisäämiseksi
$sql = "INSERT INTO vuokraus (paivamaara, aika, tunnit, kayttaja_id, Pyora_ID)
VALUES ('$date', '$start_time', '$hours','$kayttaja_id', $option)";

// Suoritetaan sql-lause
if ($conn->query($sql) === TRUE) {
    echo "Varaus lisätty onnistuneesti.";


} else {
    echo "Virhe lisättäessä varausta: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="tyyli.css">
    <meta charset="UTF-8">
    <title>pyörävuokraamo</title>
</head>
<body>
<ul>
    <li><a class="active" href=index.php style="float: left;font-size: 26px">Paras pyörävuokraamo</a></li>
    <li><a  href=Kalenteri.html style="float:left;text-align: end">Kalenteri</a></li>

    <li><button onclick="location.href='logout.php';" style="width:auto;float:right ">Kirjaudu ulos</button></li>
</ul>
<div id="id01" class="modal">

    <form class="modal-content animate" action="kirjautuminen.php" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        </div>

        <div class="container">
            <label for="uname"><b>Käyttäjätunnus</b><br></label>
            <input type="text" placeholder="Syötä käyttäjätunnus" name="uname" required>

            <label for="psw"><b>Salasana</b></label>
            <input type="salasana" placeholder="Syötä salasana" name="psw" required>

            <button type="submit">Kirjaudu</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Muista minut
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Peruuta</button>
            <span class="psw"> <a href="rekisteröityminen.html">Rekisteröidy</a></span>
        </div>
    </form>
</div>
<h2>
    <title>Varauskalenteri</title>
</h2>

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

