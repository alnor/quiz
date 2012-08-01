<?php

namespace client;

/**
 * class MainController
 * 
 */


class MainController extends \core\Common
{

	/** Aggregations: */

	/** Compositions: */

	 /*** Attributes: ***/
	
	/**
	 * 
	 * @access private
	 */
	private $error=array();	


	function startQuiz(){								
		$activeQuizObj = new \core\quiz\ActiveQuiz();
		$activeQuiz = $activeQuizObj->getQuiz();
	}

	
} // end of MainController
?>
