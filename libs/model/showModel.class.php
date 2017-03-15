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
            	$id[$i] =explode(' ', $id[$i]);
                $sql = "UPDATE `votetable` SET `votenum`=`votenum`+".$id[$i][1]." WHERE `id` = '".$id[$i][0]."'";
               if(!$mysql->query($sql)){
               	return FALSE;
               };
            }
			echo 1;
			return TRUE;
		}
		function addNew(){
			require_once ("../config/connect.php");
			$name = $_POST['name'];
			$describetion = $_POST['describetion'];
			$update =$this->updateImg();
			$sql = "INSERT INTO `votetable`(`name`, `headimg`, `describetion`) VALUES ('".$name."','".$update."','".$describetion."')";
			if($mysql->query($sql)){
				echo "<script>alert('添加成功');window.location.href='../act.add.php'</script>";
				return true;
			}else{
				return false;
			}
		}
		function updateImg(){
			$img = $_FILES['file'];
			$name=$img['name'];
			$type = strtolower(substr($name,strrpos($name,'.')+1)); 
			$allow_type = array('jpg','jpeg','gif','png'); 
			if(!in_array($type, $allow_type)){
			  return ;
			}
			if(!is_uploaded_file($img['tmp_name'])){
 			 return ;
			}
			$upload_path = "headimg/".md5(uniqid(microtime(true),true)).".".$type; 
			if(move_uploaded_file($img['tmp_name'],"../".$upload_path)){
			  return $upload_path;
			}else{
 			  return false;
			}
		}
	}
	
	?>