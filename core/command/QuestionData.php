<?php

namespace core\command;

/**
 * class QuestionData
 * 
 */
class QuestionData extends \core\DataStrategy
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
	protected $db;	
	
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
	protected $required;		
	
  /**
   *  
   * @return 
   * @access public
   */
  public function __construct( $id=null ) {
    $this->db = \core\Registry::getConnection();
    
     if (!is_null($id)){
    	$this->id =$id;
    	$this->init();
    }    
  } // end of member function __construct

  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function save( $params ) {
    $query = "INSERT INTO questions SET text = ?, quiz_id=?, type=?, required=?";
    $this->db->execute( $query, array($params['text'], $params['quiz_id'], $params['type'], $params['required']) );
    return $this->db->getLastId();    
  } // end of member function save

  /**
   * 
   *
   * @param int id 

   * @return 
   * @access public
   */
  public function find( $params=array() ) {

  	$values = array();
  	$cond 	= array();
  	
  	$query = "SELECT * FROM questions";
  	
  	if (!empty($params)){
  		$query .= " WHERE ";
  		foreach($params as $key=>$value){
  			$cond[] = $key."=?";
  		}
  	}
	$query.= join(" AND ", $cond);
    
    return $this->db->execute( $query, array_values($params) );    	
  } // end of member function find

  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function update( $cond, $params ) {	
  	
  	$query = "UPDATE questions SET ";

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
		return $this->type;
	} // end of member function getType	

	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getRequired( ) {
		return $this->required;
	} // end of member function getType	
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function init( ) {
		$quiz = $this->find( array("id"=>$this->id) );
		foreach($quiz as $key=>$val){
			$this->text = $val["text"];
			$this->type = $val["type"];
			$this->required = $val["required"];
		}
	} // end of member function init
	
  /**
   * 
   *
   * @param int id 

   * @return 
   * @access public
   */
  public function delete( ) {
    $query = "DELETE FROM questions WHERE id=?";
    return $this->db->execute( $query, array($this->id) );  	
  } // end of member function delete	


} // end of QuestionData
?>
