<?php
include '../includes/db.php'; // Make sure this path is correct

// Fetch student records
$sql = "SELECT id, surname, name, middlename, address, contact FROM students"; // Adjust table name and column names as needed
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">';
    echo '<tr style="background-color:#333; color:#fff;">';
    echo '<th>ID</th>';
    echo '<th>Surname</th>';
    echo '<th>Name</th>';
    echo '<th>Middlename</th>';
    echo '<th>Address</th>';
    echo '<th>Contact Number</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['surname']) . '</td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['middlename']) . '</td>';
        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
        echo '<td>' . htmlspecialchars($row['contact']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No student records found.</p>';
}
?>