<?php
	$hangman = Hangman\Hangman::getInstance();
?>
<h4>Yhey! You made it!</h4>

<?php
	$hangman->renderGameState();
?>

<div class="gameStarter">
	<form action="formHandler.php" method="post">
		<input type="hidden" name="action" value="newGame">	
		<button id="startHangman" class="startHangman">Start new game!</button>
	</form>
</div>