<?php include_once 'posts.php'; ?>

<!DOCTYPE html>
<meta charset="utf-8">
<head>
<link rel="stylesheet" type="text/css" href="style_new.css?<?php echo filemtime("style_new.css"); ?>">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<title>Новостной портал</title>
</head>

<body>
	<?php include_once "block_menu.html"; ?>

	<div class="workspace">
		<div class="page--header">Новости</div>
			<?php printAllPosts(); ?>
	</div>
</body>
