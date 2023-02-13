<?php

session_start();

$conn = mysqli_connect("localhost", "root", "Juures2", "fillaritsyga");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_id = $_POST["option"];

    if ($selected_id != 0) {
        $sql = "DELETE FROM vuokraus WHERE ID = $selected_id";




            if (mysqli_query($conn, $sql)===TRUE) {

                    echo "<script type='text/javascript'>
                    alert('Varauksen peruminen onnistui!');
                    window.location.href = 'vuokraukset.php';
                    </script>";
                        }
                    else {
                            echo "Virhe peruttaessa varausta: " . mysqli_error($conn);


}       }}

mysqli_close($conn);

?>
