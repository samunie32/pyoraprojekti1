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
$seconds = $end_time - $start_time;
$hours = $seconds / 3600;
$pyora_id = $_POST['pyora_id'];

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
/*
// Haetaan kayttaja_id taulusta kayttaja
$kayttaja_query = "SELECT id FROM kayttaja WHERE kayttajatunnus = '$username'";
$kayttaja_result = $conn->query($kayttaja_query);
$kayttaja = $kayttaja_result->fetch_assoc();
$kayttaja_id = $kayttaja['id'];

// Luodaan sql-lause varauksen lisäämiseksi
$sql = "INSERT INTO vuokraus (paivamaara, aika, tunnit, kayttaja_id, pyora_id)
VALUES ('$date', '$start_time', '$hours', '$kayttaja_id', '$pyora_id')";

// Suoritetaan sql-lause
if ($conn->query($sql) === TRUE) {
    echo "Varaus lisätty onnistuneesti.";
} else {
    echo "Virhe lisättäessä varausta: " . $conn->error;
}
*/
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
<body>

<form action="vuokra2.php" method="post">
    <div class="custom-select" style="width:200px; margin-bottom: 40px; margin-top: 25px;">
        <select name="option">
            <option value="0">Valitse pyörä:</option>
            <option value="1">GT</option>
            <option value="2">White</option>
            <option value="3">Scott</option>
            <option value="4">Cube</option>
        </select>


    </div>

    <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;
            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);
            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");
            for (j = 1; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function(e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }
        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,
            except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
    </script>

    Päivämäärä:
    <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required><br><br>
    Aloitusaika:
    <input type="time" name="start_time" value="<?php echo date('H:i'); ?>" required><br><br>
    Lopetusaika:
    <input type="time" name="end_time" value="<?php echo date('H:i', strtotime('+1 hour')); ?>" required><br><br>
    <input type="submit" name="submit" value="Varaa">
</form>
<link rel="stylesheet" href="tyyli2.css">

<div class="message">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</div>

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







