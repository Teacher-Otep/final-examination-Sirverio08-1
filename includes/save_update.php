<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $stmt = $pdo->prepare("UPDATE students SET name=?, surname=?, middlename=?, address=?, contact=? WHERE id=?");
    $stmt->execute([$name, $surname, $middlename, $address, $contact, $id]);

    echo "Record updated successfully.";
}
?>