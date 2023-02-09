<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION["username"];


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
    <li><a  href=Kalenteri.html style="float:left;text-align: end">Kalenteri</a></li>
    <li><a href="vuokraukset.html" style="float:left;text-align: end">Omat vuokraukset</a></li>
    <li><button onclick="location.href='logout.php';" style="width:auto;float:right ">Kirjaudu ulos</button></li>
</ul>
<div id="id01" class="modal">

    <form class="modal-content animate" action="kirjautuminen.php" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        </div>

        <div class="container">
            <label for="uname"><b>Käyttäjätunnus</b></label>
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
            <span class="psw">Unohtuiko <a href="#">salasana?</a></span>
        </div>
    </form>
</div>
<h2>Cube</h2>
<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <h2>Reaction C:62 ONE NX12<</h2>
            <img src="https://www.xxl.fi/filespin/bf231fe22b3b411b89ee52e971abb21f?resize=1400,1400&quality=95&bgcolor=efefef" alt="Cube pyörä" style="width:450px;height:450px;">
        </div>
    </div>
    <div class="rightcolumn">
        <div class="card">
            <h2>10&#x20AC;/Tunti</h2>
            <h3>Maastopy&ouml;r&auml; unisex , Punainen</h3>
            <h4>T&auml;ll&auml; py&ouml;r&auml;ll&auml; kelpaa ajella!</h4>
            <button onclick="location.href='vuokra.php';" class="button" style="vertical-align:middle"><span>Vuokraa t&auml;st&auml;</span></button>
        </div>
    </div>
    <link rel="stylesheet" href="tyyli2.css">
</div>

<div class="footer">
    <h2>Yhteystiedot </h2>
    <h5>Puhelin: +358 000 000 00</h5>
    <h5>Sähköposti: parhaatpyorat@on.com</h5>
    <h5>Lähin myymälä: Ei ole.</h5>
</div>
<link rel="stylesheet" href="tyyli.css">
</body>
<script>

    var modal = document.getElementById('id01');


    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>

