<?php
	$hangman = Hangman\Hangman::getInstance();
?>


<div style="margin: auto; width: 140px">
	<code><pre>-------
 |/    | 
 |     o
 |
 |
 |
 | 
/|\
-------------</pre></code>
</div>

<div style="text-align: center">
<?php
	$wordStatus = $hangman->getWordStatus();
	foreach($wordStatus as $letter) {
		?>
			<input type="text" class="letterStatus" value="<?php echo $letter;?>" disabled>
		<?php
	}
?>
</div>
