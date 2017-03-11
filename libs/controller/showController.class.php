<?php
  /**
   * showController.class.php
   */
require_once ("../model/showModel.class.php");
$type = $_POST['type'];
 switch ($type) {
 	case 'choose':
	 $model = new showModel();
	 $model ->chooseLike();
 		break;
 	
 	default:
 		
 		break;
 }
?>