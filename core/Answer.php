<?php

namespace core;

/**
 * class Answer
 * 
 */
class Answer
{

	/** Aggregations: */

	/** Compositions: */
	var $m_;

	 /*** Attributes: ***/


	/**
	 * 
	 *
	 * @param string text 

	 * @param int id 

	 * @return 
	 * @access public
	 */
	public function __construct( $text = null,  $id = null ) {
		
		$this->driver = \core\Registry::getConnection();
		$this->db = new \core\data\AnswerData($this->driver);		
		
		if (!is_null($id)){
			$this->init($id);
		}
		
		if (!is_null($text)){
			$this->text = $text;
		}
	} // end of member function __construct


	/**
	 * 
	 *
	 * @param array $params 

	 * @return 
	 * @access public
	 */
	public function save( $params ) {
		$this->db->save($params);
		return $this->db->getLastId();
	} // end of member function save
	
	/**
	 * 
	 *
	 * @param int id 

	 * @return 
	 * @access private
	 */
	private function init( $id ) {
		$ans = $this->db->find($id);
		$this->id = $id;
		$this->text = $ans[0]["text"];
	} // end of member function init	


} // end of Answer
?>
