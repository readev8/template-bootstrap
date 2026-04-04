<?php
/**
 * CSS Partial - Updated Structure
 * Organized loading order for new CSS architecture
 * 
 * Variables:
 * $pageCss (string) - Page identifier untuk loading CSS spesifik (e.g., 'dashboard', 'pegawai', 'pegawai-detail')
 * $additionalCss (array) - Additional external CSS to load (optional, for CDN libraries)
 */

// Default values
if (!isset($pageCss)) {
    $pageCss = '';
}
if (!isset($additionalCss)) {
    $additionalCss = [];
}

// Additional CSS configuration untuk external libraries
$cssConfigs = [
    'datatables' => [
        'https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css',
        'https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css'
    ],
    'datatables-buttons' => [
        'https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css'
    ],
    'datepicker' => [
        'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'
    ],
    'select2' => [
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
        'https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css'
    ]
];

// Page-specific CSS mapping
$pageCssMap = [
    'dashboard' => 'pages/dashboard.css',
    'pegawai' => 'pages/pegawai-list.css',
    'pegawai-detail' => 'pages/pegawai-detail.css',
];
?>
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5.3 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<!-- FontAwesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Additional CSS (External Libraries) - Loaded BEFORE custom CSS to allow overrides -->
<?php if (!empty($additionalCss) && is_array($additionalCss)): ?>
<?php foreach ($additionalCss as $cssKey): ?>
<?php if (isset($cssConfigs[$cssKey])): ?>
<?php foreach ($cssConfigs[$cssKey] as $cssUrl): ?>
<link rel="stylesheet" href="<?php echo htmlspecialchars($cssUrl); ?>">
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>

<!-- Custom CSS - Ordered by dependency (loaded AFTER CDN libraries to ensure proper cascade) -->
<link rel="stylesheet" href="assets/css/01-variables.css">
<link rel="stylesheet" href="assets/css/02-reset.css">
<link rel="stylesheet" href="assets/css/03-layout.css">
<link rel="stylesheet" href="assets/css/04-components.css">
<link rel="stylesheet" href="assets/css/05-tables.css">
<link rel="stylesheet" href="assets/css/06-forms.css">
<link rel="stylesheet" href="assets/css/07-utilities.css">

<!-- Page-specific CSS -->
<?php if (!empty($pageCss) && isset($pageCssMap[$pageCss])): ?>
<link rel="stylesheet" href="assets/css/<?php echo htmlspecialchars($pageCssMap[$pageCss]); ?>">
<?php endif; ?>
