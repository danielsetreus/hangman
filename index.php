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
		<script src="/js/vendor/modernizr-2.8.3.min.js"></script>
	</head>
	<body>
		
		<div class="main">
			<h1>Hangman</h1>
				
			<?php

				$hangman = Hangman\Hangman::getInstance();
				$hangman->showState();

			?>

		</div>




		<script src="/js/vendor/jquery-1.12.0.min.js"></script>

		<script src="js/hangman.js"></script>

	</body>
</html>
