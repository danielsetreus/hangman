<?php
	require 'Hangman/bootstrap.php';

	$hangman = Hangman\Hangman::getInstance();

	switch($_POST['action']) {

		case 'newGame':
			$hangman->newGame();
			break;
		default:
			// Nothing

	}

	header("Location: index.php");
	exit;
