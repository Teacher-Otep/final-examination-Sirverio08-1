
// Function to show one section and hide others
function showSection(sectionID) {
    console.log('Showing section:', sectionID);
    const sections = document.querySelectorAll('.content, .homecontent');
    sections.forEach(section => {
        if (section.id === sectionID) {
            section.style.display='block';
        } else {
            section.style.display='none';
        }
    });
}
document.addEventListener("DOMContentLoaded", function() {
    // 1. Check the URL for '?status=success'
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById("success-toast");
        
        // 2. Show the toast
        toast.classList.remove("toast-hidden");
        toast.classList.add("toast-visible");

        // 3. Clean up the URL so the toast doesn't show again on a page refresh
        window.history.replaceState({}, document.title, window.location.pathname);

        // 4. Hide the toast after 3 seconds (3000 milliseconds)
        setTimeout(() => {
            toast.classList.remove("toast-visible");
            toast.classList.add("toast-hidden");
        }, 3000);
    }
});

document.getElementById('clrbtn').addEventListener('click', function() {
    document.getElementById('id').value = '';
    document.getElementById('surname').value = '';
    document.getElementById('name').value = '';
    document.getElementById('middlename').value = '';
    document.getElementById('address').value = '';
    document.getElementById('contact').value = '';
});
