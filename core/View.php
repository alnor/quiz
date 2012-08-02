<?php

namespace core;

/**
 * class Smrt_View
 * 
 */
class View
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/

	/**
	 * 
	 * @access private
	 */
	private $var=array();
	
	/**
	 * 
	 * @access private
	 */
	private $tag=array();	

	/**
	 * 
	 * @access private
	 */
	private $tpl;
	
	/**
	 * 
	 * @access private
	 */
	private $defaultTpl;	
	
	/**
	 * 
	 * @access private
	 */
	private $currentController;	

	/**
	 * Результат обработки
	 * @access private
	 */
	private $view;
	
	
	/**
	 * Имя шаблона по умолчанию
	 * @access public
	 */
	public $themeName="index";
	
	/**
	 * Папка шаблона по умолчанию
	 * @access public
	 */
	public $themeFolder="default";	
	
	/**
	 * Содержимое шаблона по умолчанию
	 * @access public
	 */
	public $theme;	
	
	/**
	 * Имя плагина
	 * @access public
	 */
	private $moduleName;		

	/**
	 * 
	 *
	 * @return 
	 * @access public
	 */
	public function __construct( $tpl ) {
		
		//\core\Registry::setView( $this );
		$this->tpl	= $tpl;
		$this->defaultTemplate		= $tpl;	
		$this->setThemeTag();
	} // end of member function __construct


	/**
	 * Метод формирует представление.
	 * Метод использует все установленные теги, блок темы, вьюхи и возвращает готовое представление.
	 * 
	 * @param $action Если имеет значение, то шаблон вьюхи сменится на указанный
	 * @param $theme Если имеет значение, то шаблон темы сменится на указанный
	 * @param $block bool Если установлен в true, то после рендера - шаблон вьюхи вернется в исходное дефолтное состояние. Необходимо, когда рендер вызывается внутри рабочих методов, которым надо получить блок сторонней информации
	 * @return 
	 * @access public
	 */
	public function render( $action=false, $yieldTemplate=true ) {
		
		$this->loadTemplate();

		if (empty($this->theme)){
			$this->loadTheme();
		} 
		
		$output = str_replace('{content}', $this->view, $this->theme);	

		foreach($this->tag as $key=>$value){
			$output = str_replace($key, $value, $output);
		}
		
		if ($yieldTemplate){	
			$this->setDefaultTemplate();
		}			

		return $output;
	} // end of member function render
	
	/**
	 * 
	 * Загружаем шаблон для представления
	 * @return 
	 * @access public
	 */
	public function redirect( $path ) {
		header("Location: ".$path);	
	} // end of member function loadTemplate	

	/**
	 * 
	 * Загружаем шаблон для представления
	 * @return 
	 * @access public
	 */
	public function loadTemplate( ) {
		ob_start();
						
		if (!file_exists($this->tpl)){
			throw new \Exception($this->tpl);
		}
		
		require_once $this->tpl;
		
		$this->view =ob_get_contents();
		ob_end_clean();	
	} // end of member function loadTemplate

	
	/**
	 * 
	 * Загружаем внешний шаблон
	 * @return 
	 * @access public
	 */
	public function loadTheme( ) {
		ob_start();
		
		if (!file_exists(DOCUMENT_ROOT."/theme/".$this->themeFolder."/".$this->themeName.".tpl")){
			throw new \core\Smrt_Exception("No theme");
		}		
		
		require DOCUMENT_ROOT."/theme/".$this->themeFolder."/".$this->themeName.".tpl";
		
		$this->theme =ob_get_contents();
		ob_end_clean();	
	} // end of member function loadMainTemplate	
	
	/**
	 * 
	 * Устанавливает другой внешний шаблон для предаствления
	 * @return 
	 * @access public
	 */
	public function setTheme( $folder, $name=false ) {		
		
		if (!$folder){
			$this->theme="{content}";
			return;
		}
		
		$this->themeFolder 	= $folder;
		$this->themeName 	= $name;
		$this->setThemeTag();
	} // end of member function setTheme	
	
	/**
	 * 
	 * Устанавливает другой внешний шаблон для предаствления
	 * @return 
	 * @access public
	 */
	public function setBlankTheme( ) {
		$this->theme = "{content}";
	} // end of member function setTheme		
	
	/**
	 * 
	 * Возвращает шаблон по умолчанию (шаблон привязанный к вызову метода)
	 * @return 
	 * @access public
	 */
	public function setDefaultTemplate( ) {
		$this->tpl 	= $this->defaultTemplate;
	} // end of member function setDefaultTemplate	
		
	/**
	 * 
	 * Устанавливаем другой шаблон для представления
	 * @return 
	 * @access public
	 */
	public function setView( $tpl ) {
		$view = APP_PATH."/".(\core\Registry::getParam("controller"))."/".$tpl.".tpl";		
		$this->tpl = $view;
	} // end of member function setView
	
	/**
	 * 
	 * Устанавливает шаблон подключаемого модуля.
	 * если вызывать этот метод из метода модуля, то шаблон подхватится автоматически и будет использоваться
	 * как основной шаблон представления  для вызываемого экшна
	 * @return 
	 * @access public
	 */
	public function setModuleView( $tpl ) {
		$view = SMRT_DOCUMENT_ROOT."/modules/".$this->moduleName."/view/".$tpl.".tpl";		
		$this->tpl = $view;
	} // end of member function setPluginView	
	
	/**
	 * 
	 * Устанавливаем имя подгружаемого модуля
	 * @return 
	 * @access public
	 */
	public function setModuleName( $moduleName ) {	
		$this->moduleName = $moduleName;
		
	} // end of member function setPluginName		

	/**
	 * Устанавливаем title
	 * @return 
	 * @access public
	 */
	public function setTitle( $value ) {
		$this->tag['{title}'] = $value;
	} // end of member function set	
	
	/**
	 * Устанавливаем переменные 
	 * представления
	 * @return 
	 * @access public
	 */
	public function set( $key, $value ) {
		if (isset($this->var[$key])){
			$this->var[$key][] = $value;
			return;
		}
		$this->var[$key] = $value;
	} // end of member function set

	/**
	 * Устанавливаем таги 
	 * представления
	 * @return 
	 * @access public
	 */
	public function setTag( $key, $value ) {
		$this->tag[$key] = $value;
	} // end of member function set	

	/**
	 * Устанавливаем тег темы
	 * @return 
	 * @access public
	 */
	public function setThemeTag( ) {
		$this->tag["{theme}"] = "/theme/".$this->themeFolder;
	} // end of member function set	
	
	/**
	 * Устанавливает вспомогательные визуальные элементы
	 * Элементы вставляются в шаблоны с помощью конструкции [element=*]
	 * @return 
	 * @access public
	 */
	public function getElement( $element ) {
		ob_start();

		if (!file_exists(SMRT_DOCUMENT_ROOT."/theme/".$this->themeFolder."/elements/".$element.".tpl")){
			throw new \core\Smrt_Exception("No element");
		}		
		
		require_once SMRT_DOCUMENT_ROOT."/theme/".$this->themeFolder."/elements/".$element.".tpl";
		
		$ret =ob_get_contents();
		ob_end_clean();	
		
		return $ret;
	} // end of member function getElement


} // end of Smrt_View
?>
