<?php

	namespace Hangman;

	session_start();	

	/**
	 * Controls the Hangman game and all its states
	 */
	class Hangman {

		private $state;
		private $stateSession;
		private static $instance;
		
		/**
		 * Creates a new instance of Hangman and sets up some
		 * required class atributes.
		 */
		public function __construct() {
			
			$this->stateSession = isset($_SESSION['hangman']) ? $_SESSION['hangman'] : false;
			$this->state = $this->getState();
			$this->hungedmanStates = require('hungstates.php');

		}

		/**
		 * Returns the current game instance
		 * @return Hangman Self
		 */
		public static function getInstance() {
			if(!isset(self::$instance))
				self::$instance = new Hangman();
			return self::$instance;
		}

		/**
		 * Renders the page for the current game state page (newGame, game, gameOver, won)
		 * @return void
		 */
		public function showState() {

			$this->render($this->state);

		}

		/**
		 * Renders the main part of the game (stick fiigure and word status)
		 * @return void
		 */
		public function renderGameState() {

			$this->render('hangmanState');

		}

		/**
		 * Renders (includes) a template file $file
		 * @param  string $file Template to include
		 * @return void
		 */
		public function render($file) {

			include dirname(__FILE__) . "/templates/" . $file . ".php";

		}

		/**
		 * Sets up a new game by clearing the hangman session and fetches a new word
		 * @param  string $difficulty The difficulty for the new game
		 * @return void
		 */
		public function newGame($difficulty) {
			
			$wordFetcher = new WordFetcher($difficulty);
			$word = strtolower($wordFetcher->getRandomWord());
			if($this->stateSession)
				unset($_SESSION['hangman']);

			$_SESSION['hangman'] = array('word' => $word, 'incorrectTries' => 0, 'guesses' => array());
			
		}

		/**
		 * Returns array of equal length as the word in game, and fills any correct
		 * guesses in their correct position. Unknown letters are symbolised with a underscore.
		 * @return array Letters in the word
		 */
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

		/**
		 * Returns the stick figure image for for current number of incorrect tries
		 * @return string Hangman 'image'
		 */
		public function getHungedManImage() {
			return $this->hungedmanStates[$this->stateSession['incorrectTries']];
		}

		/**
		 * Performs a letter guess
		 * @param  string $letter A single letter to guess
		 * @return void
		 */
		public function guess($letter) {
			if(strlen($letter) !== 1) return;

			if(!in_array(strtolower($letter), $this->stateSession['guesses'])) {
				$_SESSION['hangman']['guesses'][] = $letter;
				if(!$this->guessIsCorrect(strtolower($letter)))
					$_SESSION['hangman']['incorrectTries'] ++;
			}
			
		}

		/**
		 * Returns the word in play
		 * @return string The word
		 */
		public function getWord() {
			return $this->stateSession['word'];
		}

		/**
		 * Returns the current number of incorrect tries
		 * @return integer Incorrect tries
		 */
		public function getIncorrectTries() {
			return $this->stateSession['incorrectTries'];
		}

		/**
		 * Returns the array of letters the player has guessed
		 * @return array Letters already guessed
		 */
		public function getGuesses() {
			return $this->stateSession['guesses'];
		}

		/**
		 * Checks if a (guessed) letter is in the word
		 * @param  string $guess Letter
		 * @return boolean       True on correct guess
		 */
		private function guessIsCorrect($guess) {
			$letters = str_split($this->stateSession['word']);
			return in_array($guess, $letters);
		}

		/**
		 * Returns the current state of the game, depending on conditions in the 
		 * game session.
		 * @return string Game state
		 */
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

		/**
		 * Checks if the game is won (all letters in the word have been guessed for)
		 * @return boolean True if won
		 */
		private function gameIsWon() {
			$letters = str_split($this->stateSession['word']);
			$compare = array_intersect($letters, $this->stateSession['guesses']);
			if(count($compare) === count($letters))
				return true;
			return false;
		}

	}
