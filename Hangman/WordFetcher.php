<?php

	namespace Hangman;

	class WordFetcher {

		private $apiUrl;
		private $apiKey;

		public function __construct() {

			$this->apiUrl = "https://wordsapiv1.p.mashape.com/words/";
			$this->apiKey = "1uluTAFVyamshwzx4H2LKMOnoVpqp1fhphojsnYcnQ6il802it";

		}

		public function getRandomWord($maxLen) {
			return $this->request(array(
				'lettersMax' => $maxLen,
				'random' => 'true',
			));
		}

		private function request($inputs) {
			$queryVars = array('mashape-key' => $this->apiKey) + $inputs;
			$query = http_build_query($queryVars);

			$ch = curl_init($this->apiUrl . "?" . $query);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);

			$json = json_decode($response);
			return $json->word;
		}

	}