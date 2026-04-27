<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    // Adding optional fields if you included them in the update form
    $middlename = $_POST['middlename'] ?? '';
    $address = $_POST['address'] ?? '';
    $contact = $_POST['contact'] ?? '';

    try {
        $sql = "UPDATE students 
                SET surname = ?, name = ?, middlename = ?, address = ?, contact_number = ? 
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surname, $name, $middlename, $address, $contact, $id]);

        header("Location: ../index.php?status=success");
        exit();
    } catch (PDOException $e) {
        die("Error updating record: " . $e->getMessage());
    }
}
?>