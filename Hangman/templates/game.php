<?php
	$hangman = Hangman\Hangman::getInstance();
?>
<code><pre><?php var_dump($_SESSION['hangman']); ?></pre></code>

<?php
	$hangman->renderGameState();
?>

<form action="formHandler.php" method="post">
	<p>
		Make a guess
	</p>
	<input type="text" name="guessedLetter" class="letterStatus" maxlength="1">
	<input type="submit" value="Guess">
	<input type="hidden" name="action" value="guess">
</form>
