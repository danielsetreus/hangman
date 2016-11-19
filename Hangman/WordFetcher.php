<?php

	namespace Hangman;

	/**
	 * Fetches a word from the Words API
	 */
	class WordFetcher {

		private $apiUrl;
		private $apiKey;
		private $difficulty;

		/**
		 * Creates a new instance of the class with a given difficulty.
		 * @param string $difficulty Desired difficulty (easy, normal or hard)
		 */
		public function __construct($difficulty) {

			$this->apiUrl = "https://wordsapiv1.p.mashape.com/words/";
			$this->apiKey = "1uluTAFVyamshwzx4H2LKMOnoVpqp1fhphojsnYcnQ6il802it";
			$this->difficulty = $this->getDifficultyFrequency($difficulty);

		}

		/**
		 * Fetches a random 5 to 6 letter word from the Words API with the desired frequency rating.
		 * The word must also match [a-z] (no spaces in word)
		 * @return [type] [description]
		 */
		public function getRandomWord() {
			$word = $this->request(
				array(
					'letterPattern' => '^[a-z]*$',
					'lettersMin' => 5,
					'lettersMax' => 6,
					'random' => 'true',
					'frequencyMin' => $this->difficulty[0],
					'frequencyMax' => $this->difficulty[1],
				)
			);
			return $word->word;
		}

		/**
		 * Converts the difficulty string to a frequency rating
		 * @param  string $difficulty The difficulty
		 * @return array              Frequency (min x, max y)
		 */
		private function getDifficultyFrequency($difficulty) {
			switch($difficulty) {
				case 'easy':
					return array(7, 8);
				case 'medium':
					return array(6, 6);
				case 'hard':
					return array(4, 5);
			}
		}

		/**
		 * Performs the request to the Word API
		 * @param  array $inputs Word search parameters
		 * @return Object        Returned object
		 */
		private function request($inputs) {
			$queryVars = array('mashape-key' => $this->apiKey) + $inputs;
			$query = http_build_query($queryVars);
			
			$ch = curl_init($this->apiUrl . "?" . $query);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);

			$json = json_decode($response);
			return $json;
		}

	}
