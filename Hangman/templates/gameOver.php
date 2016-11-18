<?php
	$hangman = Hangman\Hangman::getInstance();
?>
<h3>Game over :( The word was</h3>
<h3 class="tip"><?php echo $hangman->getWord();?></h3>

<?php
	$hangman->renderGameState();
	$hangman->render('startGameForm');
