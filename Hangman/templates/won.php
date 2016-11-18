<?php
	$hangman = Hangman\Hangman::getInstance();
?>
<h3>Yhey! You made it!</h3>

<?php
	$hangman->renderGameState();

	$hangman->render('startGameForm');
?>



