<?php
// include database connection
include('../includes/db.php');

// Retrieve form data
$surname    = $_POST['surname'];
$name       = $_POST['name'];
$middlename = $_POST['middlename'];
$address    = $_POST['address'];
$contact    = $_POST['contact'];

// REMOVED 'id' from the column list and VALUES because it is AUTO_INCREMENT
$stmt = $conn->prepare("INSERT INTO students (surname, name, middlename, address, contact_number) VALUES (?, ?, ?, ?, ?)");

// Check if preparation was successful
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind parameters: "sssss" means 5 strings. 
// Match the order: surname, name, middlename, address, contact
$stmt->bind_param("sssss", $surname, $name, $middlename, $address, $contact);

// Execute the statement
if ($stmt->execute()) {
    // Redirect back to your public folder
    header("Location: ../public/index.php?status=success");
    exit();
} else {
    // Check if the error is a duplicate entry (e.g., if you have a UNIQUE constraint on contact_number)
    if ($conn->errno === 1062) { 
        header("Location: ../public/index.php?error=duplicate");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }
}

$stmt->close();
$conn->close();
?>