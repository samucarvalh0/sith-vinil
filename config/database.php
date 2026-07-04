<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "sinth_vinil";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão.");
}
?>