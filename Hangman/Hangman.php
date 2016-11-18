<?php

	namespace Hangman;

	session_start();	

	class Hangman {

		private $state;
		private $stateSession;
		private static $instance;
		public function __construct() {
			
			$this->stateSession = isset($_SESSION['hangman']) ? $_SESSION['hangman'] : false;
			$this->state = $this->getState();
			$this->hungedmanStates = require('hungstates.php');

		}

		public static function getInstance() {
			if(!isset(self::$instance))
				self::$instance = new Hangman();
			return self::$instance;
		}

		public function showState() {

			$this->render($this->state);

		}

		public function renderGameState() {

			$this->render('hangmanState');

		}

		public function render($file) {

			include dirname(__FILE__) . "/templates/" . $file . ".php";

		}

		public function newGame($difficulty) {
			
			$wordFetcher = new WordFetcher($difficulty);
			$word = strtolower($wordFetcher->getRandomWord());
			if($this->stateSession)
				unset($_SESSION['hangman']);

			$_SESSION['hangman'] = array('word' => $word, 'incorrectTries' => 0, 'guesses' => array());
			
		}

		public function getWordStatus() {
			$letters = str_split($this->stateSession['word']);
			$re = array();
			foreach($letters as $letter) {
				if(in_array($letter, $this->stateSession['guesses']))
					$re[] = $letter;
				else 
					$re[] = '_';
			}
			return $re;
		}

		public function getHungedManImage() {
			return $this->hungedmanStates[$this->stateSession['incorrectTries']];
		}

		public function guess($letter) {
			if(strlen($letter) !== 1) return;

			if(!in_array(strtolower($letter), $this->stateSession['guesses'])) {
				$_SESSION['hangman']['guesses'][] = $letter;
				if(!$this->guessIsCorrect(strtolower($letter)))
					$_SESSION['hangman']['incorrectTries'] ++;
			}
			
		}

		public function getWord() {
			return $this->stateSession['word'];
		}

		public function getIncorrectTries() {
			return $this->stateSession['incorrectTries'];
		}

		public function getGuesses() {
			return $this->stateSession['guesses'];
		}

		private function guessIsCorrect($guess) {
			$letters = str_split($this->stateSession['word']);
			return in_array($guess, $letters);
		}

		private function getState() {
			if(!$this->stateSession)
				return 'start';

			if($this->gameIsWon())
				return 'won';
			elseif($this->stateSession['incorrectTries'] <= 8)
				return 'game';
			else
				return 'gameOver';
		}

		private function gameIsWon() {
			$letters = str_split($this->stateSession['word']);
			$compare = array_intersect($letters, $this->stateSession['guesses']);
			if(count($compare) === count($letters))
				return true;
			return false;
		}

	}
