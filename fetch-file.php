<?php 
 $response = new StdClass();

// This seems to help for windows-based hosts where PHP does include the waiting time to execution time. 
set_time_limit(0);

if ( function_exists( 'curl_init' ) || function_exists( 'curl_exec' ) ) {
	$file_handle = fopen("emque-2014-11-17-1416233557.zip", 'w+');

	if (!$file_handle) {
		$responsep->status = "Error";
		$responsep->message = "Couldn't open archive file for writing. ";
	} else {
		function shuttle_write_archive_file($ch, $chunk) {
			global $file_handle;

			return fwrite($file_handle, $chunk);
		}
		$ch = curl_init("http://wp-preview2.htmlburger.com/michael_papandrea/emque-2014-11-17-1416233557.zip");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
		curl_setopt($ch, CURLOPT_FILE, $file_handle);
		curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'shuttle_write_archive_file');
		
		$res = curl_exec ($ch);
		if ($res) {
			$response->status = "OK";
		} else {
			$response->status = "Error";
			$response->message = curl_error($ch);
		}
		
		curl_close ($ch);
	}
} else {
	// Hope for the best: try to use the regular copy function
	$res = copy("http://wp-preview2.htmlburger.com/michael_papandrea/emque-2014-11-17-1416233557.zip", "emque-2014-11-17-1416233557.zip");

	if ($res) {
		$response->status = "OK";
	} else {
		$response->status = "Error";
		$response->message = "Couldn't save the archive file. ";
	}
}

echo json_encode($response); 