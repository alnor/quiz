<form method="post" id="formQuiz">
	<input type="text" name="quiz[text]" />
	<div id="questionBox">
		Question #1: <input type="text" name="question[1][text]" />
		<select name="question[1][type]" />
			<option value="1">Simple</option>
			<option value="2">Multiply</option>
		</select>
		<br />
	</div>
	<a href="#" id="addQuestion">Add question</a>
	<input type="submit" value="add" />
</form>
