<?php
	$hangman = Hangman\Hangman::getInstance();
?>


<div class="hangmanImage">
	<code><pre><?php echo $hangman->getHungedManImage();?></pre></code>
</div>

<div class="gameStatus">
	<?php
		$wordStatus = $hangman->getWordStatus();
		foreach($wordStatus as $letter) {
			?>
				<input type="text" class="letterStatus" value="<?php echo $letter;?>" disabled>
			<?php
		}
	?>
	<h3>Previous guesses</h3>
	<p>
	<?php
		echo implode(', ', $hangman->getGuesses());
	?>
	</p>
</div>


