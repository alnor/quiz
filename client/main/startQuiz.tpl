<?php 
	if ($this->var["has_active"]){

		echo "<h2>".$this->var["result"]["quiz"]["text"]."</h2>";
		echo "<form method='post' action='/main/make'>";
		echo "<input type='hidden' name='quiz' value='".$this->var["result"]["quiz"]["id"]."'>";
		echo "<hr />";
		foreach($this->var["result"]["data"] as $key=>$data){
			
			$required = "";
			
			if ($data["question"]["required"]){
				$required = "<span style='color:red'>*</span>";
			}
			
			echo "<h3>".$required." ".($key+1).") ".$data["question"]["text"]."</h3>";
			echo "<div class='wb_main'>";
			foreach($data["answers"] as $answer){
				
				echo "<div class='wb'>";
							
				switch($data["question"]["type"]){
					case 1:
						echo "<div class='inputBlock'><input type='radio' name='ans[".$data["question"]["id"]."]' value='".$answer["id"]."' /></div>";
						break;
					case 2:
						echo "<div class='inputBlock'><input type='checkbox' name='ans[".$data["question"]["id"]."]' value='".$answer["id"]."' /></div>";
						break;					
				}
				
				echo "<div class='ansBlock'>".$answer["text"]."</div>";
				echo "</div>";
			}
			echo "</div>";			
		}
		echo "<hr />";	
		echo "<input type='submit' value='Done' />";
		echo "</form>";
	} else {
		echo "<h3>No active quiz</h3>";
	}	
?>