
<?php include "../includes/db.php";?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link   rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
            <img src="../images/image.svg" id="logo"></img>
            <button class="navbarbuttons" onclick="showSection('create')"> Create </button>
            <button class="navbarbuttons" onclick="showSection('read')"> Read </button>
            <button class="navbarbuttons" onclick="showSection('update')"> Update </button>
            <button class="navbarbuttons" onclick="showSection('delete')"> Delete </button>
    </nav>
    <section id="home" class="homecontent"> 
        <h1 class="splash">Welcome to Student Management System</h1>
    </section>
    
    <section id="create" class="content">
        <h1 class="contenttitle"> Insert New Student </h1>

    <form action="../includes/insert.php" method="POST">
        <label for="id" class="label">Student ID</label>
        <input type="text" name="id" id="id" class="field" required><br/>

        <label for="surname" class="label">Surname</label>
        <input type="text" name="surname" id="surname" class="field" required><br/>

        <label for="name" class="label">Name</label>
        <input type="text" name="name" id="name" class="field" required><br/>

        <label for="middlename" class="label">Middle name</label>
        <input type="text" name="middlename" id="middlename" class="field"><br/>

        <label for="address" class="label">Address</label>
        <input type="text" name="address" id="address" class="field"><br/>

        <label for="contact" class="label">Mobile Number</label>
        <input type="text" name="contact" id="contact" class="field"><br/>

        <div id="btncontainer">
            <button type="button" id="clrbtn" class="btns">Clear Fields</button><br/>
            <button type="submit" id="savebtn" class="btns">Save</button>
        </div>

        <div id="success-toast" class="toast-hidden">
            Registration Successful!
        </div>
    </form>   

    </section>

<br/><br/><br/><br/>

    <section id="read" class="content"> View Students </section>
    <section id="update" class="content"> Update Student Records </section>
    <section id="delete" class="content"> Remove Student Records </section>

    <script src="script.js"></script>
</body>
</html>