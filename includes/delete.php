<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM students WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: ../index.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>