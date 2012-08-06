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
				$request->setParam("controller", "main");
			}
			
			if (is_null($request->getParam("action"))){
				$request->setParam("action", "index");
			}
			
			$class = "\\client\\".$request->getParam("controller")."Controller";
			
			$filepath = APP_PATH."/".ucfirst($request->getParam("controller"))."Controller.php";
			
			if (!file_exists($filepath)){
				throw new \Exception("error path");
			}

			require_once($filepath);

			if (!class_exists($class)){
				throw new \Exception("error class");
			}
			
			$action = $request->getParam("action");
			
			$tpl = APP_PATH."/".$request->getParam("controller")."/".$action.".tpl";
			$view = new \core\View( $tpl );
			
			$this->controller = new $class( $view );
			
			print($this->invoke());
			
		}catch(\Exception $e){

		}
	} // end of member function dispatch


	/**
	 * Представление
	 * Получим результат обработки запроса для вывода на экран. 
	 * @return 
	 * @access private
	 */
	private function invoke( ) {
		return $this->controller->getView();
	} // end of member function invoke	


} // end of AppController
?>

