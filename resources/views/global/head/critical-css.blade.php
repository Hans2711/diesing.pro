<?php
$criticalPath = public_path('critical.css');
if (file_exists($criticalPath)) {
    echo '<style id="critical-css">' . file_get_contents($criticalPath) . '</style>';
}
?>
