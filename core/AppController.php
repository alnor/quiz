<?php

namespace core;

/**
 * class AppController
 * 
 */
class AppController
{

	/** Aggregations: */

	/** Compositions: */
	var $m_;

	 /*** Attributes: ***/

	/**
	 * 
	 * @access private
	 */
	private $controller;

	/**
	 * 
	 * @static
	 * @access private
	 */
	private static $instance;


	/**
	 * 
	 *
	 * @return 
	 * @access private
	 */
	private function __construct( ) {
	} // end of member function __construct

	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function init( ) {
	} // end of member function init


	/**
	 * Синглтон
	 * Обеспечиваем единственность экземпляра
	 * @return 
	 * @static
	 * @access public
	 */
	public static function getInstance( ) {
		if (!self::$instance) {
			self::$instance = new self();
		}
		
		return self::$instance;
	} // end of member function getInstance

	/**
	 * Точка входа
	 * Разбираем параметры, создаем необходимые экземпляры запроса и тд
	 * @return 
	 * @access public
	 */
	public function dispatch( ) {
		try{
			$request = new \core\Request();
			
			if (is_null($request->getParam("controller"))){
				$request->setParam("controller", "quiz");
			}
			
			if (is_null($request->getParam("action"))){
				$request->setParam("action", "index");
			}
			
			$class = "\\client\\".$request->getParam("controller")."Controller";
			
			$filepath = APP_PATH."/".ucfirst($request->getParam("controller"))."Controller.php";
			
			if (!file_exists($filepath)){
				throw new \core\QuizException("error path");
			}
			
			require_once($filepath);
			
			if (!class_exists($class)){
				throw new \core\QuizException("error class");
			}
			
			$this->controller = new $class();
			$action = $request->getParam("action");
			//SMRT_APP_PATH."/views/".$controller."/".$action.".tpl";

			print($this->controller->$action());
			
		}catch(\core\QuizException $e){

		}
	} // end of member function dispatch


	/**
	 * Представление
	 * Получем результат обработки запроса для вывода на экран. 
	 * @return 
	 * @access private
	 */
	private function invoke( ) {
		return $this->controller->getView();
	} // end of member function invoke	


} // end of AppController
?>

