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
  abstract public function delete( );
  
  /**
   * 
   *
   * @param array params 

   * @return 
   * @access public
   */
  public function query( $query ) {
    return $this->db->execute( $query, array(  ) );
  } // end of member function query   


} // end of DataStrategy
?>
