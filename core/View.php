<?php

namespace core;

/**
 * class View
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
	private $tpl;
	
	/**
	 * 
	 * @access private
	 */
	private $defaultTpl;	

	/**
	 * Результат обработки
	 * @access private
	 */
	private $view;
	
	
	/**
	 * Имя шаблона по умолчанию
	 * @access private
	 */
	private $themeName="index";
	
	/**
	 * Папка шаблона по умолчанию
	 * @access private
	 */
	private $themeFolder="default";	
	
	/**
	 * Содержимое шаблона по умолчанию
	 * @access private
	 */
	private $theme;		

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
			throw new \Exception("No theme");
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
	 * Устанавливаем тег темы
	 * @return 
	 * @access public
	 */
	public function setThemeTag( ) {
		$this->tag["{theme}"] = "/theme/".$this->themeFolder;
	} // end of member function setThemeTag	


} // end of View
?>
