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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="tyyli.css">
    <meta charset="UTF-8">
    <title>pyörävuokraamo</title>
</head>
<body>
<ul>
    <li><a class="active" href=index.php style="float: left;font-size: 26px">Paras pyörävuokraamo</a></li>

    <li><a href="vuokraukset.php" style="float:left;text-align: end">Omat vuokraukset</a></li>
    <li><button onclick="location.href='logout.php';" style="width:auto;float:right ">Kirjaudu ulos</button></li>
</ul>
<h3>Omat vuokraukset</h3> <br>
<table>
    <thead>

    </thead>
    <tbody>
<form action="peruvuokra.php" method="post">
    <div class="custom-select" style="width:200px; margin-bottom: 40px; margin-top: 25px;">
        <select name="option">
            <option value="0">Varauksen peruminen:</option>
            <?php
            $username = $_SESSION["username"];

            $sql = "SELECT ID FROM vuokraus WHERE kayttaja_id = (SELECT id FROM kayttaja WHERE kayttajatunnus = '$username')";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['ID'].'">'.$row['ID'].'</option>';
            }
            ?>
        </select>
    </div>
    <input type="submit" value="Peru varaus">
</form>





<?php

// SQL-kysely
$sql = "SELECT vuokraus.paivamaara, vuokraus.aika, vuokraus.tunnit,vuokraus.id, pyora.nimi, pyora.tuntihinta
FROM kayttaja
JOIN vuokraus ON kayttaja.ID = vuokraus.kayttaja_id
JOIN pyora ON vuokraus.pyora_id = pyora.ID
WHERE kayttaja.kayttajatunnus = '$username'";




// Suoritetaan kysely
$result = $conn->query($sql);

// Tarkistetaan, onko kysely palauttanut tuloksia
if ($result->num_rows > 0) {
    // Tulostetaan tiedot taulukossa
    echo '<table>
            <tr>
                <th>id</th>
                <th>Päivämäärä</th>
                <th>Aika</th>
                <th>Tunnit</th>
                <th>Pyörän nimi</th>
                <th>Tuntihinta</th>
                <th>Hinta yhteensä</th>
            </tr>';
    while ($row = $result->fetch_assoc()) {
        $total_cost = $row["tuntihinta"] * $row["tunnit"];
        echo '<tr>
                <td>' . $row["id"] . '</td>
                <td>' . $row["paivamaara"] . '</td>
                <td>' . $row["aika"] . '</td>
                <td>' . $row["tunnit"] . '</td>
                <td>' . $row["nimi"] . '</td>
                <td>' . $row["tuntihinta"] . '</td>
                <td>' . $total_cost . '</td>
              </tr>';

    }
    echo '</table>';

} else {
    echo "Ei varauksia.";

}

$conn->close();

?>