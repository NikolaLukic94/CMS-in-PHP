<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'new');

$dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// make data safe to use in queries - escaping
/*
removes extra slashes in magic quotes is enabled
trims extra spaes from the data
runs the data through the mysqli_real_escape_sting()
*/

function escape_data ($data) {
	global $dbc;
	if (get_magic_quotes_gpc( )) $data = stripslashes($data);
	return mysqli_real_escape_string (trim ($data), $dbc);
}