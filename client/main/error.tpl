<div class="error">	
	<?php 
		if ($this->var["error"]){
			echo "You have some errors: <br />";
			echo "<ul>";
			foreach ($this->var["error"] as $key=>$val){
				echo "<li>".$val."</li>";
			}
			echo "</ul>";			
		}
	?>
</div>	