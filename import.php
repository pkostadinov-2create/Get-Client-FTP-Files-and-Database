<?php  
ini_set('max_execution_time', 300);

require_once('wp-config.php');
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASSWORD;
$db_name = DB_NAME;
$filename = 'dump.sql';

if (file_exists($filename . '.zip')) {
    system("unzip -u {$filename}.zip $filename");
}

$port = '';
$host_port = explode(':', DB_HOST);
if ( count($host_port) == 2 ) {
	$host = escapeshellarg($host_port[0]);
	$port = escapeshellarg($host_port[1]);
	$port = "--port={$port} ";
}

echo "begin<br />\n";
system("cat {$filename} | mysql -h {$host} {$port} -u {$user} --password=" . escapeshellarg($pass) . " {$db_name} 2>&1");
echo "end<br />\n";

if (file_exists($filename . '.zip')) {
    system("rm $filename");
}