<?php
	/**
	 * showModel.class.php
	 */
	class showModel {
		function chooseLike() {
            require_once ("../config/connect.php");
			$id = $_POST['id'];
            $id = explode(',',$id);
            for($i=0;$i<sizeof($id);$i++){
               $sql = "UPDATE `votetable` SET `votenum`=`votenum`+1 WHERE `id` = '".$id[$i]."'";
               if(!$mysql->query($sql)){
               	return FALSE;
               };
            }
			return TRUE;
		}
	}
	
	?>