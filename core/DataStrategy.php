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
   * @param int id 

   * @return 
   * @abstract
   * @access public
   */
  abstract public function find( $id = null );

  /**
   * 
   *
   * @param array params 

   * @return 
   * @abstract
   * @access public
   */
  abstract public function update( $params );

  /**
   * 
   *
   * @param int id 

   * @return 
   * @abstract
   * @access public
   */
  abstract public function delete( $id );





} // end of DataStrategy
?>
