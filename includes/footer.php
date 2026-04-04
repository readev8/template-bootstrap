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
        
        // Tutup semua submenu dan hapus locked state saat sidebar ditutup
        $('.submenu.locked').removeClass('locked');
        hideAllSubmenus();
        
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
        if (e.key === 'Escape') {
            // Tutup submenu terlebih dahulu jika ada yang terbuka
            if ($('.submenu.show').length > 0) {
                hideAllSubmenus();
            } else if (sidebarState !== 'closed') {
                closeSidebar(true);
            }
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
    // SUBMENU FUNCTIONALITY - FIXED POSITION FLYOUT
    // =====================================================
    
    let activeSubmenu = null;
    let submenuTimeout = null;
    
    /**
     * Menghitung dan mengatur posisi submenu
     * @param {jQuery} $menuItem - Menu item yang memiliki submenu
     * @param {jQuery} $submenu - Element submenu
     */
    function positionSubmenu($menuItem, $submenu) {
        var offset = $menuItem.offset();
        var menuHeight = $menuItem.outerHeight();
        var sidebarWidth = $('#floatingSidebar').outerWidth();
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var submenuHeight = $submenu.outerHeight();
        
        // Posisi default: di samping kanan sidebar
        var top = offset.top;
        var left = offset.left + sidebarWidth + 8; // 8px gap
        
        // Cek jika submenu keluar dari viewport kanan
        var submenuWidth = $submenu.outerWidth();
        if (left + submenuWidth > windowWidth) {
            // Tampilkan di sisi kiri sidebar
            left = offset.left - submenuWidth - 8;
            $submenu.addClass('submenu-left');
        } else {
            $submenu.removeClass('submenu-left');
        }
        
        // Cek jika submenu keluar dari viewport bawah
        if (top + submenuHeight > windowHeight) {
            top = windowHeight - submenuHeight - 16;
        }
        
        // Cek jika submenu keluar dari viewport atas
        if (top < 0) {
            top = 8;
        }
        
        $submenu.css({
            top: top,
            left: left
        });
    }
    
    /**
     * Menampilkan submenu
     * @param {jQuery} $menuItem - Menu item yang diklik/dihover
     */
    function showSubmenu($menuItem) {
        // Tutup submenu aktif sebelumnya
        hideAllSubmenus();
        
        var $group = $menuItem.closest('.menu-item-group');
        var $submenu = $group.find('.submenu');
        
        if ($submenu.length === 0) return;
        
        // Tandai group sebagai open
        $group.addClass('open');
        $menuItem.attr('aria-expanded', 'true');
        
        // Hitung dan set posisi
        positionSubmenu($menuItem, $submenu);
        
        // Tampilkan dengan animasi
        $submenu.addClass('show');
        activeSubmenu = $submenu;
        
        // Clear timeout jika ada
        if (submenuTimeout) {
            clearTimeout(submenuTimeout);
            submenuTimeout = null;
        }
    }
    
    /**
     * Menyembunyikan submenu tertentu
     * @param {jQuery} $submenu - Submenu yang akan disembunyikan
     */
    function hideSubmenu($submenu) {
        if (!$submenu || $submenu.length === 0) return;
        
        var $group = $submenu.closest('.menu-item-group');
        var $menuItem = $group.find('.menu-item.has-submenu');
        
        $submenu.removeClass('show');
        $group.removeClass('open');
        $menuItem.attr('aria-expanded', 'false');
        
        if (activeSubmenu && activeSubmenu.is($submenu)) {
            activeSubmenu = null;
        }
    }
    
    /**
     * Menyembunyikan semua submenu
     */
    function hideAllSubmenus() {
        // Hapus locked state dari semua submenu
        $('.submenu.locked').removeClass('locked');
        $('.submenu.show').each(function() {
            hideSubmenu($(this));
        });
    }
    
    // Desktop: Hover behavior
    if (!isTouchDevice) {
        $('.menu-item-group').on('mouseenter', function(e) {
            var $group = $(this);
            var $menuItem = $group.find('.menu-item.has-submenu');
            
            if ($menuItem.length > 0) {
                // Delay sedikit untuk UX yang lebih baik
                submenuTimeout = setTimeout(function() {
                    showSubmenu($menuItem);
                }, 100);
            }
        });
        
        $('.menu-item-group').on('mouseleave', function(e) {
            var $group = $(this);
            var $submenu = $group.find('.submenu');
            
            // Clear timeout hover
            if (submenuTimeout) {
                clearTimeout(submenuTimeout);
                submenuTimeout = null;
            }
            
            // Delay sebelum hide untuk memberi waktu user pindah ke submenu
            submenuTimeout = setTimeout(function() {
                if (!$submenu.is(':hover') && !$submenu.hasClass('locked')) {
                    hideSubmenu($submenu);
                }
            }, 200);
        });
        
        // Handle mouse enter/leave pada submenu itu sendiri (hanya untuk yang tidak locked)
        $(document).on('mouseenter', '.submenu:not(.locked)', function() {
            if (submenuTimeout) {
                clearTimeout(submenuTimeout);
                submenuTimeout = null;
            }
        });
        
        $(document).on('mouseleave', '.submenu:not(.locked)', function() {
            var $submenu = $(this);
            submenuTimeout = setTimeout(function() {
                hideSubmenu($submenu);
            }, 200);
        });
    }
    
    // Click handler untuk SEMUA device (desktop + mobile)
    $('.menu-item.has-submenu').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var $menuItem = $(this);
        var $group = $menuItem.closest('.menu-item-group');
        var $submenu = $group.find('.submenu');
        
        // Toggle locked state
        if ($submenu.hasClass('locked')) {
            // Unlock dan tutup
            $submenu.removeClass('locked');
            hideSubmenu($submenu);
        } else {
            // Unlock semua submenu lain
            $('.submenu.locked').removeClass('locked');
            
            // Lock dan buka submenu ini
            $submenu.addClass('locked');
            showSubmenu($menuItem);
        }
    });
    
    // Tutup submenu saat klik di luar
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.menu-item-group').length && 
            !$(e.target).closest('.submenu').length) {
            // Hapus locked state dan tutup semua
            $('.submenu.locked').removeClass('locked');
            hideAllSubmenus();
        }
    });
    
    // Update posisi submenu saat scroll/resize
    $(window).on('scroll resize', function() {
        if (activeSubmenu && activeSubmenu.hasClass('show')) {
            var $group = activeSubmenu.closest('.menu-item-group');
            var $menuItem = $group.find('.menu-item.has-submenu');
            positionSubmenu($menuItem, activeSubmenu);
        }
    });

    // =====================================================
    // MENU ITEM CLICK HANDLER (NON-SUBMENU)
    // =====================================================
    
    $('.menu-item:not(.has-submenu)').on('click', function(e) {
        var $this = $(this);
        
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
        switchRole: switchRole,
        showSubmenu: showSubmenu,
        hideSubmenu: hideSubmenu,
        hideAllSubmenus: hideAllSubmenus,
        positionSubmenu: positionSubmenu
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
