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
    <li><a class="active" href=admin.php style="float: left;font-size: 26px">Paras pyörävuokraamo</a></li>
    <li><a href="adminvuokra.php" style="float:left;text-align: end">vuokraukset</a></li>
    <li><button onclick="location.href='logout.php';" style="width:auto;float:right ">Kirjaudu ulos</button></li>
</ul>
<div id="id01" class="modal">
