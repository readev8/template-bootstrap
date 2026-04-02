// Custom JavaScript for Bootstrap Template

/**
 * Initialize all Bootstrap components on DOM ready
 */
document.addEventListener('DOMContentLoaded', function() {
  
  // Initialize all tooltips
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  
  // Initialize all popovers
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
  
  // Initialize all toasts
  const toastEl = document.querySelector('.toast');
  if (toastEl) {
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  }
  
  console.log('Bootstrap Template initialized successfully');
});

/**
 * Example: Custom form validation
 */
(function() {
  'use strict';
  
  const forms = document.querySelectorAll('.needs-validation');
  
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();

/**
 * Example: Custom AJAX helper
 */
const ajaxHelper = {
  async get(url) {
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return await response.json();
    } catch (error) {
      console.error('Fetch error:', error);
      throw error;
    }
  },
  
  async post(url, data) {
    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      });
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return await response.json();
    } catch (error) {
      console.error('Fetch error:', error);
      throw error;
    }
  }
};

/**
 * Example: Sidebar toggle for mobile
 */
function toggleSidebar() {
  const sidebar = document.getElementById('sidebarMenu');
  if (sidebar) {
    const offcanvas = bootstrap.Offcanvas.getInstance(sidebar);
    if (offcanvas) {
      offcanvas.toggle();
    }
  }
}

/**
 * Example: Notification helper
 */
function showNotification(message, type = 'info') {
  const notification = document.createElement('div');
  notification.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
  notification.style.zIndex = '9999';
  notification.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.remove();
  }, 5000);
}

/**
 * Export functions for global use
 */
window.ajaxHelper = ajaxHelper;
window.toggleSidebar = toggleSidebar;
window.showNotification = showNotification;
