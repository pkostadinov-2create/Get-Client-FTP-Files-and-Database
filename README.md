# Get-Client-FTP-Files-and-Database
Easy sync with client files, zips all FTP files, and creates database dump

### backup.php
Backup Database + All Files

### backup-db.php
Backup Database Only

### backup-files-only.php
Backup Files Only

### backup-wp.php
Backup Database + All Files and Folders which name starts with `wp`

### backup-wp-content.php
Backup Database + entire `wp-content` folder

### backup-wp-plugins.php
Backup Database + entire `wp-plugins` folder

### backup-wp-themes.php
Backup Database + entire `wp-themes` folder

### backup-wp-uploads.php
Backup Database + entire `wp-uploads` folder

### backup-wp-uploads-filtered.php
Backup Database + `wp-uploads` folder, however only the folders starting with `20`, for example 2015, 2016 etc.

### dell-all.php
Deletes all files in the current folder

### import.php
Imports `dump.sql` or `dump.sql.zip`

### info.php
Displays `phpinfo()`

### wp-zip-extract.php
Extracts `wp.zip` file located in the same folder

### wp-zip-extract-no-system.php
Extracts `wp.zip` file located in the same folder, however without the use of `system` command

### wp-zip-extract-uploads.php
Extracts `uploads.zip` file located in the same folder