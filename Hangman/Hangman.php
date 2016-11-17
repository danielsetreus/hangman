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

		}

		public static function getInstance() {
			if(!isset(self::$instance))
				self::$instance = new Hangman();
			return self::$instance;
		}

		public function showState() {

			//include dirname(__FILE__) . "/templates/" . $this->state . ".php";
			$this->render($this->state);

		}

		public function renderGameState() {

			$this->render('hangmanState');

		}

		private function render($file) {

			include dirname(__FILE__) . "/templates/" . $file . ".php";

		}

		public function newGame() {
			
			$wordFetcher = new WordFetcher();
			$word = $wordFetcher->getRandomWord(6);
			if($this->stateSession)
				unset($_SESSION['hangman']);

			$_SESSION['hangman'] = array('word' => $word, 'tries' => 0, 'guesses' => array());
			
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

		public function guess($letter) {

			if(!in_array($letter, $_SESSION['hangman']['guesses'])) {
				$_SESSION['hangman']['guesses'][] = $letter;
				$_SESSION['hangman']['tries'] ++;
			}

		}

		private function getState() {
			if(!$this->stateSession)
				return 'start';

			if($this->gameIsWon())
				return 'won';
			elseif($this->stateSession['tries'] <= 6)
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
