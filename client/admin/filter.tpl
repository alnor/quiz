<?php
if ($this->var["filtered"]){
	echo "<h3>Фильтрация по следующим вопросам и ответам:</h3>"; 
	foreach($this->var["filtered"] as $key=>$filter){
		echo $key."<br />";
		foreach($filter as $k=>$ans){
			echo "Ответ: ".$ans."<br />";
		}
		echo "<br />";
	}
}
?>

<form method="post" id="filterResults">
<input type="hidden" name="quiz[id]" value="<?php echo $this->var["result"]["quiz"]->getId(); ?>" />
<input type="hidden" name="quiz[type]" value="<?php echo $this->var["result"]["quiz"]->getType(); ?>" />
<?php 
	echo "<h2>".$this->var["result"]["quiz"]->getText()."</h2>";
	echo "<hr />";
	foreach($this->var["result"]["data"] as $key=>$data){
		echo "<h3>".($key+1).") ".$data["question"]["text"]."</h3>";
		echo "<div class='wb_main'>";
		foreach($data["answers"] as $answer){
			
			$pro = ($answer["count"]*100)/$this->var["total"];
			$width = (200*$pro)/100;
			
			echo "<div class='wb'>";
			echo "<div class='inputBlock'><input type='checkbox' name='answer[]' value='".$answer["id"]."' /></div>";
			echo "<div class='ansBlock'>".$answer["text"]."</div>";
			echo "<div class='dinamicWrapper'><div class='dinamic' style='width:".$width."px'></div></div> ";
			echo "<div class='statBlock'>".$answer["count"]." of ".$this->var["total"]."</div>";
			echo "</div>";
		}
		echo "</div>";			
	}
?>
	<div class="buttonPlace">
		<input type="submit" value="Filter by selected" />
	</div>
</form>