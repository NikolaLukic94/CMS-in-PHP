<?php 

session_start();

include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])) {
	if(isset($_POST['title'], $_POST['content'])) {
		$title = $_POST['title'];
		$content = nl2be($_POST['content']);

		if(empty($title) or empty($content)) {
			$error = "All fields are required!";
		}	else {
			$query = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?,?,?)');

			$query->bindValue(1, $title);
			$query->bindValue(2, $content);
			$query->bindValue(3, time());

			$query->execute();

			header('Location:index.php');
		}
	}
	?>
<html>
<head>
	<title>CMS App</title>
	<link rel="stylesheet" type="assets/style.css" href="">
</head>
<body>
	<div class="container">
		<a href="index.php" id="logo">CMS</a>
		<br>
		<h4>Add Article</h4>

		<?php if (isset($error)) { ?>
			<small style="color:#aa0000;">
				<?php echo $error; ?>
				<br>
				<br>
			</small>
		?>	

		<form action="add.php" method="post" autocomplete="off">
			<input type="text" name="title" placeholder="Title">
			<br>
			<textarea rows="15" cols="50" placeholder="Content" name="content">
			</textarea>	
			<br>
			<input type="submit" value="Add Article">	
				
		</form>


		<br>
		<small><a href="admin">Admin</a></small>
	</div>
</body>
</html>

	<?php
}	else 	{
	header('Location:index.php');
}



?>