<?php

namespace core\db;

/**
 * class MySQL
 * 
 */
class MySQL extends \core\DB
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
	 * @access private
	 */
	private $lastid;	
	
	
	function __construct($db){
		$dsn 		= $db["driver"].":dbname=".$db["database"].";host=".$db["host"];
		$this->db 	= new \PDO($dsn, $db["login"], $db["password"]);
		$this->db->exec('SET NAMES utf8');		
	}
	
	/**
	 * 
	 * Извлечение
	 * @return 
	 * @access public
	 */
	public function execute( $query, $values ) {

		try{
			
			$stmt = $this->db->prepare($query);
			$stmt->execute($values);
			
		} catch(PDOException $e) {
			
			echo $e->getMessage();
			
		}

		$result = $stmt->fetchAll( \PDO::FETCH_ASSOC );

		$this->lastid = $this->db->lastInsertId();
		
		return $result;
	} // end of member function execute		


	/**
	 * 
	 * Get last id
	 * @return 
	 * @access public
	 */
	public function getLastId( ) {
		if ($this->lastid){
			return $this->lastid;
		}
		
		return false;
	} // end of member function getLastId	

} // end of MySQL
?>
