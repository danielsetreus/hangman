<form action="formHandler.php" method="post" class="makeGuessForm">
	<p>
		Make a guess
	</p>
	<input type="text" name="guessedLetter" class="letterStatus" maxlength="1" autofocus required>
	<input type="submit" value="Guess">
	<input type="hidden" name="action" value="guess">
</form>

<?php
	$hangman = Hangman\Hangman::getInstance();

	$hangman->renderGameState();
?>

