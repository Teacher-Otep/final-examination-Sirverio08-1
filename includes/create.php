<?php
require 'db.php'; // Include your PDO connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collecting data from the form
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    try {
        // Using prepared statements to prevent SQL injection
        $sql = "INSERT INTO students (surname, name, middlename, address, contact_number) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surname, $name, $middlename, $address, $contact]);

        // Redirect back to index with a success message
        header("Location: ../index.php?status=success");
        exit();
    } catch (PDOException $e) {
        die("Error inserting record: " . $e->getMessage());
    }
}
?>