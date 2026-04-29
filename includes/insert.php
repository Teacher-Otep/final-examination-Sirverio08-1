<?php
// include database connection
include('../includes/db.php');

// Retrieve form data
$id = $_POST['id'];
$surname = $_POST['surname'];
$name = $_POST['name'];
$middlename = $_POST['middlename'];
$address = $_POST['address'];
$contact = $_POST['contact'];

// Prepare and bind statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO students (id, surname, name, middlename, address, contact_number) VALUES (?, ?, ?, ?, ?, ?)");

// Check if preparation was successful
if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind parameters: "ssssss" means 6 strings.
$stmt->bind_param("ssssss", $id, $surname, $name, $middlename, $address, $contact);
// Execute the statement
if ($stmt->execute()) {
    // If successful, redirect to index.php with a success message
    header("Location: ../../public/index.php?status=success");
    exit();
} else {
    // If execution failed, check if the error is a duplicate entry
    if ($conn->errno === 1062) { // 1062 is MySQL's error code for duplicate entry
        // Redirect to index.php with a duplicate error message
        header("Location: ../../public/index.php?error=duplicate");
        exit();
    } else {
        // For other errors, display the error message
        die("Error: " . $stmt->error);
    }
}

$stmt->close();
$conn->close();
?>