<?php
  require_once('config/connect.php');
  $sql = 'SELECT * FROM `votetable`';
  $sql2 = 'SELECT * FROM `groupid`';
  $res = $mysql ->query($sql);
  $res2 = $mysql ->query($sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	<script type="text/javascript" src="../js/jquery-3.1.0.min.js" ></script>
    <style>
        * {
            color: white;
            font-family: 'Mouse';
        }
        
        ul {
            list-style: none;
        }
        
        .addclass ul li {
            margin: 10px 0px;
        }
        
        .addclass ul li input,
        textarea {
            border: 2px white solid;
            background: black;
            border-radius: 5px;
        }
        
        #name {
            height: 25px;
            display: block;
            padding: 0px 5px;
            width: 275px;
        }
        
        #submit {
            height: 30px;
            width: 70px;
            display: block;
            padding: 5px;
        }
        
        body {
            background: black;
        }
        textarea {
            resize: none;
            height: 200px;
            width: 400px;
        }
        table{
            border:0;
            margin:10px
        }
        td{
            padding:2px;
        }
        .end{
            height:50px;
            width:100px;
            line-height:58px;
            margin-left:50px;
            margin-top:20px;
            text-align:center;
            background:red;
            font-size:36px;
            color:black;
        }
        .GroupList{
        	width: 100%;
        	float: left;
        	height: auto;
        	padding: 20px 0px;
        }
        .GroupList ul{
        	width: 600px;
        	float: left;
        }
        .GroupList ul li{
        	width: 150px;
        	height: 30px;
        	float: left;
        }
        .GroupList ul li a{
        	line-height: 30px;
        }
    </style>
</head>

<body>
    <div>
        ADD NEW PLAYER
    </div>
    <div class="addclass">
        <ul>
            <form action="controller/showController.class.php" method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="type" value="addNew">
                <li>
                    NAME:<br>
                    <input id="name" type="text" name="name" value="">
                </li>
                <li>
                    IMG:<br>
                    <input type="file" name="file" value=""><br />
                    图片最好为128X128（px），没有缩略图和裁剪系统，注意尺寸
                </li>
                <li>
                	GROUP: <br />
                	<input id="groupname" type="text" value="">
                	<input type="button" onclick="createGroup();" value="CREATE"/><br />
                		以下没有请在此创建<br />
                	<div class="GroupList">
                		<ul>
                			<!--grouplist添值-->
                		</ul>
                	</div>
                </li>
                <li>
                    DESCRIBE: <br>
                    <textarea name="describetion" rows="" cols=""></textarea><br> 有字数限制
                </li>
                <li><input id="submit" type="submit" name="" value="ENTER"></li>
            </form>
        </ul>
    </div>
    <div>
        PLAYER LIST
    </div>
    <table>
        <tr>
            <td>ID</td>
            <td>NAME</td>
            <td>IMG</td>
            <td>DESCRIBE</td>
            <td>GROUP</td>
            <td>VOTENUM</td>
            <td>PROMOTION</td>
        </tr>
        <?php
			    while ( $row = $res ->fetch_assoc()) {
		?>
         <tr>
             <td><?php echo $row['id']?></td>
             <td><?php echo $row['name']?></td>
             <td><?php echo $row['headimg']?></td>
             <td><?php echo $row['describetion']?></td>
             <td><?php echo $row['gid']?></td>
             <td><?php echo $row['votenum']?></td>
             <td><?php if($row['promotion']){echo "YES";}else{echo "NO";}   ?></td>
             <td><a href="../libs/controller/showController.class.php?id=<?php echo $row['id']?>&type=delplayer">删除</a></td>
         </tr>
         <?php 
          }
		?>
    </table>
    <div>
        GROUP LIST
    </div>
    <table>
        <tr>
            <td>ID</td>
            <td>NAME</td>
        </tr>
        <?php
			    while ( $row2= $res2 ->fetch_assoc()) {
		?>
         <tr>
             <td><?php echo $row2['gid']?></td>
             <td><?php echo $row2['name']?></td>
             <td><a>删除</a></td>
         </tr>
         <?php 
          }
		?>
    </table>
    <div>
      THE END OF ACTIVE
    </div>
    <div class="end">
        END
    </div>
    <script type="application/javascript">
    	getGroup();
    	function createGroup(){
    		$name = $("#groupname").val();
    		if($name == ""){
    			alert("请输入组名");
    			return;
    		}
    		$.ajax({
    			type:"post",
    			data:{
    				"type":"createGroup",
    				"name":$name
    			},
    			url:"controller/showController.class.php",
    			async:true,
    			success:function(data){
    				  if(data){
    				  	getGroup();
    				  }
    			}
    		});
    	}
    	function getGroup(){
    		$.ajax({
    			type:"post",
    			data:{
    				"type":"getGroup"
    			},
    			url:"controller/showController.class.php",
    			async:true,
    			dataType: "json",
    			success:function(data){
    				$group = $(".GroupList").eq(0).find("ul").eq(0);
    				$list = "";
    				$group.html("");
    				for(var i=0;i<data.length;i++){
        				$list += '<li><input name="gid" type="radio" value="'+data[i]["gid"]+'"><a>'+data[i]["name"]+'</a></li>' ;
    				}
    				$group.html($list);
    			}
    		});
    	}
    </script>
</body>

</html>