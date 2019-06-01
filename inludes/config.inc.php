<?php
// this will be used by every script in the site
/*
it will define systemwide settings
define useful constants that can be used by multiple scripts
start the session
establish how errors will be handled
*/

//this var wil dictate how errors will be handled
$live = false; 
//email address to which error messages will be send when the site goes live
$contact_email = 'you@example.com';

define ('BASE_URI', '/path/to/Web/parent/folder/');
define ('BASE_URL', 'localhost/new-ecommerce/');
define ('MYSQL', '/path/to/mysql.inc.php');

session_start( );

/*
1st argument is numeric error identifier that might be assigned a value
2nd is the receeived error message
3rd is the name f file in whih error occurred
4th on which line
5th is an array of every variable that existed when the error occured
*/
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
	global $live, $contact_email;
	$message = "An error occurred in script '$e_file' on line $e_line: \n$e_message\n";
	//backtrace is everything that happened up until the point of the error
	$message .= "<pre>" .print_r(debug_backtrace( ), 1) . "</pre>\n";
	// or use $message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n";
	//if site isn't live, show error message in browser
	if (!$live) {
		echo '<div class="error">' . nl2br($message) . '</div>';
	}  else {
	error_log ($message, 1, $contact_email, 'From:admin@example.com');
	}

	if ($e_number != E_NOTICE) {
		echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div>';
	}
}

/* tells PHP to use custom functions for handling errors */
set_error_handler ('my_error_handler');



function redirect_invalid_user($check = 'user_id', $destination = 'index.php', $protocol = 'http://') {
	if (!isset($_SESSION[$check])) {
		$url = $protocol . BASE_URL . $destination;
		header("Location: $url");
		exit( );
	}
}

function get_password_hash($password) {
	global $dbc;
	return mysqli_real_escape_string ($dbc, hash_hmac('sha256',
	$password, 'c#haRl891', true));
}