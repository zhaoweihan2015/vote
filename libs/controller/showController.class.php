<?php
  /**
   * showController.class.php
   */
require_once ("../model/showModel.class.php");
require_once ("../view/showView.class.php");
if($type = $_POST['type']){
 switch ($type) {
 	case 'choose':
	 $model = new showModel();
	 $model ->chooseLike();
 		break;
 	case 'addNew':
	 $model = new showModel();
	 $model ->addNew();
 		break;
	case 'createGroup':
		$model = new showModel();
 		$model ->createGroup();
 		break;
	case 'getGroup':
		$model = new showModel();
		$view = new showView();
		$view -> showjson($model ->getGroup());
 		break;
 	default:
		break;
 }
 };
 if($type = $_GET['type']){
 	switch ($type) {
 		case 'delplayer':
 			
 			break;
 		
 		default:
 			
 			break;
 	}
 }
// echo $_POST['type'];
?>