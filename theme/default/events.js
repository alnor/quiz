$(function(){
	$('#addQuestion').live("click", function(event){
		var count = $(".questionBox").find(".questionSubBox").size()+1;
		$(".questionBox").append('<div class="questionSubBox">' +
		'Question #'+count+': <input type="text" name="question['+count+'][text]" /> ' +
		'<select name="question['+count+'][type]">' +
			'<option value="1">Simple</option>' +
			'<option value="2">Multiply</option>' +
		'</select> ' +
		'Required: '+
		'No <input type="radio" name="question['+count+'][required]" value="0" />'+
		'Yes <input type="radio" name="question['+count+'][required]" value="1" />'+
		'<div class="answerBox">' +
			'Answer #1: <input type="text" name="answer['+count+'][1][text]" /><br />	' +	
		'</div>' +
		'<button id="addAnswer">Add answer</button>' +
	'</div>');
		return false;
	});
	
	$("#addAnswer").live("click", function(event){
		var box = $(this).closest("div").find(".answerBox");
		var questCount = $(".questionBox").find(".questionSubBox").size();
		var count = box.find("input[type^=text]").size()+1;
		box.append('Answer #'+count+': <input type="text" name="answer['+questCount+']['+count+'][text]" /><br />');
		return false;
	});
	
	$("#formQuiz").bind("submit", function(event){
		$.ajax({
			url: "/admin/add",
			type: "POST",
			data: $(this).serialize(),
			success: function(html){  
			    $("#ajaxContext").html(html);  
			}  
		});
		
		return false;
	});
	
	$("#showResultsQuiz").live("click", function(event){
		
		var id=$(this).attr("data-id");
		var type=$(this).closest("table").attr("data-type");
		
		$.ajax({
			url: "/admin/result",
			type: "POST",
			data: {id: id, type: type},
			success: function(html){  
				$("#win").fadeIn();
			    $("#win_main").html(html);  
			}  
		});
	});	
	
	$("#closeBut").live("click", function(event){
		$("#win").fadeOut();	
	});	
		
	$("#closeQuiz").live("click", function(event){
		
		var id=$(this).attr("data-id");
		var type=$(this).closest("table").attr("data-type");
		
		$.ajax({
			url: "/admin/close",
			type: "POST",
			data: {id: id, type: type},
			success: function(html){  
			    $("#ajaxContext").html(html);  
			}  
		});
	});	
	
	$("#deleteQuiz").live("click", function(event){
		
		var id=$(this).attr("data-id");
		var type=$(this).closest("table").attr("data-type");
		
		$.ajax({
			url: "/admin/delete",
			type: "POST",
			data: {id: id, type: type},
			success: function(html){  
			    $("#ajaxContext").html(html);  
			}  
		});
	});	
	
	$("#activateQuiz").live("click", function(event){
		
		var id=$(this).attr("data-id");
		var type=$(this).closest("table").attr("data-type");
		
		$.ajax({
			url: "/admin/activate",
			type: "POST",
			data: {id: id, type: type},
			success: function(html){  
			    $("#ajaxContext").html(html);  
			}  
		});
	});	
});