<?php
/**
 * Head Partial
 * Contains DOCTYPE, <html>, <head> with meta, title, and CSS includes
 * 
 * Required Variables:
 * $pageTitle (string) - Page title for <title> tag
 * $additionalCss (array) - Additional CSS to load (optional, default [])
 * 
 * Optional Variables:
 * $lang (string) - Language attribute, default 'en'
 */
if (!isset($pageTitle)) {
    $pageTitle = 'SISPEG';
}
if (!isset($additionalCss)) {
    $additionalCss = [];
}
if (!isset($lang)) {
    $lang = 'en';
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SISPEG - Sistem Informasi Kepegawaian">
    <meta name="author" content="SISPEG Team">
    
    <!-- Title -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- Favicon (optional) -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📊</text></svg>">
    
    <!-- CSS Includes -->
    <?php include __DIR__ . '/css.php'; ?>
</head>
<body<?php if (isset($bodyClass)) echo ' class="' . htmlspecialchars($bodyClass) . '"'; ?>>