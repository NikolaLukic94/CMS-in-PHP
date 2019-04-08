<?php

include_once('includes/connection.php');
include_once('includes/article.php');

$article = new Article;
$articles = $article->fetch_all();

echo md5('')

?>

<!DOCTYPE html>
<html>
<head>
	<title>CMS App</title>
	<link rel="stylesheet" type="assets/style.css" href="">
</head>
<body>
	<div class="container">
		<a href="index.php" id="logo">CMS</a>
		<ol>
			<?php  foreach ($articles as $article) {	?>
				<li>
					<a href="article.php?id=<?php echo $article['article_id']; ?>"><?php echo $article['article_title']; ?></a> - 
					<small>
						posted <?php echo date('l jS', $article['article_timestamp']); ?>
					</small>
				</li>
			<?php } ?>	
		</ol>
		<br>
		<small><a href="admin">Admin</a></small>
	</div>
</body>
</html>