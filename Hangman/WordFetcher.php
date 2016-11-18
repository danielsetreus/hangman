<?php

	namespace Hangman;

	class WordFetcher {

		private $apiUrl;
		private $apiKey;
		private $difficulty;

		public function __construct($difficulty) {

			$this->apiUrl = "https://wordsapiv1.p.mashape.com/words/";
			$this->apiKey = "1uluTAFVyamshwzx4H2LKMOnoVpqp1fhphojsnYcnQ6il802it";
			$this->difficulty = $this->getDifficultyFrequency($difficulty);

		}


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

		private function getDifficultyFrequency($difficulty) {
			switch($difficulty) {
				case 'easy':
					return array(7, 7);
				case 'medium':
					return array(6,7);
				case 'hard':
					return array(4,5);
			}
		}

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
