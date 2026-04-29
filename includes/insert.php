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
// (Even if an ID is a number, sending it as a string is completely safe in SQL)
$stmt->bind_param("ssssss", $id, $surname, $name, $middlename, $address, $contact);

// Execute the statement
if ($stmt->execute()) {
    // Redirect back to your main page with a success message
    header("Location: index.php?status=success");
    exit();
} else {
    // Handle errors if needed
    die("Error: " . $stmt->error);
}
$stmt->close();
$conn->close();
?>