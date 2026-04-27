// Req 4: UX Section Switching
function showSection(sectionID) {
    // Hide everything first
    const allSections = document.querySelectorAll('.content, .homecontent');
    allSections.forEach(sec => {
        sec.style.display = 'none';
    });

    // Show only the target
    const target = document.getElementById(sectionID);
    if (target) {
        target.style.display = 'flex';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Req 2a: Logo Event
    const logo = document.getElementById('logo');
    logo.style.cursor = 'pointer';
    logo.addEventListener('click', () => {
        const contents = document.querySelectorAll('.content');
        contents.forEach(c => c.style.display = 'none');
        document.getElementById('home').style.display = 'flex';
    });

    // Toast logic
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        toast.classList.remove('toast-hidden');
        toast.classList.add('toast-show');
        setTimeout(() => {
            toast.classList.remove('toast-show');
            setTimeout(() => toast.classList.add('toast-hidden'), 500);
        }, 3000);
    }
});