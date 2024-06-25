<?php
$host = "localhost";
$username = "root";
$password = "1234";
$database = "freaky";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>