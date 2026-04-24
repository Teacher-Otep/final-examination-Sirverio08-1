// Show and hide sections based on button clicks
function showSection(sectionID) {
    const sections = document.querySelectorAll('.content, .homecontent');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    const targetSection = document.getElementById(sectionID);
    if (targetSection) {
        targetSection.style.display = 'flex'; // or 'block' if preferred
    }
}

// Add event listener to logo to hide all sections when clicked
document.addEventListener('DOMContentLoaded', () => {
    const logo = document.getElementById('logo');
    if (logo) {
        logo.style.cursor = 'pointer';
        logo.addEventListener('click', () => {
            // Select all sections to hide
            const sectionsToHide = document.querySelectorAll('.content');
            sectionsToHide.forEach(section => {
                section.style.display = 'none';
            });
            // Keep .contenttitle and .homecontent visible
            const title = document.querySelector('.contenttitle');
            if (title) {
                title.style.display = 'block';
            }
            const homeContent = document.querySelector('.homecontent');
            if (homeContent) {
                homeContent.style.display = 'block';
            }
        });
    }

    // Existing code for toast notification
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        toast.classList.remove('toast-hidden');

        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.classList.add('toast-hidden'), 500);
        }, 3000);

        window.history.replaceState({}, document.title, window.location.pathname);
    }
});