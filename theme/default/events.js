$(function(){
	$('#addQuestion').bind("click", function(event){
		var count = $("#questionBox").find("input[type^=text]").size()+1;
		$("#questionBox").append('Question #'+count+': <input type="text" name="question['+count+'][text]" />'+
		'<select name="question['+count+'][type]">' +
			'<option value="1">Simple</option>' +
			'<option value="2">Multiply</option>' +
		'</select><br />');
	});
	
	$("#formQuiz").bind("submit", function(event){
		$.ajax({
			url: "/quiz/add",
			type: "POST",
			data: $(this).serialize(),
			success: function(html){  
			    $("#ajaxContext").html(html);  
			}  
		});
		
		return false;
	});
});