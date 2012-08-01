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
	foreach($this->var["active"] as $key=>$quiz){
		echo "<tr>";
		echo "<td class='but'>".$quiz["text"]."</td>";
		echo "<td>".$quiz["type"]."</td>";
		echo "<td><button id='showResultsQuiz' data-id='".$quiz["id"]."'>Show results</button></td>";
		echo "<td><button id='closeQuiz' data-id='".$quiz["id"]."'>Close quiz</button></td>";
		echo "<td><button id='deleteQuiz' data-id='".$quiz["id"]."'>Delete quiz</button></td>";
		echo "</tr>";
	}
?>
</table>