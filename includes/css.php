<?php
/**
 * CSS Partial
 * Contains all CSS <link> tags
 * 
 * Variables:
 * $additionalCss (array) - Additional CSS to load (e.g., ['datatables', 'datepicker'])
 */

// Additional CSS configuration
$cssConfigs = [
    'datatables' => [
        'https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css',
        'https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css'
    ],
    'pegawai-detail' => [
        'assets/css/pegawai-detail.css'
    ],
    'datepicker' => [
        'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'
    ],
    'select2' => [
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
        'https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css'
    ]
];
?>
<!-- Google Fonts - Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5.3 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<!-- FontAwesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Custom CSS Files -->
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/navbar.css">
<link rel="stylesheet" href="assets/css/style.css">

<!-- Additional CSS (Page-Specific) -->
<?php if (!empty($additionalCss) && is_array($additionalCss)): ?>
<?php foreach ($additionalCss as $cssKey): ?>
<?php if (isset($cssConfigs[$cssKey])): ?>
<?php foreach ($cssConfigs[$cssKey] as $cssUrl): ?>
<link rel="stylesheet" href="<?php echo htmlspecialchars($cssUrl); ?>">
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
