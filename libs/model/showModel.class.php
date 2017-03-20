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
				$this->sqlQuery($mysql,$sql,"","");
            }
			print_r($id);
			return TRUE;
		}
		function addNew(){
			require_once ("../config/connect.php");
			$name = $_POST['name'];
			$gid = $_POST['gid'];
			$describetion = $_POST['describetion'];
			$update =$this->updateImg();
			$sql = "INSERT INTO `votetable`(`name`, `headimg`, `describetion`,`gid`) VALUES ('".$name."','".$update."','".$describetion."','".$gid."')";
           $this->sqlQuery($mysql, $sql, "添加成功", "../act.add.php");
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
		function createGroup(){
			require_once ("../config/connect.php");
			$name = $_POST['name'];
			$sql = "INSERT INTO `groupid`(`name`) VALUES ('".$name."')";
			if($this->sqlQuery($mysql, $sql,"","")){
        			echo TRUE;
			};
		}
		function getGroup(){
			require_once ("../config/connect.php");
			$sql = "SELECT * FROM `groupid`";
			$res = $mysql->query($sql);
			$data = array();
			while($row = $res->fetch_assoc()){
				array_push($data, $row);
			}
			return $data;
		}
		function sqlQuery($mysql,$sql,$word,$address){
			if(!$mysql->query($sql)){
				echo 0;
				return FALSE;
			}else if($word != ""){
				echo "<script>alert('".$word."');window.location.href='".$address."'</script>";
				return TRUE;
			}else{
				return TRUE;
			}
		}
	}
	
	?>