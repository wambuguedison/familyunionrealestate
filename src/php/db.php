<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "family_union";

$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>