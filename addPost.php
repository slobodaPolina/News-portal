<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style_new.css?<?php echo filemtime("style_new.css"); ?>">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
	<title>Новостной портал</title>
</head>

<body>

	<?php include_once "block_menu.html"; ?>

	<div class="workspace">
			<div class="shell-white">
				<div class="action--header">Добавить новость</div>
				<div class="shell25">
						<form action="addPostAction.php" method="post">
							<div>
								<input autocomplete="off" type="text" placeholder="Введите заголовок" name="title" required>
								<textarea autocomplete="off" class="max" id="body" placeholder="Введите описание" name="body" required></textarea>
								<input class="other" type="submit" value="Отправить">
							</div>
						</form>
					</div>
				</div>
		</div>
</body>
