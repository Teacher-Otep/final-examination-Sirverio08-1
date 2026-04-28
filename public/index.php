<?php include('../includes/db.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>  
    <nav class="navbar">
        <img src="../images/image.svg" id="logo" alt="Logo" />
        <button class="navbarbuttons" onclick="showSection('create')">Create</button>
        <button class="navbarbuttons" onclick="showSection('read')">Read</button>
        <button class="navbarbuttons" onclick="showSection('update')">Update</button>
        <button class="navbarbuttons" onclick="showSection('delete')">Delete</button>
    </nav>

    <section id="home" class="homecontent">
        <h1 class="splash">Welcome to Student Management System</h1>
        <h2 class="splash">A Project in Integrative Programming Technologies</h2>
    </section>

    <section id="create" class="content">
        <h1 class="contenttitle">Insert New Student</h1>
        <form action="includes/insert.php" method="POST" class="main-form">
            <label class="label">Surname</label>
            <input type="text" name="surname" class="field" required />
            
            <label class="label">Name</label>
            <input type="text" name="name" class="field" required />
            
            <label class="label">Middle name</label>
            <input type="text" name="middlename" class="field" />
            
            <label class="label">Address</label>
            <input type="text" name="address" class="field" />
            
            <label class="label">Mobile Number</label>
            <input type="text" name="contact" class="field" />

            <div id="btncontainer">
                <button type="reset" id="clrbtn" class="btns">Clear Fields</button>
                <button type="submit" id="savebtn" class="btns">Save</button>
            </div>
        </form>
    </section>

    <section id="read" class="content">
        <h1 class="contenttitle">View Students</h1>
        <div class="table-container">
            <?php
            $stmt = $pdo->query("SELECT * FROM students");
            $students = $stmt->fetchAll();
            if ($students): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Surname</th><th>Name</th><th>Middle Name</th><th>Address</th><th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $s): ?>
                    <tr>
                        <td><?= $s['id'] ?></td>
                        <td><?= htmlspecialchars($s['surname']) ?></td>
                        <td><?= htmlspecialchars($s['name']) ?></td>
                        <td><?= htmlspecialchars($s['middlename']) ?></td>
                        <td><?= htmlspecialchars($s['address']) ?></td>
                        <td><?= htmlspecialchars($s['contact_number']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No records found.</p>
            <?php endif; ?>
        </div>
    </section>

    <section id="update" class="content">
        <h1 class="contenttitle">Update Student Record</h1>
        <form method="POST" class="main-form">
            <label class="label">Enter Student ID:</label>
            <input type="number" name="search_id" class="field" required />
            <button type="submit" name="load" class="btns">Load Student</button>
        </form>

        <?php
        if (isset($_POST['load'])) {
            $id = $_POST['search_id'];
            $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
            $stmt->execute([$id]);
            $student = $stmt->fetch();

            if ($student): ?>
                <form action="includes/update_logic.php" method="POST" class="main-form" style="margin-top: 20px; border-top: 2px solid #66b0f1;">
                    <input type="hidden" name="id" value="<?= $student['id'] ?>">
                    <label class="label">Name</label>
                    <input type="text" name="name" value="<?= $student['name'] ?>" class="field" required />
                    <label class="label">Surname</label>
                    <input type="text" name="surname" value="<?= $student['surname'] ?>" class="field" required />
                    <button type="submit" class="btns">Save Changes</button>
                </form>
            <?php else: echo "<p>Student ID not found.</p>"; endif;
        } ?>
    </section>

    <section id="delete" class="content">
        <h1 class="contenttitle">Delete Student</h1>
        <form action="includes/delete_logic.php" method="POST" class="main-form" onsubmit="return confirm('Delete this record permanently?');">
            <label class="label">Enter ID to Delete:</label>
            <input type="number" name="id" class="field" required />
            <button type="submit" class="btns" style="background-color: #d9534f;">Confirm Delete</button>
        </form>
    </section>

    <div id="success-toast" class="toast-hidden">Action Successful!</div>
    <script src="script.js"></script>

    <section id="create" class="content" style="display:none;">
    <h1 class="contenttitle">Insert New Student</h1>
    
    <form action="includes/insert.php" method="POST" class="main-form">
        <label class="label">Surname</label>
        <input type="text" name="surname" class="field" required />
        
        <label class="label">Name</label>
        <input type="text" name="name" class="field" required />
        
        <label class="label">Middle name</label>
        <input type="text" name="middlename" class="field" />
        
        <label class="label">Address</label>
        <input type="text" name="address" class="field" />
        
        <label class="label">Mobile Number</label>
        <input type="text" name="contact" class="field" />

        <div id="btncontainer">
            <button type="reset" id="clrbtn" class="btns">Clear Fields</button>
            <button type="submit" name="submit_student" id="savebtn" class="btns">Save</button>
        </div>
    </form>
</section>
</body>
</html>
