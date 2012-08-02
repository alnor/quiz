<?php 
	echo "<h2>".$this->var["result"]["quiz"]["text"]."</h2>";
	echo "<form method='post'>";
	echo "<hr />";
	foreach($this->var["result"]["data"] as $key=>$data){
		echo "<h3>".($key+1).") ".$data["question"]["text"]."</h3><br />";
		echo "<div class='wb_main'>";
		foreach($data["answers"] as $answer){
			
			echo "<div class='wb'>";
						
			switch($data["question"]["type"]){
				case 1:
					echo "<div class='ansBlock'><input type='radio' name='ans[".$data["question"]["id"]."]' value='".$answer["id"]."'></div>";
					break;
				case 2:
					echo "<div class='ansBlock'><input type='chekbox' name='ans[".$data["question"]["id"]."]' value='".$answer["id"]."'></div>";
					break;					
			}
			
			echo "<div class='ansBlock'>".$answer["text"]."</div>";
			echo "</div>";
		}
		echo "</div>";			
	}
	echo "<input type='submit' value='Done' />";
	echo "</form>";
?>