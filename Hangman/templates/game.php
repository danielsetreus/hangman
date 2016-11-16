<?php
	$hangman = Hangman\Hangman::getInstance();
	$hangman->guess('a');
	$hangman->guess('b');
?>
<code><pre><?php var_dump($_SESSION['hangman']); ?></pre></code>

<p>
<code><pre>Printa gubben</pre></code>
</p>

<p>Formulär för att gissa</p>

<?php
	$wordStatus = $hangman->getWordStatus();
	foreach($wordStatus as $letter) {
		?>
			<input type="text" class="letterStatus" value="<?php echo $letter;?>" disabled>
		<?php
	}
?>
