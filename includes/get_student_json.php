<?php
// This is the file that script.js calls to find the student
include 'db.php'; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$response = ['success' => false];

if ($id > 0) {
    // We use $conn from your db.php
    $stmt = $conn->prepare("SELECT id, name, surname FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $response = [
            'success' => true, 
            'student' => $row
        ];
    }
    $stmt->close();
}

$conn->close();

// Tell the browser this is JSON data, not HTML
header('Content-Type: application/json');
echo json_encode($response);
?>