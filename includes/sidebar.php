<?php
/**
 * Sidebar Partial
 * Contains overlay backdrop and floating sidebar
 * 
 * Required Variables:
 * $activeMenu (string) - Active menu identifier (e.g., 'dashboard', 'pegawai')
 * 
 * Optional Variables:
 * $userName (string) - User display name, default 'Ahmad Rizki'
 * $userInitials (string) - User initials for avatar, default 'AR'
 * $userRole (string) - User role label, default from localStorage or 'Employee'
 */
if (!isset($activeMenu)) {
    $activeMenu = 'dashboard';
}
if (!isset($userName)) {
    $userName = 'Ahmad Rizki';
}
if (!isset($userInitials)) {
    $userInitials = 'AR';
}
if (!isset($userRole)) {
    $userRole = 'Employee';
}

// Get initials from name
$initials = strlen($userInitials) > 0 ? $userInitials : strtoupper(substr($userName, 0, 2));
?>
<!-- Overlay Backdrop -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Floating Sidebar -->
<aside class="floating-sidebar" id="floatingSidebar">
    <!-- Sidebar Header with Logo -->
    <div class="sidebar-header">
        <a href="index.php" class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <i class="fas fa-shapes"></i>
            </div>
            <span class="sidebar-logo-text">SISPEG</span>
        </a>
    </div>

    <!-- User Info Section -->
    <div class="sidebar-user">
        <div class="user-info">
            <div class="user-avatar"><?php echo htmlspecialchars($initials); ?></div>
            <div class="user-details">
                <h6><?php echo htmlspecialchars($userName); ?></h6>
                <small id="roleLabel"><?php echo htmlspecialchars($userRole); ?></small>
            </div>
        </div>
        
        <!-- Role Switcher -->
        <div class="role-switcher">
            <label>Switch Role</label>
            <div class="role-buttons">
                <button class="role-btn<?php echo $userRole === 'Employee' ? ' active' : ''; ?>" data-role="employee">Employee</button>
                <button class="role-btn<?php echo $userRole === 'Manager' ? ' active' : ''; ?>" data-role="manager">Manager</button>
                <button class="role-btn<?php echo $userRole === 'Administrator' ? ' active' : ''; ?>" data-role="admin">Admin</button>
            </div>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="sidebar-nav">
        <!-- Employee Section -->
        <div class="menu-section">
            <p class="menu-section-title">Employee</p>
            <a href="index.php" class="menu-item<?php echo $activeMenu === 'dashboard' ? ' active' : ''; ?>" data-menu="dashboard">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="menu-item<?php echo $activeMenu === 'attendance' ? ' active' : ''; ?>" data-menu="attendance">
                <i class="fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
            <a href="#" class="menu-item<?php echo $activeMenu === 'tasks' ? ' active' : ''; ?>" data-menu="tasks">
                <i class="fas fa-tasks"></i>
                <span>Tasks</span>
            </a>
        </div>

        <!-- Manager Section -->
        <div class="menu-section">
            <p class="menu-section-title">Manager</p>
            <a href="#" class="menu-item<?php echo $activeMenu === 'approvals' ? ' active' : ''; ?>" data-menu="approvals">
                <i class="fas fa-clipboard-check"></i>
                <span>Approvals</span>
            </a>
            <div class="menu-item-group">
                <a href="#" class="menu-item has-submenu<?php echo $activeMenu === 'team-reports' ? ' active' : ''; ?>" data-menu="team-reports" aria-expanded="false">
                    <span class="d-flex align-items-center gap-2">
                        <i class="fas fa-chart-bar"></i>
                        <span>Team Reports</span>
                    </span>
                    <span class="submenu-caret"><i class="fas fa-chevron-right"></i></span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="#" class="submenu-item">
                            <i class="fas fa-user-check"></i>
                            <span>Attendance Summary</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="submenu-item">
                            <i class="fas fa-chart-line"></i>
                            <span>Performance</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="submenu-item">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Monthly Recap</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Admin Section -->
        <div class="menu-section">
            <p class="menu-section-title">Admin</p>
            <a href="pegawai.php" class="menu-item admin-only<?php echo $activeMenu === 'pegawai' ? ' active' : ''; ?>" data-menu="pegawai">
                <i class="fas fa-users"></i>
                <span>Data Pegawai</span>
            </a>
            <a href="#" class="menu-item admin-only<?php echo $activeMenu === 'user-management' ? ' active' : ''; ?>" data-menu="user-management">
                <i class="fas fa-users-cog"></i>
                <span>User Management</span>
            </a>
            <div class="menu-item-group">
                <a href="#" class="menu-item admin-only has-submenu<?php echo $activeMenu === 'settings' ? ' active' : ''; ?>" data-menu="settings" aria-expanded="false">
                    <span class="d-flex align-items-center gap-2">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </span>
                    <span class="submenu-caret"><i class="fas fa-chevron-right"></i></span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="#" class="submenu-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Security</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="submenu-item">
                            <i class="fas fa-sliders-h"></i>
                            <span>Preferences</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="submenu-item">
                            <i class="fas fa-plug"></i>
                            <span>Integrations</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</aside>