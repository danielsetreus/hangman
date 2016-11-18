<form action="formHandler.php" method="post" class="gameStarter">
	<input type="hidden" name="action" value="newGame">

	<h3>Difficulty</h3>
	<div class="difficultySelect">
		<div class="difficulty">
			<div class="diffLabel"><label for="easy">Easy</label></div>
			<input type="radio" name="difficulty" value="easy" id="easy">
			<span class="diffDesc">3-4 letters, only nouns</span>
		</div>

		<div class="difficulty">
			<div class="diffLabel"><label for="medium">Medium</label></div>
			<input type="radio" name="difficulty" value="medium" id="medium" checked>
			<span class="diffDesc">5-6 letters, only nouns</span>
		</div>

		<div class="difficulty">
			<div class="diffLabel"><label for="hard">Hard</label></div>
			<input type="radio" name="difficulty" value="hard" id="hard">
			<span class="diffDesc">6-8 letters</span>
		</div>
	</div>
	<button id="startHangman" class="startHangman">Start new game!</button>
</form>
