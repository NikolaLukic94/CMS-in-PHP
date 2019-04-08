<?php 

session_start();

include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])) {

}	else {

	if (isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);
	}

	if (empty($username) or empty($password)) {
		$error = 'All fields are required!'
	}	else {
		$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
		$query->bindValue(1, $username);
		$query->bindValue(1, $password);

		$query->execute();

		$num = $query->rowCount();

		if ($num == 1) {
			$_SESSION['logged_in'] = true;
			header('Location: index.php');
			exit();
		}	else {
			$error = "Incorrect details!";
		}
	}
	?>
<html>
<head>
	<title>CMS App</title>
	<link rel="stylesheet" type="../assets/style.css" href="">
</head>
<body>
	<div class="container">
		<a href="index.php" id="logo">CMS</a>

		<?php if (isset($error)) { ?>
			<small style="color:#aa0000;">
				<?php echo $error; ?>
				<br>
				<br>
			</small>

		<form action="index.php" method="post" autocomplete="off">
			<input type="text" name="username" placeholder="Username">
			<input type="text" name="password" placeholder="Password">	
			<input type="submit" value="Login">		
		</form>
		
	</div>
</body>
</html>
	<?php
}


?>