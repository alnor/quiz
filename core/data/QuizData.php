<?php

namespace core\data;

/**
 * class QuizData
 * 
 */

class QuizData extends \core\DataStrategy
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/


  /**
   * 
   *
   * @param DB driver 

   * @return 
   * @access public
   */
  public function __construct( $driver ) {
    $this->db = $driver;
  } // end of member function __construct

  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function save( $params ) {
    $query = "INSERT INTO quiz SET text = ?";
    return $this->db->execute( $query, array($params['text']) );
  } // end of member function save

  /**
   * 
   *
   * @param int id 

   * @return 
   * @access public
   */
  public function find( $type, $id = null ) {
  	
  	$values=array();
  	
  	$cond = "WHERE type=?";
  	$values[] = $type;
  	
  	if (!is_null($id)){
  		$cond .= " AND id=? ";
  		$values[]=$id;
  	}
    $query = "SELECT * FROM quiz ".$cond;
    return $this->db->execute( $query, $values );  	
  } // end of member function find

  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function update( $params ) {
  } // end of member function update

  /**
   * 
   *
   * @param int id 

   * @return 
   * @access public
   */
  public function delete( $id ) {
    $query = "DELETE FROM quiz WHERE id=?";
    return $this->db->execute( $query, array($id) );  	
  } // end of member function delete





} // end of QuizData
?>
