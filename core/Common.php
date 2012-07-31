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
			throw new \smrt\core\QuizException("No method error");
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
			throw new \core\QuizException("err");
		}	
		
		$this->$action();

		return $this->view->render();
	} // end of member function getView	
	
}
?>