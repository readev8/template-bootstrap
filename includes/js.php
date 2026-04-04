<?php
/**
 * JS Partial
 * Contains all JS <script src> tags
 * 
 * Variables:
 * $additionalJs (array) - Additional JS to load (e.g., ['datatables', 'datepicker'])
 */

// Additional JS configuration
$jsConfigs = [
    'datatables' => [
        'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js',
        'https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js',
        'https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js'
    ],
    'datatables-buttons' => [
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',
        'https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js',
        'https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js',
        'https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js'
    ],
    'datepicker' => [
        'https://cdn.jsdelivr.net/npm/flatpickr'
    ],
    'select2' => [
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
    ],
    'chart' => [
        'https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js'
    ]
];
?>
<!-- jQuery 3.x -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<!-- Bootstrap 5.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Main JS -->
<script src="assets/js/main.js"></script>

<!-- Additional JS (Page-Specific) -->
<?php if (!empty($additionalJs) && is_array($additionalJs)): ?>
<?php foreach ($additionalJs as $jsKey): ?>
<?php if (isset($jsConfigs[$jsKey])): ?>
<?php foreach ($jsConfigs[$jsKey] as $jsUrl): ?>
<script src="<?php echo htmlspecialchars($jsUrl); ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
