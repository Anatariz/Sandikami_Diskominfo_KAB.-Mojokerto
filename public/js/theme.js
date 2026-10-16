/**
 * Sandikami Theme Switcher (Light & Dark Mode)
 * Diskominfo Kab. Mojokerto
 */
(function () {
  'use strict';

  function getSystemTheme() {
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  function getSavedTheme() {
    return localStorage.getItem('sandikami_theme') || getSystemTheme();
  }

  function applyTheme(theme) {
    if (theme === 'dark') {
      document.documentElement.setAttribute('data-theme', 'dark');
      localStorage.setItem('sandikami_theme', 'dark');
    } else {
      document.documentElement.setAttribute('data-theme', 'light');
      localStorage.setItem('sandikami_theme', 'light');
    }
    updateToggleButtons(theme);
  }

  function updateToggleButtons(theme) {
    const isDark = theme === 'dark';
    const toggles = document.querySelectorAll('.theme-toggle-btn');
    toggles.forEach(function (btn) {
      btn.setAttribute('aria-pressed', isDark ? 'true' : 'false');
      btn.setAttribute('title', isDark ? 'Ganti ke Mode Terang' : 'Ganti ke Mode Gelap');
    });
  }

  function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
    applyTheme(nextTheme);
  }

  // Initialize theme on DOM ready
  document.addEventListener('DOMContentLoaded', function () {
    const initialTheme = getSavedTheme();
    applyTheme(initialTheme);

    // Event delegation for all toggle buttons
    document.addEventListener('click', function (e) {
      const toggleBtn = e.target.closest('.theme-toggle-btn');
      if (toggleBtn) {
        e.preventDefault();
        toggleTheme();
      }
    });

    // Listen for OS theme changes if user has not set explicit preference
    if (window.matchMedia) {
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
        if (!localStorage.getItem('sandikami_theme')) {
          applyTheme(e.matches ? 'dark' : 'light');
        }
      });
    }

    // Profile avatar menu: click to open, auto-close so it never gets stuck
    var PROFILE_SEL = '.profile-dropdown, .admin-dropdown';

    function closeProfileMenus(except) {
      document.querySelectorAll('.profile-dropdown.open, .admin-dropdown.open').forEach(function (dd) {
        if (dd !== except) dd.classList.remove('open');
      });
    }

    document.addEventListener('click', function (e) {
      var toggle = e.target.closest('.profile-dropdown > .dropdown-toggle, .admin-dropdown > .admin-dropdown-toggle');
      if (toggle) {
        e.preventDefault();
        var dd = toggle.parentElement;
        closeProfileMenus(dd);
        dd.classList.toggle('open');
        toggle.blur();
        return;
      }
      // Click outside, or on a menu item -> close
      var inside = e.target.closest(PROFILE_SEL);
      if (!inside || e.target.closest('a, button')) closeProfileMenus();
    });

    // Close shortly after the cursor leaves the avatar/menu area
    document.querySelectorAll(PROFILE_SEL).forEach(function (dd) {
      var timer;
      dd.addEventListener('mouseleave', function () {
        timer = setTimeout(function () { dd.classList.remove('open'); }, 300);
      });
      dd.addEventListener('mouseenter', function () { clearTimeout(timer); });
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeProfileMenus();
    });

    // Back/forward cache: make sure menu is closed when page is shown again
    window.addEventListener('pageshow', function () { closeProfileMenus(); });
  });

  // Global helper
  window.toggleSandikamiTheme = toggleTheme;
})();
