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
$additionalJs = ['apexcharts'];      // Load ApexCharts for dashboard charts

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
        <!-- Card 1: Recent Employees -->
        <div class="content-card header-bg-primary">
            <div class="content-card-header">
                <h5><i class="fas fa-users"></i> Recent Employees</h5>
                <a href="#" class="btn btn-sm btn-outline-light">View All</a>
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

        <!-- Card 2: My Tasks -->
        <div class="content-card header-bg-warning">
            <div class="content-card-header">
                <h5><i class="fas fa-tasks"></i> My Tasks</h5>
                <a href="#" class="btn btn-sm btn-link text-white">Add Task</a>
            </div>
            <ul class="task-list" id="taskList">
                <!-- Tasks will be loaded via JavaScript -->
            </ul>
        </div>

        <!-- Card 3: Quick Actions -->
        <div class="content-card header-bg-info">
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

        <!-- Card 4: Department Distribution (Pie Chart) -->
        <div class="content-card header-bg-primary">
            <div class="content-card-header">
                <h5><i class="fas fa-chart-pie"></i> Department Distribution</h5>
            </div>
            <div id="departmentPieChart"></div>
        </div>

        <!-- Card 5: Attendance Trend (Line Chart) -->
        <div class="content-card header-bg-success">
            <div class="content-card-header">
                <h5><i class="fas fa-chart-line"></i> Attendance Trend</h5>
            </div>
            <div id="attendanceLineChart"></div>
        </div>

        <!-- Card 6: Task Completion (Bar Chart) -->
        <div class="content-card header-bg-warning">
            <div class="content-card-header">
                <h5><i class="fas fa-chart-bar"></i> Task Completion</h5>
            </div>
            <div id="taskBarChart"></div>
        </div>

        <!-- Card 7: Performance (RadialBar Chart) -->
        <div class="content-card header-bg-teal">
            <div class="content-card-header">
                <h5><i class="fas fa-tachometer-alt"></i> Performance</h5>
            </div>
            <div id="performanceRadialChart"></div>
        </div>

        <!-- Card 8: Employee Growth (Area Chart) -->
        <div class="content-card header-bg-indigo">
            <div class="content-card-header">
                <h5><i class="fas fa-users"></i> Employee Growth</h5>
            </div>
            <div id="employeeAreaChart"></div>
        </div>

        <!-- Card 9: Recent Activity -->
        <div class="content-card header-bg-purple">
            <div class="content-card-header">
                <h5><i class="fas fa-history"></i> Recent Activity</h5>
            </div>
            <div class="activity-list">
                <div class="activity-item">
                    <i class="fas fa-user-plus activity-icon success"></i>
                    <div class="activity-content">
                        <p>New employee joined</p>
                        <small>2 hours ago</small>
                    </div>
                </div>
                <div class="activity-item">
                    <i class="fas fa-check-circle text-info"></i>
                    <div class="activity-content">
                        <p>Task completed</p>
                        <small>4 hours ago</small>
                    </div>
                </div>
                <div class="activity-item">
                    <i class="fas fa-calendar-alt text-warning"></i>
                    <div class="activity-content">
                        <p>Meeting scheduled</p>
                        <small>Yesterday</small>
                    </div>
                </div>
                <div class="activity-item">
                    <i class="fas fa-file-alt text-primary"></i>
                    <div class="activity-content">
                        <p>Report submitted</p>
                        <small>Yesterday</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer-content.php'; ?>

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
    // APEXCHARTS INITIALIZATION
    // =====================================================

    function initCharts() {
        var fontFamily = "'Inter', sans-serif";
        var gridColor = 'rgba(0,0,0,0.05)';
        var textColor = '#6b7280';

        // 1. Pie Chart — Department Distribution
        var pieOptions = {
            series: [48, 32, 28, 42, 98],
            chart: { type: 'donut', fontFamily: fontFamily, height: 300 },
            labels: ['IT', 'HR', 'Finance', 'Marketing', 'Operations'],
            colors: ['#0F9D58', '#8b5cf6', '#f59e0b', '#06b6d4', '#6366f1'],
            legend: { position: 'bottom', fontFamily: fontFamily, fontSize: '12px' },
            dataLabels: { enabled: false },
            stroke: { show: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            name: { fontSize: '14px', color: '#374151' },
                            value: { fontSize: '24px', fontWeight: 700, color: '#111827' },
                            total: { show: true, label: 'Total', fontSize: '14px', color: '#6b7280',
                                formatter: function() { return '248'; }
                            }
                        }
                    }
                }
            }
        };
        new ApexCharts(document.querySelector('#departmentPieChart'), pieOptions).render();

        // 2. Line Chart — Attendance Trend
        var lineOptions = {
            series: [{ name: 'Present', data: [220, 235, 228, 240, 232, 235] }],
            chart: { type: 'line', fontFamily: fontFamily, height: 300, toolbar: { show: false }, zoom: { enabled: false } },
            stroke: { curve: 'smooth', width: 3 },
            colors: ['#0F9D58'],
            xaxis: { categories: ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'], labels: { style: { fontSize: '11px', colors: textColor } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: textColor } } },
            grid: { borderColor: gridColor },
            markers: { size: 4, colors: ['#0F9D58'], strokeColors: '#fff', strokeWidth: 2 },
            tooltip: { theme: 'light' }
        };
        new ApexCharts(document.querySelector('#attendanceLineChart'), lineOptions).render();

        // 3. Bar Chart — Task Completion
        var barOptions = {
            series: [{ name: 'Completed', data: [35, 42, 38, 50, 45, 52] }, { name: 'Pending', data: [15, 12, 18, 10, 14, 8] }],
            chart: { type: 'bar', fontFamily: fontFamily, height: 300, toolbar: { show: false }, stacked: false },
            plotOptions: { bar: { horizontal: false, columnWidth: '55%', borderRadius: 4 } },
            colors: ['#0F9D58', '#f59e0b'],
            xaxis: { categories: ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'], labels: { style: { fontSize: '11px', colors: textColor } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: textColor } } },
            grid: { borderColor: gridColor },
            legend: { position: 'top', fontFamily: fontFamily, fontSize: '12px' },
            tooltip: { theme: 'light' }
        };
        new ApexCharts(document.querySelector('#taskBarChart'), barOptions).render();

        // 4. RadialBar Chart — Performance
        var radialOptions = {
            series: [87, 94, 92, 78],
            chart: { type: 'radialBar', fontFamily: fontFamily, height: 320 },
            colors: ['#0F9D58', '#06b6d4', '#8b5cf6', '#f59e0b'],
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    startAngle: -140,
                    endAngle: 140,
                    hollow: { size: '55%' },
                    dataLabels: {
                        name: { fontSize: '14px', color: '#374151' },
                        value: { fontSize: '18px', fontWeight: 700, color: '#111827' },
                        total: { show: true, label: 'Average', fontSize: '12px', color: '#6b7280',
                            formatter: function() { return '88%'; }
                        }
                    },
                    track: { background: '#f3f4f6' }
                }
            },
            labels: ['Efficiency', 'On Time', 'Quality', 'Satisfaction'],
            legend: { position: 'bottom', fontFamily: fontFamily, fontSize: '12px' }
        };
        new ApexCharts(document.querySelector('#performanceRadialChart'), radialOptions).render();

        // 5. Area Chart — Employee Growth
        var areaOptions = {
            series: [{ name: 'New Hires', data: [8, 12, 10, 15, 18, 14, 20, 16, 22, 19, 25, 28] }],
            chart: { type: 'area', fontFamily: fontFamily, height: 300, toolbar: { show: false }, zoom: { enabled: false } },
            stroke: { curve: 'smooth', width: 3 },
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1, stops: [0, 100] } },
            colors: ['#0F9D58'],
            xaxis: { categories: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'], labels: { style: { fontSize: '10px', colors: textColor } } },
            yaxis: { labels: { style: { fontSize: '11px', colors: textColor } } },
            grid: { borderColor: gridColor },
            tooltip: { theme: 'light' }
        };
        new ApexCharts(document.querySelector('#employeeAreaChart'), areaOptions).render();
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

        // Initialize charts
        initCharts();
    });

})(jQuery);
JS;

// Include Footer
include 'includes/footer.php';
?>