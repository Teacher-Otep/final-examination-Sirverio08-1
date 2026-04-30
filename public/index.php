<?php include "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>CRUD Operations</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<nav class="navbar" id="navbar">
    <img src="../images/image.svg" id="logo" />
    <button class="navbarbuttons" onclick="showSection('create')">Create</button>
    <button class="navbarbuttons" onclick="showSection('read')">Read</button>
    <button class="navbarbuttons" onclick="showSection('update')">Update</button>
    <button class="navbarbuttons" onclick="showSection('delete')">Delete</button>
</nav>

<section id="home" class="homecontent"> 
    <h1 class="splash">Welcome to Student Management System</h1>
</section>

<section id="create" class="content">
    <h1 class="contenttitle">Insert New Student</h1>
    <form action="../includes/insert.php" method="POST">
        <label for="id" class="label">Student ID</label>
        <input type="text" name="id" id="id" class="field" required /><br/>
        <label for="surname" class="label">Surname</label>
        <input type="text" name="surname" id="surname" class="field" required /><br/>
        <label for="name" class="label">Name</label>
        <input type="text" name="name" id="name" class="field" required /><br/>
        <label for="middlename" class="label">Middle name</label>
        <input type="text" name="middlename" id="middlename" class="field" /><br/>
        <label for="address" class="label">Address</label>
        <input type="text" name="address" id="address" class="field" /><br/>
        <label for="contact" class="label">Mobile Number</label>
        <input type="text" name="contact" id="contact" class="field" /><br/>
        <div id="btncontainer">
            <button type="button" id="clrbtn" class="btns">Clear Fields</button><br/>
            <button type="submit" id="savebtn" class="btns">Save</button>
        </div>
    </form>
</section>

<!-- Dynamic Read Section -->
<br/><br/><br/><br/>
<section id="read" class="content">
    <h1 class="contenttitle">View Students</h1>
    <div id="student-table-container"></div>
</section>

<!-- Other sections -->
<section id="update" class="content">
    <h1 class="contenttitle">Update Student Record</h1>
    
    <!-- Search Bar to find the student by ID -->
    <div style="text-align: center; margin-bottom: 20px;">
        <input type="text" id="update-search-id" class="field" placeholder="Enter Student ID to Edit">
        <button type="button" class="btns" style="width: 100px;" onclick="fetchStudentForUpdate()">Search</button>
    </div>

    <form action="../includes/update.php" method="POST" id="update-form">
        <label for="update_id" class="label">Student ID</label>
        <input type="text" name="id" id="update_id" class="field" readonly style="background-color: #333;" /><br/>
        
        <label for="update_surname" class="label">Surname</label>
        <input type="text" name="surname" id="update_surname" class="field" required /><br/>
        
        <label for="update_name" class="label">Name</label>
        <input type="text" name="name" id="update_name" class="field" required /><br/>
        
        <label for="update_middlename" class="label">Middle name</label>
        <input type="text" name="middlename" id="update_middlename" class="field" /><br/>
        
        <label for="update_address" class="label">Address</label>
        <input type="text" name="address" id="update_address" class="field" /><br/>
        
        <label for="update_contact" class="label">Mobile Number</label>
        <input type="text" name="contact" id="update_contact" class="field" /><br/>
        
        <div id="btncontainer">
            <button type="submit" id="updatebtn" class="btns">Update Record</button>
        </div>
    </form>
</section>
<section id="delete" class="content">
    <h1 class="contenttitle">Remove Student Record</h1>
    
    <div style="text-align: center; margin-bottom: 20px;">
        <p style="color: #ff4d4d; margin-bottom: 10px;">Enter ID to search before deleting</p>
        <input type="text" id="delete-search-id" class="field" placeholder="Enter Student ID">
        <button type="button" class="btns" style="width: 100px;" onclick="fetchStudentForDelete()">Search</button>
    </div>

    <form action="../includes/delete.php" method="POST" id="delete-form" style="display: none; text-align: center; border: 1px solid #ff4d4d33; padding: 20px; border-radius: 15px;">
        <p style="font-size: 1.2em;">Are you sure you want to delete:</p>
        <h2 id="delete-display-name" style="color: #ff4d4d;"></h2>
        <input type="hidden" name="id" id="delete_id_hidden">
        
        <div id="btncontainer" style="justify-content: center;">
            <button type="submit" class="btns" style="background-color: #ff4d4d33; border-color: #ff4d4d; color: #ff4d4d;">Confirm Delete</button>
            <button type="button" class="btns" onclick="showSection('home')">Cancel</button>
        </div>
    </form>
</section>

<!-- Success toast and Home button container -->
<div id="success-toast" class="toast-hidden">
    Registration Successful!
    <button id="homeBtn" class="home-btn">Home</button>
</div>

<!-- Scripts -->
<script src="script.js"></script>
</body>
</html>