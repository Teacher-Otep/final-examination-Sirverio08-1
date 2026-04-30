// Show section function
function showSection(sectionID) {
    const sections = document.querySelectorAll('.content, .homecontent');
    sections.forEach(section => {
        if (section.id === sectionID) {
            section.style.display='block';
        } else {
            section.style.display='none';
        }
    });
    
    // Show navbar only when not on home
    document.getElementById('navbar').style.display = (sectionID === 'home') ? 'flex' : 'flex';

    // Fetch data dynamically when 'read' is clicked
    if (sectionID === 'read') {
        const tableContainer = document.getElementById('student-table-container');
        tableContainer.innerHTML = '<p style="color:#00ffff; text-align:center; font-family: \'Orbitron\', sans-serif;">Loading records...</p>';
        
        fetch('../includes/get_student.php')
            .then(response => response.text())
            .then(data => {
                tableContainer.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching student records:', error);
                tableContainer.innerHTML = '<p style="color:red; text-align:center; font-family: \'Orbitron\', sans-serif;">Failed to load records.</p>';
            });
    }
}

// On page load
window.onload = function() {
    showSection('home'); // default show home

    // Handle URL param for success toast
    handleToast();

    // Add click event to logo
    document.getElementById('logo').addEventListener('click', () => {
        showSection('home');
    });

    // Add click event to Home button inside toast
    const homeBtn = document.getElementById('homeBtn');
    if (homeBtn) {
        homeBtn.addEventListener('click', () => {
            showSection('home');
        });
        // Optional: add hover effect if desired
        homeBtn.addEventListener('mouseenter', () => {
            homeBtn.style.transform = 'scale(1.05)';
        });
        homeBtn.addEventListener('mouseleave', () => {
            homeBtn.style.transform = 'scale(1)';
        });
    }
};

// Function to handle toast display based on URL param
function handleToast() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        toast.classList.remove('toast-hidden');
        toast.classList.add('toast-visible');

        // Hide URL param after showing toast
        window.history.replaceState({}, document.title, window.location.pathname);

        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('toast-visible');
            toast.classList.add('toast-hidden');
        }, 3000);

        // Hide navbar and create section
        document.getElementById('navbar').style.display = 'none';
        document.querySelector('#create').style.display = 'none';
    }
}

// Clear button for form
document.getElementById('clrbtn').addEventListener('click', function() {
    document.getElementById('id').value = '';
    document.getElementById('surname').value = '';
    document.getElementById('name').value = '';
    document.getElementById('middlename').value = '';
    document.getElementById('address').value = '';
    document.getElementById('contact').value = '';
});


function fetchStudentForUpdate() {
    const id = document.getElementById('update-search-id').value;
    if (!id) {
        alert("Please enter a Student ID");
        return;
    }

    // We fetch all students and find the one matching the ID
    fetch('../includes/get_student_json.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('update_id').value = data.student.id;
                document.getElementById('update_surname').value = data.student.surname;
                document.getElementById('update_name').value = data.student.name;
                document.getElementById('update_middlename').value = data.student.middlename;
                document.getElementById('update_address').value = data.student.address;
                document.getElementById('update_contact').value = data.student.contact_number;
            } else {
                alert("Student not found!");
            }
        })
        .catch(error => console.error('Error:', error));
}
function fetchStudentForDelete() {
    const idInput = document.getElementById('delete-search-id');
    const id = idInput.value;
    
    if (!id) {
        alert("Please enter a Student ID");
        return;
    }

    // Try to fetch the student from the includes folder
    fetch('../includes/get_student_json.php?id=' + id)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // If found, show the confirmation form
                document.getElementById('delete-form').style.display = 'block';
                document.getElementById('delete_id_hidden').value = data.student.id;
                document.getElementById('delete-display-name').innerText = data.student.name + " " + data.student.surname;
            } else {
                alert("ID " + id + " does not exist in the database.");
                document.getElementById('delete-form').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Could not connect to the database search script.");
        });
}

// Modify the handleToast function to support a delete message
function handleToast() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const toast = document.getElementById('success-toast');

    if (status === 'success' || status === 'deleted') {
        if (status === 'deleted') {
            // Temporarily change toast text for deletion
            toast.childNodes[0].textContent = "Student Deleted Successfully!";
        }

        toast.classList.remove('toast-hidden');
        toast.classList.add('toast-visible');

        window.history.replaceState({}, document.title, window.location.pathname);

        setTimeout(() => {
            toast.classList.remove('toast-visible');
            toast.classList.add('toast-hidden');
        }, 3000);

        document.getElementById('navbar').style.display = 'none';
        document.querySelector('#create').style.display = 'none';
    }
}