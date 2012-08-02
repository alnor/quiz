<?php

namespace core;

/**
 * class DataStrategy
 * 
 */
abstract class DataStrategy
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
   * @param array params 

   * @return 
   * @abstract
   * @access public
   */
  abstract public function save( $params );

  /**
   * 
   *
   * @param array params 

   * @return 
   * @abstract
   * @access public
   */
  abstract public function find( $params=array() );

  /**
   * 
   *
   * @param array params 

   * @return 
   * @abstract
   * @access public
   */
  abstract public function update( $cond, $params );

  /**
   * 
   *
   * @param int id 

   * @return 
   * @abstract
   * @access public
   */
  abstract public function delete( $id );


  /**
   * 
   * @return 
   * @access public
   */
  public function getLastId( ) {
    return $this->db->getLastId( );
  } // end of member function getLastId


} // end of DataStrategy
?>
