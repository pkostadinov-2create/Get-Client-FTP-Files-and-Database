<?php
ini_set('max_execution_time', 300);
error_reporting(E_ALL);

require_once('wp-config.php');
global $table_prefix;
$host = escapeshellarg(DB_HOST);
$user = escapeshellarg(DB_USER);
$pass = escapeshellarg(DB_PASSWORD);
$db_name = escapeshellarg(DB_NAME);
$filename = escapeshellarg('dump.sql');
$filename_zip = escapeshellarg(sprintf('dump.sql.%s.zip', date('Ymd')));

$port = '';
$host_port = explode(':', DB_HOST);
if ( count($host_port) == 2 ) {
	$host = escapeshellarg($host_port[0]);
	$port = escapeshellarg($host_port[1]);
	$port = "--port={$port} ";
}

$dump_statement = "mysqldump -h $host {$port} -u $user -p{$pass} $db_name \$(mysql -h $host -u $user -p{$pass} -D $db_name -Bse \"show tables like '{$table_prefix}%'\") > $filename 2>&1";
$zip_statement = "zip -u $filename_zip $filename";
$rm_statement = "rm $filename";

if (function_exists('system')) {
    system($dump_statement); // 2>&1
    system($zip_statement);
    system($rm_statement);
} else {
    echo '<code>system()</code> is not supported. Copy-paste the following via SSH:';
    echo "<pre>$dump_statement\n$zip_statement\n$rm_statement\n\n</pre>";
}

$zip_statement = 'zip -r wp.zip . 2>&1';
if (function_exists('system')) {
    echo '<pre>';
    system($zip_statement);
} else {
    echo '<code>system()</code> is not supported. Copy and paste the following through SSH:';
    echo "<pre>$zip_statement\n\n</pre>";
}
?>