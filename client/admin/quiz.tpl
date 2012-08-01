<h2>Active Quiz</h2>

<table cellpading="2" cellspacing="2" class="tbl" data-type="active">
	<tr>
		<th>Quiz name</th>
		<th>Quiz type</th>
		<th>Show results</th>	
		<th>Close</th>	
		<th>Delete</th>		
	</tr>
<?php 
	if (!empty($this->var["active"])) {
		foreach($this->var["active"] as $key=>$quiz){
			echo "<tr>";
			echo "<td class='but'>".$quiz["text"]."</td>";
			echo "<td>".$quiz["type"]."</td>";
			echo "<td><button id='showResultsQuiz' data-id='".$quiz["id"]."'>Show results</button></td>";
			echo "<td><button id='closeQuiz' data-id='".$quiz["id"]."'>Close quiz</button></td>";
			echo "<td><button id='deleteQuiz' data-id='".$quiz["id"]."'>Delete quiz</button></td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='5'>No data to show</td></tr>";
	}	
?>
</table>


<h2>Draft Quiz</h2>

<table cellpading="2" cellspacing="2" class="tbl" data-type="active">
	<tr>
		<th>Quiz name</th>
		<th>Quiz type</th>
		<th>Show results</th>	
		<th>Close</th>	
		<th>Delete</th>		
	</tr>
<?php 
	if (!empty($this->var["draft"])) {
		foreach($this->var["draft"] as $key=>$quiz){
			echo "<tr>";
			echo "<td class='but'>".$quiz["text"]."</td>";
			echo "<td>".$quiz["type"]."</td>";
			echo "<td><button id='showResultsQuiz' data-id='".$quiz["id"]."'>Show results</button></td>";
			echo "<td><button id='closeQuiz' data-id='".$quiz["id"]."'>Close quiz</button></td>";
			echo "<td><button id='deleteQuiz' data-id='".$quiz["id"]."'>Delete quiz</button></td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='5'>No data to show</td></tr>";
	}		
?>
</table>


<h2>Closed Quiz</h2>

<table cellpading="2" cellspacing="2" class="tbl" data-type="active">
	<tr>
		<th>Quiz name</th>
		<th>Quiz type</th>
		<th>Show results</th>	
		<th>Close</th>	
		<th>Delete</th>		
	</tr>
<?php 
	if (!empty($this->var["closed"])) {
		foreach($this->var["closed"] as $key=>$quiz){
			echo "<tr>";
			echo "<td class='but'>".$quiz["text"]."</td>";
			echo "<td>".$quiz["type"]."</td>";
			echo "<td><button id='showResultsQuiz' data-id='".$quiz["id"]."'>Show results</button></td>";
			echo "<td><button id='closeQuiz' data-id='".$quiz["id"]."'>Close quiz</button></td>";
			echo "<td><button id='deleteQuiz' data-id='".$quiz["id"]."'>Delete quiz</button></td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='5'>No data to show</td></tr>";
	}
?>
</table>
