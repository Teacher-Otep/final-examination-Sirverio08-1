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