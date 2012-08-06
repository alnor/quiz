<?php

namespace core\command;

/**
 * class QuizData
 * 
 */

class StatData extends \core\DataStrategy
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/
	
	
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
    $query = "INSERT INTO stat SET user = ?, answer_id=?";
    $this->db->execute( $query, array($params['user'], $params['answer_id']) );

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
  	
  	$query = "SELECT * FROM stat";
  	
  	if (!empty($params)){
  		$query .= " WHERE ";
  		foreach($params as $key=>$value){
  			$cond[] = $key."=?";
  		}
  		$query.= join(" AND ", $cond);
  		$values = array_values($params);
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
  	
  	$query = "UPDATE stat SET ";

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
	    $query = "DELETE FROM stat WHERE id=?";
	    return $this->db->execute( $query, array($this->id) );  	
	  } // end of member function delete	
	
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
	public function getAnswerId( ) {
		return $this->answer_id;
	} // end of member function getAnswerId		
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function getUser( ) {
		return $this->user;
	} // end of member function getUser		
	
	
	/**
	 * 
	 * @return 
	 * @access public
	 */
	public function init( ) {
		$stat = $this->find( array("id"=>$this->id) );
		foreach($quiz as $key=>$val){
			$this->user = $val["user"];
			$this->answer_id = $val["answer_id"];
		}
	} // end of member function init		


} // end of QuizData
?>
