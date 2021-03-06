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
				if (html.search('<div class="error">')!=-1){
					$("#ajaxContext").html(html);
				} else {
					$("#ajaxContext").html("<div class='message'>Quiz successfully created!</div>").fader(); 
					$(".content").html(html);
				}
			      
			}  
		});
		
		return false;
	});
	
	$("#quizUpd").bind("submit", function(event){
		$.ajax({
			url: "/main/make",
			type: "POST",
			data: $(this).serialize(),
			success: function(html){  
				if (html.search('<div class="error">')!=-1){
					$("#ajaxContext").html(html);
				} else {
					$("#ajaxContext").empty();
					$(".content").html(html);
				}
			      
			}  
		});
		
		return false;
	});	
	
	$("#quizEdit").live("submit", function(event){
		$.ajax({
			url: "/admin/doEdit",
			type: "POST",
			data: $(this).serialize(),
			success: function(html){  
				if (html.search('<div class="error">')!=-1){
					$("#ajaxContext").html(html);
				} else {
					$("#ajaxContext").html("<div class='message'>Quiz successfully updated!</div>").fader(); 
					$(".content").html(html);
				}
			      
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
				//$("#win").fadeIn();
			    $(".content").html(html);  
			}  
		});
	});	
	
	$("#filterResults").live("submit", function(event){
		
		$.ajax({
			url: "/admin/filter",
			type: "POST",
			data: $(this).serialize(),
			success: function(html){  
				if (html.search('<div class="error">')!=-1){
					$("#ajaxContext").html(html);
				} else { 
					$(".content").html(html);
				} 
			}  
		});
		
		return false;
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
			    $("#ajaxContext").html("<div class='message'>Quiz successfully closed!</div>").fader(); 
			    $(".content").html(html);
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
			    $("#ajaxContext").html("<div class='message'>Quiz successfully deleted!</div>").fader();   
			    $(".content").html(html); 
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
			    $("#ajaxContext").html("<div class='message'>Quiz successfully activated!</div>").fader();  
			    $(".content").html(html);
			}  
		});
	});	
	
	$("#editQuiz").live("click", function(event){
		
		var id=$(this).attr("data-id");
		var type=$(this).closest("table").attr("data-type");
		
		$.ajax({
			url: "/admin/edit",
			type: "POST",
			data: {id: id, type: type},
			success: function(html){   
			    $(".content").html(html);
			}  
		});
	});	
});

$.fn.fader = function(){
	return $(this).fadeOut(4000, function(){$(this).empty().show()});
}