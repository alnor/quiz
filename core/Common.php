<?php 
namespace core;

/**
 * class Common
 * 
 */
class Common
{
	
	/**
	 * 
	 * @static
	 * @access protected
	 */
	protected $view;
	
	
	/**
	 * 
	 * @access protected
	 */
	protected $form=array();

	
	/**
	 * 
	 * @access protected
	 */
	protected $error=array();		
		
	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function __construct( $view ) {
		$this->view = $view;
	} // end of member function __construct	
	
	/**
	 * 
	 * Перенаправляем запросы в View. 
	 * Любые действия в action, связанные с представлением, установкой шаблонов и других тегов - отлавливаются тут
	 * 
	 * @return 
	 * @access public
	 */
	public function __call( $method, $args=array() ) {
		if (!is_callable(array($this->view, $method))){
			throw new \Exception("No method error");
		}
				
		return call_user_func_array(array($this->view, $method), $args);
	} // end of member function __call	
	
	
	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function getView( ) {
		
		$action = \core\Registry::getParam("action");

		if (!is_callable(array($this, $action))){
			throw new \Exception("err");
		}	
		
		$this->menuMaker();
		$this->setTitle( "QuiZ: Driver" );
		$this->$action();

		return $this->view->render();
	} // end of member function getView	
		
	
	
	
	/**
	 * Результаты
	 * Страница отображения результатов.
	 * @access public
	 */
	
	function result(){			
		
		$qarr=array();

		if (empty($this->form)){
			$this->form = \core\Registry::getRequest()->form();
		}	
		
		if ($this->form){
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
			
			$questionObj = new \core\command\QuestionData();
			$questions = $questionObj->find(array("quiz_id"=>$quizObj->getId()));

			$ansObj = new \core\command\AnswerData();
			foreach($questions as $key=>$question){
				$qarr[] = array("question"=>$question, "answers"=>$ansObj->find(array("question_id"=>$question["id"])));
			}
			
			$result = array("quiz"=>$quizObj, "data"=>$qarr);
			
			$this->setBlankTheme();			
			$this->set("result", $result);
		}		
		
		return false;
	} // end of member function result		
	
}
?>