// Navbar Toggle
document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('show');
    });
  }

  // Active link highlighting
  const currentLocation = location.pathname;
  const menuItems = document.querySelectorAll('.nav-links a');
  
  menuItems.forEach(item => {
    // Basic match, could be improved based on exact paths
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
