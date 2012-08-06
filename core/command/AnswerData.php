<?php

namespace core\command;

/**
 * class AnswerData
 * 
 */
class AnswerData extends \core\DataStrategy
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
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function save( $params ) {
    $query = "INSERT INTO answers SET text = ?, question_id=?";
    $this->db->execute( $query, array( $params['text'], $params['question_id'] ) );

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
  	
  	$values = array();
  	$cond 	= array();
  	
  	$query = "SELECT * FROM answers";
  	
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
  	
  	$query = "UPDATE answers SET ";

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
   *
   * @param int id 

   * @return 
   * @access public
   */
  public function delete( ) {
    $query = "DELETE FROM answers WHERE id=?";
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
	public function getText( ) {
		return $this->text;
	} // end of member function getText		
	
	
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
		$answers = $this->find( array("id"=>$this->id) );
		foreach($answers as $key=>$val){
			$this->text = $val["text"];
			$this->count = $val["count"];
		}
	} // end of member function init  



} // end of AnswerData
?>
