<?php

namespace core\data;

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
  protected $db;


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
    $query = "INSERT INTO answers SET text = ?, question_id=?";
    return $this->db->execute( $query, array( $params['text'], $params['question_id'] ) );
  } // end of member function save

  /**
   * 
   *
   * @param int id 

   * @return 
   * @access public
   */
  public function find( $type, $id = null ) {
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
  } // end of member function delete



} // end of AnswerData
?>
