<?php
include 'db.php';

$result = $conn->query("SELECT * FROM students");
?>
<!-- Your table HTML -->
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Surname</th><th>Name</th><th>Middle Name</th><th>Address</th><th>Contact</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['surname']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['middlename']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['contact_number']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<?php
$conn->close();
?>