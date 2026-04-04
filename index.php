<?php
/**
 * Dashboard Page (index.php)
 * Main dashboard showing statistics, recent employees, tasks, and quick actions
 * 
 * Layout: Uses partial files from includes/
 */

// Page Configuration
$pageTitle = 'SISPEG - Modern Dashboard';
$activeMenu = 'dashboard';
$searchPlaceholder = 'Search anything...';
$pageCss = 'dashboard';  // Load dashboard-specific CSS
$additionalCss = [];     // No additional external CSS needed
$additionalJs = [];      // No additional JS needed for dashboard

// User Configuration
$userName = 'Ahmad Rizki';
$userInitials = 'AR';
$userRole = 'Employee';

// Include Head
include 'includes/head.php';

// Include Sidebar
include 'includes/sidebar.php';

// Include Navbar
include 'includes/navbar.php';
?>

<!-- Main Content -->
<main class="main-content" id="mainContent">
    <!-- Page Header -->
    <div class="page-header">
        <h1 id="pageTitle">Dashboard Overview</h1>
        <p id="pageSubtitle">Welcome back, Ahmad! Here's what's happening today.</p>
    </div>

    <!-- Stat Cards -->
    <div class="stat-cards-container" id="statCardsContainer">
        <!-- Card 1: Total Employees -->
        <div class="stat-card" data-index="0">
            <div class="stat-icon primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>248</h3>
                <p>Total Employees</p>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> +12 this month
                </span>
            </div>
        </div>

        <!-- Card 2: Present Today -->
        <div class="stat-card" data-index="1">
            <div class="stat-icon success">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-content">
                <h3>235</h3>
                <p>Present Today</p>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> 94.8% attendance
                </span>
            </div>
        </div>

        <!-- Card 3: Pending Tasks -->
        <div class="stat-card" data-index="2">
            <div class="stat-icon warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3>42</h3>
                <p>Pending Tasks</p>
                <span class="stat-trend down">
                    <i class="fas fa-arrow-down"></i> -5 from yesterday
                </span>
            </div>
        </div>

        <!-- Card 4: Completed -->
        <div class="stat-card" data-index="3">
            <div class="stat-icon info">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>186</h3>
                <p>Completed</p>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> +23 this week
                </span>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Left Column: Recent Employees Table -->
        <div class="content-card header-primary">
            <div class="content-card-header">
                <h5><i class="fas fa-users"></i> Recent Employees</h5>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="employeeTableBody">
                    <!-- Data will be loaded via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Right Column: Tasks & Quick Actions -->
        <div>
            <!-- Tasks Card -->
            <div class="content-card mb-4 header-warning">
                <div class="content-card-header">
                    <h5><i class="fas fa-tasks"></i> My Tasks</h5>
                    <a href="#" class="btn btn-sm btn-link text-primary">Add Task</a>
                </div>
                <ul class="task-list" id="taskList">
                    <!-- Tasks will be loaded via JavaScript -->
                </ul>
            </div>

            <!-- Quick Actions Card -->
            <div class="content-card header-info">
                <div class="content-card-header">
                    <h5><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="quick-actions">
                    <button class="quick-action-btn">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Check In</span>
                    </button>
                    <button class="quick-action-btn">
                        <i class="fas fa-file-import"></i>
                        <span>Submit Report</span>
                    </button>
                    <button class="quick-action-btn">
                        <i class="fas fa-clipboard-list"></i>
                        <span>View Schedule</span>
                    </button>
                    <button class="quick-action-btn">
                        <i class="fas fa-headset"></i>
                        <span>Get Support</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
// Page-specific JavaScript (Dashboard)
$pageJs = <<<'JS'
/**
 * =====================================================
 * DASHBOARD PAGE JAVASCRIPT
 * =====================================================
 * Page-specific functionality for the dashboard
 */

