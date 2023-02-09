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
    <li><a href="vuokraukset.php" style="float:left;text-align: end">Omat vuokraukset</a></li>
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
<h2>Vuokrattavat py&ouml;r&auml;t</h2>
<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <h2>GT</h2>
            <h5>Sensor Carbon Expert 130/140 GX12</h5>
            <img src="https://www.xxl.fi/filespin/c11390b6d7f040529c3c2fc5484d6ece?resize=1400,1400&quality=95&bgcolor=efefef" alt="GT pyörä" style="width:450px;height:450px;">
            <p>15&#x20AC;/Tunti</p>
            <p>T&aumlysjousitettu unisex-py&ouml;r&auml; polkuajoon, Sininen</p>
            <button onclick="location.href='GT-Info.php';" class="button" style="vertical-align:middle"><span>Lis&auml;tiedot </span></button>
        </div>
        <div class="card">
            <h2>White</h2>
            <h5>XC 290 Pro Deore 11s</h5>
            <img src="https://www.xxl.fi/filespin/6f213ad962894b2e832b393bc4a197ac?resize=1400,1400&quality=95&bgcolor=efefef" alt="White pyörä" style="width:450px;height:450px;">
            <p>7&#x20AC;/Tunti</p>
            <p>Miesten maastopy&ouml;r&auml;, Musta</p>
            <button onclick="location.href='White-Info.php';" class="button" style="vertical-align:middle"><span>Lis&auml;tiedot </span></button>
        </div>
    </div>
    <div class="rightcolumn">
        <div class="card">
            <h2>Scott</h2>
            <h5>Spark 970 Elite</h5>
            <img src="https://www.xxl.fi/filespin/a61b00192edb483097b7f0bb3e68a8f5?resize=1400,1400&quality=95&bgcolor=efefef" alt="Scott pyörä" style="width:450px;height:450px;">
            <p>20&#x20AC;/Tunti</p>
            <p>T&aumlysjousitettu unisex maastopy&ouml;r&auml;, Sininen</p>
            <button onclick="location.href='Scott-Info.php';"class="button" style="vertical-align:middle"><span>Lis&auml;tiedot </span></button>
        </div>
        <div class="card">
            <h2>Cube</h2>
            <h5>Reaction C:62 ONE NX12</h5>
            <img src="https://www.xxl.fi/filespin/bf231fe22b3b411b89ee52e971abb21f?resize=1400,1400&quality=95&bgcolor=efefef" alt="Cube pyörä" style="width:450px;height:450px;">
            <p>10&#x20AC;/Tunti</p>
            <p>Maastopy&ouml;r&auml; unisex , Punainen</p>
            <button onclick="location.href='Cube-Info.php';" class="button" style="vertical-align:middle"><span>Lis&auml;tiedot </span></button>
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

