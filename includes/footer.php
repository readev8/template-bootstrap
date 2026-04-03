<?php
/**
 * Footer Partial
 * Contains JS includes, shared inline JS, page-specific JS, and closing tags
 * 
 * Optional Variables:
 * $pageJs (string) - Page-specific inline JavaScript (heredoc)
 */

// Ensure pageJs is defined
if (!isset($pageJs)) {
    $pageJs = '';
}
?>
<!-- JavaScript Libraries -->
<?php include __DIR__ . '/js.php'; ?>

<!-- Shared JavaScript -->
<script>
/**
 * =====================================================
 * SHARED APPLICATION JAVASCRIPT
 * =====================================================
 * Handles sidebar toggle, role switching, dropdowns, 
 * and menu interactions (shared across all pages)
 */

(function($) {
    'use strict';

    // =====================================================
    // GLOBAL STATE
    // =====================================================
    let currentRole = localStorage.getItem('userRole') || 'employee';
    let sidebarState = 'closed';
    let previewTimeout = null;

    // =====================================================
    // SIDEBAR FUNCTIONALITY
    // =====================================================
    
    /**
     * Opens the floating sidebar
     * @param {boolean} locked - If true, sidebar is locked (persistent)
     */
    function openSidebar(locked) {
        locked = locked || false;
        var $sidebar = $('#floatingSidebar');
        var $toggle = $('#floatingToggle');
        var $overlay = $('#sidebarOverlay');
        
        if (previewTimeout) {
            clearTimeout(previewTimeout);
            previewTimeout = null;
        }
        
        sidebarState = locked ? 'locked' : 'preview';
        $sidebar.addClass('visible');
        
        if (locked) {
            $overlay.addClass('active');
            $toggle.addClass('active');
        }
    }

    /**
     * Closes the floating sidebar
     * @param {boolean} force - If true, closes regardless of state
     */
    function closeSidebar(force) {
        force = force || false;
        var $sidebar = $('#floatingSidebar');
        var $toggle = $('#floatingToggle');
        var $overlay = $('#sidebarOverlay');
        
        if (previewTimeout) {
            clearTimeout(previewTimeout);
            previewTimeout = null;
        }
        
        if (sidebarState === 'locked' && !force) {
            return;
        }
        
        sidebarState = 'closed';
        $sidebar.removeClass('visible');
        $overlay.removeClass('active');
        $toggle.removeClass('active');
    }

    /**
     * Toggles sidebar locked state
     */
    function toggleSidebarLock() {
        if (sidebarState === 'locked') {
            closeSidebar(true);
        } else {
            openSidebar(true);
        }
    }

    // =====================================================
    // SIDEBAR EVENT HANDLERS
    // =====================================================
    
    var toggleHoverTimeout = null;
    var isTouchDevice = window.matchMedia('(hover: none), (pointer: coarse)').matches;
    
    if (!isTouchDevice) {
        $('#floatingToggle').on('mouseenter', function() {
            if (toggleHoverTimeout) {
                clearTimeout(toggleHoverTimeout);
                toggleHoverTimeout = null;
            }
            if (sidebarState === 'closed') {
                openSidebar(false);
            }
        });

        $('#floatingToggle').on('mouseleave', function() {
            if (sidebarState === 'preview') {
                toggleHoverTimeout = setTimeout(function() {
                    closeSidebar();
                }, 300);
            }
        });

        $('#floatingSidebar').on('mouseenter', function() {
            if (previewTimeout) {
                clearTimeout(previewTimeout);
                previewTimeout = null;
            }
        });

        $('#floatingSidebar').on('mouseleave', function() {
            if (sidebarState === 'preview') {
                previewTimeout = setTimeout(function() {
                    closeSidebar();
                }, 300);
            }
        });
    }

    $('#floatingToggle').on('click', function(e) {
        e.stopPropagation();
        toggleSidebarLock();
    });

    $('#sidebarOverlay').on('click', function() {
        closeSidebar(true);
    });

    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && sidebarState !== 'closed') {
            closeSidebar(true);
        }
    });

    // =====================================================
    // ROLE SWITCHING
    // =====================================================
    
    /**
     * Updates the UI based on the selected role
     * @param {string} role - The role to switch to
     */
    function switchRole(role) {
        currentRole = role;
        localStorage.setItem('userRole', role);
        
        var roleLabels = {
            'employee': 'Employee',
            'manager': 'Manager',
            'admin': 'Administrator'
        };
        
        $('#roleLabel').text(roleLabels[role] || 'Employee');
        $('.role-btn').removeClass('active');
        $('.role-btn[data-role="' + role + '"]').addClass('active');
        $('body')
            .removeClass('role-employee role-manager role-admin')
            .addClass('role-' + role);
    }

    $('.role-btn').on('click', function() {
        var role = $(this).data('role');
        switchRole(role);
    });

    // =====================================================
    // USER DROPDOWN
    // =====================================================
    
    $('#userDropdownToggle').on('click', function(e) {
        e.stopPropagation();
        var $dropdown = $('#userDropdownMenu');
        
        if ($dropdown.hasClass('show')) {
            $dropdown.stop(true, true).slideUp(300, function() {
                $(this).removeClass('show');
                $('#userDropdownWrapper').removeClass('open');
            });
        } else {
            $('#notificationDropdown').stop(true, true).slideUp(300);
            $dropdown.stop(true, true).hide().removeClass('show')
                .slideDown(300, function() {
                    $(this).addClass('show');
                    $('#userDropdownWrapper').addClass('open');
                });
        }
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#userDropdownWrapper').length) {
            $('#userDropdownMenu').stop(true, true).slideUp(300, function() {
                $(this).removeClass('show');
                $('#userDropdownWrapper').removeClass('open');
            });
        }
    });

    // =====================================================
    // MENU ITEM CLICK HANDLER
    // =====================================================
    
    $('.menu-item').on('click', function(e) {
        var $this = $(this);
        
        if ($this.hasClass('has-submenu')) {
            e.preventDefault();
            var $group = $this.closest('.menu-item-group');
            var isOpen = $group.hasClass('open');
            $('.menu-item-group').removeClass('open').find('.menu-item.has-submenu').attr('aria-expanded', 'false');
            if (!isOpen) {
                $group.addClass('open');
                $this.attr('aria-expanded', 'true');
            }
            return;
        }
        
        var href = $this.attr('href');
        if (!href || href === '#') {
            e.preventDefault();
        }
        
        $('.menu-item').removeClass('active');
        $this.addClass('active');
    });

    // =====================================================
    // INITIALIZATION
    // =====================================================
    
    $(document).ready(function() {
        // Initialize role from localStorage
        var savedRole = localStorage.getItem('userRole');
        if (savedRole) {
            switchRole(savedRole);
        }
    });

    // Expose functions globally for page-specific JS
    window.SISPEG = {
        openSidebar: openSidebar,
        closeSidebar: closeSidebar,
        toggleSidebarLock: toggleSidebarLock,
        switchRole: switchRole
    };

})(jQuery);
</script>

<!-- Page-Specific JavaScript -->
<?php if (!empty($pageJs)): ?>
<script>
<?php echo $pageJs; ?>
</script>
<?php endif; ?>

</body>
</html>