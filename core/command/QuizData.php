<?php

namespace core\command;

/**
 * class QuizData
 * 
 */

abstract class QuizData extends \core\DataStrategy
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/


	/**
	 * 
	 * @access protected
	 */
	protected $type;	
	
	/**
	 * 
	 * @access protected
	 */
	protected $id;	
	
	/**
	 * 
	 * @access protected
	 */
	protected $text;
	
	/**
	 * 
	 * @access protected
	 */
	protected $count;	


  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function save( $params ) {
    $query = "INSERT INTO quiz SET text = ?, type=?";
    $this->db->execute( $query, array($params['text'], $this->type) );

    $this->id = $this->db->getLastId();
    $this->init();

  } // end of member function save

  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function find( $params=array() ) {
  	
  	$cond 	= array();
  	
  	$query = "SELECT * FROM quiz";
  	
  	if (!empty($params)){
  		$query .= " WHERE ";
  		foreach($params as $key=>$value){
  			$cond[] = $key."=?";
  		}
  		$query.= join(" AND ", $cond);
  		$values = array_values($params);
  	} else {
  		$query .= " WHERE type=? ";
  		$values = array($this->type);
  	}
	
    return $this->db->execute( $query, $values );  	
  } // end of member function find

  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function update( $cond, $params ) {	
  	
  	$query = "UPDATE quiz SET ";

    if (!empty($params)){
    	$conditions = array();
  		foreach($params as $key=>$value){
  			$conditions[] = $key."=?";
  		}
  		$query.= join(", ", $conditions);
  		$values = array_values($params);
  	}    	
  	
    if (!empty($cond)){
  		$query .= " WHERE ";
  		$conditions = array();
  		foreach($cond as $key=>$value){
  			$conditions[] = $key."=?";
  		}
  		$query.= join(" AND ", $conditions);
  		$values = array_merge($values, array_values($cond));
  	}  	

  	return $this->db->execute( $query, $values ); 
  } // end of member function update

	  /**
	   * 
	   * @return 
	   * @access public
	   */
	  public function delete( ) {
	    $query = "DELETE FROM quiz WHERE id=?";
	    return $this->db->execute( $query, array($this->id) );  	
	  } // end of member function delete


	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getQuiz( ) {
		return $this->find( array("type"=>$this->type) );
	} // end of member function deleteQuestion	
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getId( ) {
		return $this->id;
	} // end of member function getId		
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getText( ) {
		return $this->text;
	} // end of member function getText		
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getType( ) {
		switch ($this->type){
			case 1:
				return "active";
				break;
			case 2:
				return "draft";
				break;
			case 3:
				return "closed";
				break;								
		}
	} // end of member function getType		
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getCount( ) {
		return $this->count;
	} // end of member function getCount	
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function init( ) {
		$quiz = $this->find( array("id"=>$this->id) );
		foreach($quiz as $key=>$val){
			$this->text = $val["text"];
			$this->count = $val["count"];
		}
	} // end of member function init		


} // end of QuizData
?>
