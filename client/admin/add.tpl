<form method="post" id="formQuiz">
	Quiz name: <input type="text" name="quiz[text]" />
	<div class="questionBox">
		<div class="questionSubBox">
			Question #1: <input type="text" name="question[1][text]" />
			<select name="question[1][type]" />
				<option value="1">Simple</option>
				<option value="2">Multiply</option>
			</select>
			Required: 
			No <input type="radio" name="question[1][required]" value="0" />
			Yes <input type="radio" name="question[1][required]" value="1" />
			<div class="answerBox">
				Answer #1: <input type="text" name="answer[1][1][text]" />	<br />	
			</div>
			<button id="addAnswer">Add answer</button>
		</div>
	</div>
	
	<div class="buttonPlace">
		<button id="addQuestion">Add question</button>
		<input type="submit" value="Save quiz" />
	</div>
</form>