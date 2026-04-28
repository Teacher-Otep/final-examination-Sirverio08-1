<?php
// 1. Connect to the database
// Note: using './db.php' because insert.php is in the same folder as db.php
require_once './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_student'])) {
    
    // 2. Capture and sanitize form data
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $middlename = $_POST['middlename'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    try {
        // 3. Prepare the SQL Statement
        $sql = "INSERT INTO students (surname, name, middlename, address, contact_number) 
                VALUES (:surname, :name, :middlename, :address, :contact)";
        
        $stmt = $pdo->prepare($sql);

        // 4. Execute the query
        $stmt->execute([
            ':surname'    => $surname,
            ':name'       => $name,
            ':middlename' => $middlename,
            ':address'    => $address,
            ':contact'    => $contact
        ]);

        // 5. Redirect back to index.php with a success status
        header("Location: ../index.php?status=success");
        exit();

    } catch (PDOException $e) {
        // Handle errors (e.g., database connection issues)
        die("Error: Could not insert record. " . $e->getMessage());
    }
} else {
    // If someone tries to access this file directly, send them home
    header("Location: ../index.php");
    exit();
}