<?php
include 'idb.php';

$surname = $_POST['surname'];
$name = $_POST['name'];
$middlename = $_POST['middlename'];
$address = $_POST['address'];
$contact = $_POST['contact'];

try {
    $stmt = $pdo->prepare("INSERT INTO students (surname, name, middlename, address, contact_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$surname, $name, $middlename, $address, $contact]);
    header("Location: ../index.html?status=success");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>