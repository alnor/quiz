<?php 
	echo "<h2>".$this->var["result"]["quiz"]->getText()."</h2>";
	echo "<hr />";
	foreach($this->var["result"]["data"] as $key=>$data){
		echo "<h3>".($key+1).") ".$data["question"]["text"]."</h3>";
		echo "<div class='wb_main'>";
		foreach($data["answers"] as $answer){
			
			$pro = ($answer["count"]*100)/$this->var["result"]["quiz"]->getCount();
			$width = (200*$pro)/100;
			
			echo "<div class='wb'>";
			echo "<div class='ansBlock'>".$answer["text"]."</div>";
			echo "<div class='dinamicWrapper'><div class='dinamic' style='width:".$width."px'></div></div> ";
			echo "<div class='statBlock'>".$answer["count"]." of ".$this->var["result"]["quiz"]->getCount()."</div>";
			echo "</div>";
		}
		echo "</div>";			
	}
?>