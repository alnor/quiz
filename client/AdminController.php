<?php

namespace client;

/**
 * class AdminController
 * 
 */


class AdminController extends \core\Common
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/	
	
	function index(){
		echo 11;
	}
	
	/**
	 * Опросы
	 * Список опросов по группам
	 * @access public
	 */


	function quiz(){	
									
		$activeQuizObj = new \core\command\data\ActiveQuiz();
		$activeQuiz = $activeQuizObj->getQuiz();
		
		$draftQuizObj = new \core\command\data\DraftQuiz();
		$draftQuiz = $draftQuizObj->getQuiz();
		
		$closedQuizObj = new \core\command\data\ClosedQuiz();
		$closedQuiz = $closedQuizObj->getQuiz();

		if (!empty($activeQuiz)){
			$this->set("has_active", 1);
		} else {
			$this->set("has_active", 0);
		}

		$this->set("active", $activeQuiz);	
		$this->set("draft", $draftQuiz);	
		$this->set("closed", $closedQuiz);
		
	} // end of member function quiz	
	
	/**
	 * 
	 * Страница добавления опроса.
	 * @access public
	 */
	
	function add(){	

		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			
			$this->validateQuizFields( );		
			$this->validateQuestionFields( );		
			$this->validateAnswerFields( );		
			$this->validateRequiredCount( );			

			if (!empty($this->error)){
				$this->setView("error", false);
				$this->setBlankTheme();
				$this->set("error", $this->error);
				return;
			}	
			
			$quizObj = new \core\command\data\ActiveQuiz();
			$active_quiz = $quizObj->find();

			if (!empty($active_quiz)){
				$quizObj = new \core\command\data\DraftQuiz();
			}
			
			$quizid = $quizObj->save($this->form["quiz"]);

			foreach($this->form["question"] as $key=>$question){
				
				$question["quiz_id"] = $quizid;
				
				if (!$question["required"]){
					$question["required"]=0;
				}

				$questionObj = new \core\command\QuestionData();
				$questionid = $questionObj->save($question);

				foreach($this->form["answer"][$key] as $k=>$answer){
					$answer["question_id"] = $questionid;
					$answerObj = new \core\command\AnswerData();
					$answerid = $answerObj->save($answer);					
				}
			}
			
			$this->form["id"] = $quizid;
			$this->form["type"] = "active";
			$this->setView("result", false);
			$this->result();
		}			

	} // end of member function add	
	
	/**
	 * 
	 * Страница редактирования опроса, с вопросами и ответами
	 * @access public
	 */
	
	function edit(){
		
		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			$quizObj = new \core\command\data\DraftQuiz($this->form["id"]);
			
			$questionObj = new \core\command\QuestionData();
			$questions = $questionObj->find(array("quiz_id"=>$quizObj->getId()));

			$ansObj = new \core\command\AnswerData();
			foreach($questions as $key=>$question){
				$qarr[] = array("question"=>$question, "answers"=>$ansObj->find(array("question_id"=>$question["id"])));
			}
			
			$result = array("quiz"=>$quizObj, "data"=>$qarr);	

			$this->setBlankTheme();			
			$this->set("result", $result);		
			$this->set("type", $this->form["type"]);	
		}
	} // end of member function edit	
	
	/**
	 * Апдейт
	 * Процесс изменения данных опроса.
	 * @access public
	 */
	
	function doEdit(){
		
		$this->form = \core\Registry::getRequest()->form();
		
		if ($this->form){
			$this->validateQuizFields( );		
			$this->validateQuestionFields( );		
			$this->validateAnswerFields( );		
			$this->validateRequiredCount( );			

			if (!empty($this->error)){
				$this->setView("error", false);
				$this->setBlankTheme();
				$this->set("error", $this->error);
				return;
			}		

			switch($this->form["quiz"]["type"]){
				case "active":
					$quizObj = new \core\command\data\ActiveQuiz($this->form["id"]);
					break;
				case "draft":
					$quizObj = new \core\command\data\DraftQuiz($this->form["id"]);
					break;
				case "closed":
					$quizObj = new \core\command\data\ClosedQuiz($this->form["id"]);
					break;										
			}
			
			$quizObj->update(array("id"=>$this->form["quiz"]["id"]), array("text"=>$this->form["quiz"]["text"]));

			foreach($this->form["question"] as $key=>$question){
				
				$question["quiz_id"] = $quizid;
				
				if (!$question["required"]){
					$question["required"]=0;
				}

				$questionObj = new \core\command\QuestionData();
				$questionObj->update(array("id"=>$question["id"]), array("text"=>$question["text"], "type"=>$question["type"], "required"=>$question["required"]));

				foreach($this->form["answer"][$key] as $k=>$answer){
					$answerObj = new \core\command\AnswerData();
					$answerObj->update(array("id"=>$answer["id"]), array("text"=>$answer["text"]));					
				}
			}
			
			$this->setBlankTheme();
			$this->setView("quiz", false);
			$this->quiz();			
		}
	} // end of member function doEdit		

	
	/**
	 * 
	 * Процесс закрытия опроса.
	 * @access public
	 */
	
	function close(){
		
		$this->form = \core\Registry::getRequest()->form();
		
		switch($this->form["type"]){
			case "active":
				$quizObj = new \core\command\data\ActiveQuiz($this->form["id"]);
				break;
			case "draft":
				$quizObj = new \core\command\data\DraftQuiz($this->form["id"]);
				break;
			case "closed":
				$quizObj = new \core\command\data\ClosedQuiz($this->form["id"]);
				break;										
		}		

		$quizObj->update(array("id"=>$this->form["id"]), array("type"=>3));
		
		$this->setBlankTheme();	
		$this->setView("quiz", false);
		$this->quiz();
	} // end of member function close		
	
	/**
	 * 
	 * Процесс активации запроса.
	 * @access public
	 */
	
	function activate(){
		
		$this->form = \core\Registry::getRequest()->form();
		
		switch($this->form["type"]){
			case "active":
				$quizObj = new \core\command\data\ActiveQuiz($this->form["id"]);
				break;
			case "draft":
				$quizObj = new \core\command\data\DraftQuiz($this->form["id"]);
				break;
			case "closed":
				$quizObj = new \core\command\data\ClosedQuiz($this->form["id"]);
				break;										
		}		

		$quizObj->update(array("id"=>$this->form["id"]), array("type"=>1));
		
		$this->setBlankTheme();	
		$this->setView("quiz", false);
		$this->quiz();
	} // end of member function activate			
	
	/**
	 * 
	 * Процесс удаления запроса.
	 * @access public
	 */
	
	function delete(){
		$form = \core\Registry::getRequest()->form();	

		if ($form){
			switch($form["type"]){
				case "active":
					$quizObj = new \core\command\data\ActiveQuiz($form["id"]);
					$quizObj->delete();
					break;
				case "draft":
					$quizObj = new \core\command\data\DraftQuiz($form["id"]);
					$quizObj->delete();
					break;
				case "closed":
					$quizObj = new \core\command\data\ClosedQuiz($form["id"]);
					$quizObj->delete();
					break;										
			}
		}
		
		$this->setBlankTheme();	
		$this->setView("quiz", false);
		$this->quiz();

	} // end of member function delete	
	
	/**
	 * 
	 * Валидация полей опроса
	 * @access private
	 */
	
	private function validateQuizFields( ){
		if (!$this->form["quiz"]["text"]){
			$this->error[] = "Quiz name needed";
		}		
	} // end of member function validateQuizFields
	
	/**
	 * 
	 * Валидация полей вопросов
	 * @access private
	 */
	
	private function validateQuestionFields( ){
				
		foreach($this->form["question"] as $key=>$val){
			if (empty($val["text"])){
				unset($this->form["question"][$key]);
			}
		}

		if (empty($this->form["question"])){
			$this->error[] = "Question name needed";	
		}		
			
	} // end of member function validateQuestionFields	
	
	/**
	 * 
	 * Валидация полей ответов.
	 * @access private
	 */
	
	private function validateAnswerFields( ){
				
		foreach($this->form["question"] as $key=>$question){
			
			foreach($this->form["answer"][$key] as $k=>$answer){
				if (empty($answer["text"])){
					unset($this->form["answer"][$key][$k]);
				}
			}
			if (empty($this->form["answer"][$key]) || (count($this->form["answer"][$key])<2)){
				$this->error[] = "Question '".$question["text"]."' must have at least two answer";	
			}						
			
		}		
	} // end of member function validateAnswerFields	
	
	/**
	 * 
	 * Проверка на существование хотя бы одного обязательного вопроса.
	 * @access private
	 */
	
	private function validateRequiredCount( ){
		
		$requiredCount = 0;
		
		if (empty($this->form["question"])){
			return;
		}
		
		foreach($this->form["question"] as $key=>$question){
			if ($question["required"]){
				$requiredCount++;
			}
		}
		
		if ($requiredCount==0){
			$this->error[] = "In quiz must be at least 1 required question";	
		}		
	} // end of member function validateRequiredCount		
	
	
	/**
	 * 
	 * Создание меню в разделе.
	 * @access public
	 */
	public function menuMaker( ) {
		
		$menu = array(	array("title"=>"Main", "href"=>"/"),
						array("title"=>"Add quiz", "href"=>"/admin/add"),
						array("title"=>"Quiz list", "href"=>"/admin/quiz")
					);
					
		$this->set("menu", $menu);
		
	} // end of member function menuMaker	
					
} // end of AdminController
?>
