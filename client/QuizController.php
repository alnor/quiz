<?php

namespace client;

/**
 * class QuizController
 * 
 */


class QuizController
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/


	function index(){								
		print "Ok";
	}
	
	/**
	 * 
	 * Adding quiz
	 */
	
	function add(){								
		//$view = new View();
		//$view->
		echo <<<HTML
		<form method="post" id="formQuiz" action="/quiz/create">
			<input type="text" name="quiz[text]" />
			<div id="questionBox">
				Question #1: <input type="text" name="question[text]" />
				<select name="question[type]" />
					<option value="1">Simple</option>
					<option value="2">Multiply</option>
				</select>
				<br />
			</div>
			<a href="#" id="addQuestion">Add question</a>
			<input type="submit" value="add" />
		</form>
HTML;
		
	}
	
	function create(){								
		$form = \core\Registry::getRequest()->form();

		if ($form){
			$quizObj = new \core\quiz\ActiveQuiz($form["quiz"]["text"]);
			$quizObj->save($form);
			/*
			if ($form["question"]){
				foreach($form["question"] as $key=>$value){
					$question = new \core\Question($value["question"]);
					$quizObj->addQuestion($question);
				}
				$quizObj->save($form);
			}			*/	
		}
		
		
	
	}	
	
} // end of QuizController
?>
