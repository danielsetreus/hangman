<?php require "Hangman/bootstrap.php"; ?>
<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Hangman</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		
		<div class="main">
			<h1>Hangman</h1>
				
			<?php

				$hangman = Hangman\Hangman::getInstance();
				$hangman->showState();

			?>

		</div>

	</body>
</html>
