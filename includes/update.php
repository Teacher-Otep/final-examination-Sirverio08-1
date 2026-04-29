<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $sql = "UPDATE students SET surname=?, name=?, middlename=?, address=?, contact_number=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $surname, $name, $middlename, $address, $contact, $id);
    if ($stmt->execute()) {
        header("Location: ../index.php?status=success");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>