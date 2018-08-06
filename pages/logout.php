<?php

session_start();
$_SESSION["rolecode"] = "";
$_SESSION["userid"] = "";
header('location:../index.php');
die()
?>