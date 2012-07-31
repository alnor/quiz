require_once 'MySQL.php';
require_once 'DataStrategy.php';
require_once 'DB.php';


/**
 * class QuestionData
 * 
 */
class QuestionData extends MySQL  //WARNING: PHP5 does not support multiple inheritance but there is more than 1 superclass defined in your UML model!
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





} // end of QuestionData
?>
