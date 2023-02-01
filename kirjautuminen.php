<?php
// Tietokannan yhteys
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "fillaritsygä";

// Luodaan yhteys tietokantaan
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Tarkistetaan, onko yhteys onnistunut
if (!$conn) {
    die("Yhteys epäonnistui: " . mysqli_connect_error());
}

// Tarkistetaan, onko lomake lähetetty
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hakee käyttäjätunnuksen ja salasanan lomakkeelta
    $username = mysqli_real_escape_string($conn, $_POST['käyttäjätunnus']);
    $password = mysqli_real_escape_string($conn, $_POST['salasana']);

    // Tarkistaa, löytyykö käyttäjätunnus ja salasana tietokannasta
    $sql = "SELECT * FROM käyttäjä WHERE käyttäjätunnus = '$username' and salasana = '$password'";
    $result = mysqli_query($conn, $sql);

    // Tarkistaa, onko käyttäjätunnus ja salasana oikein
    if (mysqli_num_rows($result) == 1) {
        // Kirjautuminen onnistui, ohjataan käyttäjä sisäänkirjautumissivulta
        header("Location: index.html");
        exit();
    } else {
        // Kirjautuminen epäonnistui, näytetään virheviesti
        $error = "Väärä käyttäjätunnus tai salasana";
    }

    // Suljetaan tietokantayhteys
    mysqli_close($conn);
}
?>

