<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION["username"];

// Tietokantayhteyden muodostaminen
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "fillaritsyga";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Tietokantayhteyden muodostaminen epäonnistui: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $option = $_POST['option'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Tarkista, että aloitus- ja lopetusaika ovat täsmälleen tasatunneilla
    $start_time = date('H:00:00', strtotime($start_time));
    $end_time = date('H:00:00', strtotime($end_time));

    // Tarkista, että aika-väli on vähintään 1 tunti
    $diff = strtotime($end_time) - strtotime($start_time);
    if ($diff >= 3600) {
        $sql = "INSERT INTO reservations (option, date, start_time, end_time)
        VALUES ('$option', '$date', '$start_time', '$end_time')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Varaus tehty onnistuneesti!";
        } else {
            $_SESSION['message'] = "Virhe varausta tehdessä: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = "Varausaika on liian lyhyt. Vähimmäisaika-väli on 1 tunti.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Varauskalenteri</title>
</head>
<body>

<form action="calendar.php" method="post">
    <select name="option">
        <option value="GT">GT</option>
        <option value="Cube">Cube</option>
        <option value="White">White</option>
        <option value="Scott">Scott</option>
    </select><br><br>
    Päivämäärä:
    <input type="date" name="date"><br><br>
    Aloitusaika:
    <input type="time" name="start_time", step="3600"><br><br>
    Lopetusaika:
    <input type="time" name="end_time", step="3600"><br><br>
    <input type="submit" name="submit" value="Tee varaus">
</form>

<?php
if (isset($_SESSION['message'])) {
    echo "<br>" . $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

</body>
</html>





