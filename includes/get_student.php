<?php
include '../includes/db.php'; // Make sure this path is correct
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$response = ['success' => false];

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($student = $result->fetch_assoc()) {
        $response = ['success' => true, 'student' => $student];
    }
}

header('Content-Type: application/json');
echo json_encode($response);

// Fetch student records
$sql = "SELECT id, surname, name, middlename, address, contact_number FROM students"; // Adjust table name and column names as needed
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: left;">';
    echo '<tr style="background-color:#00ffff33; color:#00ffff;">';
    echo '<th>ID</th>';
    echo '<th>Surname</th>';
    echo '<th>Name</th>';
    echo '<th>Middlename</th>';
    echo '<th>Address</th>';
    echo '<th>Contact Number</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr style="color: #ffffff; border-bottom: 1px solid #333;">';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['surname']) . '</td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['middlename']) . '</td>';
        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
        echo '<td>' . htmlspecialchars($row['contact_number']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p style="color: #00ffff; text-align: center;">No student records found.</p>';
}
?>