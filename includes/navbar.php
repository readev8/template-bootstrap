<?php
/**
 * Navbar Partial
 * Contains glassmorphism navbar with toggle, search, notifications, and user dropdown
 * 
 * Required Variables:
 * $searchPlaceholder (string) - Placeholder text for search input
 * 
 * Optional Variables:
 * $userName (string) - User display name, default 'Ahmad Rizki'
 * $userInitials (string) - User initials for avatar, default 'AR'
 * $userEmail (string) - User email for dropdown, default 'ahmad.rizki@company.com'
 * $notificationCount (int) - Number of notifications, default 3
 */
if (!isset($searchPlaceholder)) {
    $searchPlaceholder = 'Search...';
}
if (!isset($userName)) {
    $userName = 'Ahmad Rizki';
}
if (!isset($userInitials)) {
    $userInitials = 'AR';
}
if (!isset($userEmail)) {
    $userEmail = 'ahmad.rizki@company.com';
}
if (!isset($notificationCount)) {
    $notificationCount = 3;
}
?>
<!-- Glassmorphism Navbar -->
<nav class="glass-navbar">
    <!-- Left: Sidebar Toggle -->
    <div class="navbar-left">
        <button class="floating-toggle" id="floatingToggle" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Center: Search Bar -->
    <div class="navbar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="<?php echo htmlspecialchars($searchPlaceholder); ?>" id="searchInput">
    </div>

    <!-- Right: Action Buttons -->
    <div class="navbar-actions">
        <!-- Notification Bell -->
        <button class="navbar-notification" id="notificationBtn" aria-label="Notifications">
            <i class="fas fa-bell"></i>
            <span class="notification-badge"><?php echo (int)$notificationCount; ?></span>
        </button>

        <!-- User Dropdown -->
        <div class="navbar-user" id="userDropdownWrapper">
            <button class="user-dropdown-toggle" id="userDropdownToggle">
                <div class="user-avatar"><?php echo htmlspecialchars($userInitials); ?></div>
                <span id="userName"><?php echo htmlspecialchars($userName); ?></span>
                <i class="fas fa-chevron-down"></i>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="user-dropdown-menu" id="userDropdownMenu">
                <div class="dropdown-header">
                    <h6><?php echo htmlspecialchars($userName); ?></h6>
                    <small><?php echo htmlspecialchars($userEmail); ?></small>
                </div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>Account Settings</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-question-circle"></i>
                    <span>Help &amp; Support</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
</nav>