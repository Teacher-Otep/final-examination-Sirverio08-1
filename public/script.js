// Function to show a specific section and hide others
function showSection(sectionID) {
    const sections = document.querySelectorAll('.content');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    const homeSection = document.querySelector('.homecontent');
    if (sectionID === 'home') {
        homeSection.classList.remove('hidden');
    } else {
        const activeSection = document.getElementById(sectionID);
        if (activeSection) {
            activeSection.classList.remove('hidden');
        }
    }
}

// Event listener for the logo to hide all sections
document.addEventListener('DOMContentLoaded', () => {
    const logo = document.getElementById('logo');
    if (logo) {
        logo.addEventListener('click', () => {
            document.querySelector('.homecontent').classList.remove('hidden');
            document.querySelectorAll('.content').forEach(sec => {
                sec.classList.add('hidden');
            });
        });
    }

    // Add event listeners to navigation buttons
    document.querySelectorAll('.navbarbuttons').forEach(btn => {
        btn.addEventListener('click', () => {
            const btnText = btn.textContent.trim().toLowerCase();
            // Determine which section to show based on button text
            switch (btnText) {
                case 'create':
                    showSection('create');
                    break;
                case 'read':
                    showSection('read');
                    break;
                case 'update':
                    showSection('update');
                    break;
                case 'delete':
                    showSection('delete');
                    break;
                default:
                    // If no match, show home
                    showSection('home');
            }
        });
    });

    // Add click handler for "Clear Fields" button
    const clearBtn = document.getElementById('clrbtn');
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            document.querySelectorAll('#create input[type="text"], #create input[type="number"]').forEach(input => {
                input.value = '';
            });
        });
    }

    // Handle success toast
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        toast.classList.remove('toast-hidden');
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.classList.add('toast-hidden'), 500);
        }, 3000);
        // Clean URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});