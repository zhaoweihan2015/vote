<?php
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
$upload_path = "headimg/"; 
if(move_uploaded_file($img['tmp_name'],$upload_path.md5(uniqid(microtime(true),true)).".".$type)){
  echo "Successfully!";
}else{
  echo "Failed!";
}
?>
<!-- function chechchos() {
                    var numberchoose = 0;
                    for (var i = 0; i < chooseinput.length; i++) {
                        chooseinput[i].onclick = function() {
                            if (this.checked) {
                                numberchoose++;
                            } else {
                                numberchoose--;
                            }
                            if (numberchoose >= 2) {
                                numberchoose--;
                                alert('error');
                                return false;
                            }
                        };
                    }
                }-->