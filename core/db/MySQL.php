<?php

namespace core\db;

/**
 * class MySQL
 * 
 */
class MySQL
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/
	
	/**
	 * 
	 * @access private
	 */
	private $db;	
	
	
	function __construct($db){
		$dsn 		= $db["driver"].":dbname=".$db["database"].";host=".$db["host"];
		$this->db 	= new \PDO($dsn, $db["login"], $db["password"]);
		$this->db->exec('SET NAMES utf8');		
	}


	function saveQuiz($param){	
		$query = "INSERT INTO quiz(text) VALUES(?)";
		return $this->execute( $query, array($param['text']) );
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
		
		return $stmt->fetchAll( \PDO::FETCH_ASSOC );
		
	} // end of member function execute		


	/**
	 * 
	 * Get last id
	 * @return 
	 * @access public
	 */
	public function getLastId( ) {
		
	} // end of member function getLastId	

} // end of MySQL
?>
