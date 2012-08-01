<?php

namespace core\data;

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
    $query = "INSERT INTO questions SET text = ?, quiz_id=?, type=?, required=?";
    return $this->db->execute( $query, array($params['text'], $params['quiz_id'], $params['type'], $params['required']) );
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





} // end of QuestionData
?>
