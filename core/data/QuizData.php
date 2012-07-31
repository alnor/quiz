<?php

namespace core\data

/**
 * class QuizData
 * 
 */
class QuizData
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

  /**
   * 
   * @access private
   */
  private $db;


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
    $query = "INSERT INTO quiz SET text = '?')";
    return $this->db->execute( $query, array($param['text']) );
  } // end of member function save

  /**
   * 
   *
   * @param int id 

   * @return 
   * @access public
   */
  public function find( $id = null ) {
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





} // end of QuizData
?>
