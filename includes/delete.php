<?php
include 'db.php'; // Ensure db.php is in the same folder

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the ID from the hidden input field in your HTML form
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Use prepared statements for security
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Success! Redirect back to index.php with the 'deleted' status
            header("Location: ../public/index.php?status=deleted");
            exit(); 
        } else {
            echo "Database Error: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Invalid ID provided.";
    }
}
$conn->close();
?>