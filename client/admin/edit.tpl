<form method="post" id="quizEdit">
	<input type="hidden" name="quiz[id]" value="<?php echo $this->var["result"]["quiz"]->getId(); ?>" />
	<input type="hidden" name="quiz[type]" value="<?php echo $this->var["type"]; ?>" />
	<div class="quizBox">
		<h3>Quiz name:</h3> <input type="text" name="quiz[text]" value="<?php echo $this->var["result"]["quiz"]->getText(); ?>" class="qn"/>
	</div>
	<div class="questionBox">
		
		<?php foreach ($this->var["result"]["data"] as $key=>$data) { ?>
			<input type="hidden" name="question[<?php echo $key+1; ?>][id]" value="<?php echo $data["question"]["id"]; ?>" />
			<div class="questionSubBox">
				Question #<?php echo $key+1; ?>: <input type="text" name="question[<?php echo $key+1; ?>][text]" value="<?php echo $data["question"]["text"]; ?>" />
				<select name="question[<?php echo $key+1; ?>][type]" >
					<option value="1" <?php echo ($data["question"]["type"]==1) ? "selected" : ""; ?>>Simple</option>
					<option value="2" <?php echo ($data["question"]["type"]==2) ? "selected" : ""; ?>>Multiply</option>
				</select>
				Required: 
				No <input type="radio" name="question[<?php echo $key+1; ?>][required]" value="0" <?php echo (!$data["question"]["required"]) ? "checked" : ""; ?> />
				Yes <input type="radio" name="question[<?php echo $key+1; ?>][required]" value="1" <?php echo $data["question"]["required"] ? "checked" : ""; ?> />
				<div class="answerBox">
					<?php foreach ($data["answers"] as $k=>$answer) { ?>
						<input type="hidden" name="answer[<?php echo $key+1; ?>][<?php echo $k+1; ?>][id]" value="<?php echo $answer["id"]; ?>" />
						Answer #<?php echo $k+1; ?>: <input type="text" name="answer[<?php echo $key+1; ?>][<?php echo $k+1; ?>][text]" value="<?php echo $answer["text"]; ?>" />	<br />
					<?php } ?>	
				</div>
				<button id="addAnswer">Add answer</button>
			</div>
		<?php } ?>
	</div>
	
	<div class="buttonPlace">
		<button id="addQuestion">Add question</button>
		<input type="submit" value="Edit quiz" />
	</div>
</form>