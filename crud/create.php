<?php
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sport = $_POST['sport'];

    $sql = "INSERT INTO pendaftar (name, email, phone, sport) VALUES ('$name', '$email', '$phone', '$sport')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
