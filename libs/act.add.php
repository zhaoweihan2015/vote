<?php
  require_once('config/connect.php');
  $sql = 'SELECT * FROM `votetable`';
  $res = $mysql ->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
             <td><?php echo $row['votenum']?></td>
             <td><?php if($row['promotion']){echo "YES";}else{echo "NO";}   ?></td>
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
</body>

</html>