(function($) {
    'use strict';

    // =====================================================
    // PAGE HEADER UPDATES BY ROLE
    // =====================================================
    
    /**
     * Updates the page header based on the current role
     * @param {string} role - The current role
     */
    function updatePageHeader(role) {
        var headers = {
            'employee': {
                title: 'My Dashboard',
                subtitle: 'Welcome back, Ahmad! Here\'s your activity overview.'
            },
            'manager': {
                title: 'Team Dashboard',
                subtitle: 'Managing team of 45 employees. All systems operational.'
            },
            'admin': {
                title: 'Admin Dashboard',
                subtitle: 'System overview. Managing 248 employees across 5 departments.'
            }
        };

        var header = headers[role] || headers['employee'];
        $('#pageTitle').text(header.title);
        $('#pageSubtitle').text(header.subtitle);
    }

    // =====================================================
    // DATA LOADING
    // =====================================================

    /**
     * Loads employee data from JSONPlaceholder API
     * @param {string} role - The current role for filtering
     */
    function loadEmployeeData(role) {
        $('#employeeTableBody').html(
            '<tr>' +
                '<td colspan="4" class="text-center py-4">' +
                    '<div class="spinner-border spinner-border-sm text-primary" role="status"></div>' +
                    ' Loading data...' +
                '</td>' +
            '</tr>'
        );

        $.ajax({
            url: 'https://jsonplaceholder.typicode.com/users',
            method: 'GET',
            dataType: 'json',
            success: function(users) {
                var displayUsers = users.slice(0, 5);
                var html = '';
                var departments = ['IT', 'HR', 'Finance', 'Marketing', 'Operations'];
                var statuses = ['success', 'warning', 'info', 'success', 'warning'];
                var statusLabels = ['Active', 'On Leave', 'Remote', 'Active', 'On Leave'];

                $.each(displayUsers, function(index, user) {
                    var deptIndex = index % departments.length;
                    html += '<tr>' +
                        '<td>' +
                            '<div class="d-flex align-items-center">' +
                                '<div class="table-avatar">' + user.name.charAt(0) + '</div>' +
                                '<div>' +
                                    '<strong>' + user.name + '</strong>' +
                                    '<br>' +
                                    '<small class="text-muted">@' + user.username.toLowerCase() + '</small>' +
                                '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td>' + departments[deptIndex] + '</td>' +
                        '<td>' +
                            '<span class="status-badge ' + statuses[deptIndex] + '">' +
                                statusLabels[deptIndex] +
                            '</span>' +
                        '</td>' +
                        '<td>' +
                            '<button class="btn btn-sm btn-outline-secondary">' +
                                '<i class="fas fa-ellipsis-h"></i>' +
                            '</button>' +
                        '</td>' +
                    '</tr>';
                });

                $('#employeeTableBody').html(html);
            },
            error: function() {
                $('#employeeTableBody').html(
                    '<tr>' +
                        '<td colspan="4" class="text-center py-4 text-danger">' +
                            'Failed to load data. Please try again.' +
                        '</td>' +
                    '</tr>'
                );
            }
        });
    }

    /**
     * Loads task data from JSONPlaceholder API
     */
    function loadTaskData() {
        $.ajax({
            url: 'https://jsonplaceholder.typicode.com/todos?_limit=6',
            method: 'GET',
            dataType: 'json',
            success: function(todos) {
                var html = '';

                $.each(todos, function(index, todo) {
                    var isChecked = todo.completed ? 'checked' : '';
                    var checkIcon = todo.completed ? 'fa-check' : '';

                    html += '<li class="task-item">' +
                        '<div class="task-checkbox ' + isChecked + '" data-id="' + todo.id + '">' +
                            '<i class="fas ' + checkIcon + '"></i>' +
                        '</div>' +
                        '<div class="task-content ' + isChecked + '">' +
                            '<p>' + todo.title + '</p>' +
                            '<div class="task-meta">' +
                                '<i class="far fa-calendar"></i> Due in ' + (index + 1) + ' days' +
                            '</div>' +
                        '</div>' +
                    '</li>';
                });

                $('#taskList').html(html);
            },
            error: function() {
                $('#taskList').html(
                    '<li class="task-item text-center text-danger py-4">' +
                        'Failed to load tasks' +
                    '</li>'
                );
            }
        });
    }

    // =====================================================
    // ENTRY ANIMATIONS
    // =====================================================

    /**
     * Plays staggered entry animation for stat cards
     */
    function playEntryAnimation() {
        var $cards = $('.stat-card');

        $cards.each(function(index) {
            var $card = $(this);
            var delay = index * 150;

            setTimeout(function() {
                $card.addClass('animate-in');
            }, delay);
        });
    }

    // =====================================================
    // SEARCH FUNCTIONALITY
    // =====================================================

    $('#searchInput').on('input', function() {
        var query = $(this).val().toLowerCase();

        $('#employeeTableBody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
        });
    });

    // =====================================================
    // TASK CHECKBOX TOGGLE
    // =====================================================

    $(document).on('click', '.task-checkbox', function() {
        $(this).toggleClass('checked');
        $(this).closest('.task-item').find('.task-content').toggleClass('checked');
    });

    // =====================================================
    // ROLE SWITCH HANDLER
    // =====================================================

    // Override switchRole to also update page header
    var originalSwitchRole = window.SISPEG ? window.SISPEG.switchRole : null;

    if (originalSwitchRole) {
        window.SISPEG.switchRole = function(role) {
            originalSwitchRole(role);
            updatePageHeader(role);
            loadEmployeeData(role);
        };
    }

    // =====================================================
    // INITIALIZATION
    // =====================================================

    $(document).ready(function() {
        // Get saved role
        var savedRole = localStorage.getItem('userRole') || 'employee';

        // Update page header for current role
        updatePageHeader(savedRole);

        // Load initial data
        loadEmployeeData(savedRole);
        loadTaskData();

        // Play entry animation
        playEntryAnimation();
    });

})(jQuery);
JS;

// Include Footer
include 'includes/footer.php';
?>