// Navbar Toggle & Mobile Navigation
document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      navLinks.classList.toggle('show');
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
      if (navLinks.classList.contains('show') && !navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
        navLinks.classList.remove('show');
      }
    });

    // Mobile Dropdown Accordion
    const mobileDropdownToggles = navLinks.querySelectorAll('.dropdown > .dropdown-toggle');
    mobileDropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          e.stopPropagation();
          const parentDropdown = toggle.closest('.dropdown');
          if (parentDropdown) {
            // Close other open mobile dropdowns
            navLinks.querySelectorAll('.dropdown.open').forEach(d => {
              if (d !== parentDropdown) d.classList.remove('open');
            });
            parentDropdown.classList.toggle('open');
          }
        }
      });
    });

    // Close drawer when regular link is clicked
    const directLinks = navLinks.querySelectorAll('a:not(.dropdown-toggle)');
    directLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
          navLinks.classList.remove('show');
        }
      });
    });
  }

  // Active link highlighting
  const currentLocation = location.pathname;
  const menuItems = document.querySelectorAll('.nav-links a');
  
  menuItems.forEach(item => {
    if (item.getAttribute('href') !== '/' && currentLocation.includes(item.getAttribute('href'))) {
      item.classList.add('active');
    }
  });
});

// Utility to handle file upload display
document.addEventListener('DOMContentLoaded', () => {
  const fileInputs = document.querySelectorAll('.file-upload-wrapper input[type="file"]');
  
  fileInputs.forEach(input => {
    input.addEventListener('change', function(e) {
      const fileName = e.target.files[0] ? e.target.files[0].name : 'Upload Surat Permohonan';
      const display = this.parentElement.querySelector('span');
      if (display) {
        display.textContent = fileName;
        display.style.color = 'var(--color-secondary)';
      }
    });
  });
});

// Helper for generic alerts
function showNotification(message, type = 'success') {
  alert(message); // Placeholder for better UI notification
}
