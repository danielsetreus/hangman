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

			include dirname(__FILE__) . "/templates/" . $this->state . ".php";

		}

		public function newGame() {
			
			$wordFetcher = new WordFetcher();
			$word = $wordFetcher->getRandomWord(6);
			if($this->stateSession)
				unset($_SESSION['hangman']);

			$_SESSION['hangman'] = array('word' => $word, 'tries' => 0, 'guesses' => array());
			
		}

		public function getWordStatus() {
			$state = $_SESSION['hangman'];
			$letters = str_split($state['word']);
			$re = array();
			foreach($letters as $letter) {
				if(in_array($letter, $state['guesses']))
					$re[] = $letter;
				else 
					$re[] = '_';
			}
			return $re;
		}

		public function guess($letter) {

			if(!in_array($letter, $_SESSION['hangman']['guesses']))
				$_SESSION['hangman']['guesses'][] = $letter;

		}

		private function getState() {
			if(!$this->stateSession)
				return 'start';
			
			if($this->stateSession['tries'] <= 6)
				return 'game';
			else
				return 'gameOver';
		}

	}
