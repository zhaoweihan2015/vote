<?php
require_once ('libs/config/connect.php');
$sql = 'SELECT * FROM `votetable`';
$res = $mysql -> query($sql);
$i = 1;
?>
    <!DOCTYPE html>
    <html>

    <head>
         <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1.0">
        <title></title>
        <script src="js/jquery-3.1.0.min.js"></script>
         <link rel="stylesheet" type="text/css"  href="css/font-awesome.min.css">
      <!-- 引入 Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
      <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
    </head>

    <body>
        <header></header>
        <aside>
        	<div class="asideLeft">
        		<i class="fa fa-chevron-left fa-2x"></i>
        	</div>
        	<div id="showList">
        		<ul>
        			<li><i class="fa fa-circle-o fa-fw"></i><a href="">第一组</a></li>
        			<li><i class="fa fa-circle-o fa-fw"></i><a href="">第一组</a></li>
        			<li><i class="fa fa-circle-o fa-fw"></i><a href="">第一组</a></li>
        			<li><i class="fa fa-circle-o fa-fw"></i><a href="">第一组</a></li>
        			<li><i class="fa fa-circle-o fa-fw"></i><a href="">第一组</a></li>
        		</ul>
        	</div>
        </aside>
        <article>
            <div class="row main">
                    <!--数组拼接-->
                    <?php
while ( $row = $res ->fetch_assoc()) {
?>
                        <div class="player col-lg-6" id="<?php echo $row['id']?>">
                            <ul>
                                <li class="leftLi">
                                    <img src="libs/<?php echo $row['headimg']?>">
                                    <span><?php echo $row['name'] ?></span>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="voteShow">
                                        <div class="leftbox"></div>
                                    </div>
                                        <div class="votenum">
                                            <?php echo $row['votenum'] ?>
                                        </div>
                                </li>
                                <li>
                                    <div class="votecheck">
                                        <div class="del" onclick="voteAddorDel('del',<?php echo $i ?>)"></div>
                                        <ul></ul>
                                        <div class="add" onclick="voteAddorDel('add',<?php echo $i ?>)"></div>
                                        <div class="votechecknum">
                                            0
                                        </div>
                                    </div>
                                </li>
                                <div class="oText">
                                	<?php echo $row['describetion'] ?>
                                </div>
                            </ul>
                        </div>
                        <?php
                        $i++;
			}
					?>
            <button onclick="chooseVote();">
		click
		</button>
            </div>
        </article>
        <footer></footer>
        <script src="js/bootstrap.min.js"></script>
        <script type="application/javascript">
            //num显示
            NumShow();

            function NumShow() {
                $oVote = $(".player");
                setTimeout(function() {
                    for (var i = 0; i < $oVote.length; i++) {
                        $(".leftbox").eq(i).css("transform", "translateX(-" + (300 - parseInt($oVote.eq(i).find('.votenum').eq(0).html()) * 5) + "px)");
                    }
                }, 1)
            }
            //choose限制
            var sumNum = 0;
            var Maxchos = 10;

            function voteAddorDel(type, num) {
                num = num - 1;
                $oNum = $(".votecheck").eq(num).find('.votechecknum').eq(0);
                $oUl = $(".votecheck").eq(num).find('ul').eq(0);
                if (type == "add") {
                    if ($oNum.html() >= 10) {
                        return
                    }
                    //满10个返回错误
                    if (sumNum > (Maxchos - 1)) {
                        alert("error");
                        return
                    }
                    sumNum++;
                    $oUl.append("<li></li>");
                    $oNum.html(Number($oNum.html()) + 1);
                } else if (type == 'del') {
                    if ($oNum.html() <= 0) {
                        return
                    }
                    $oUl.find('li').eq(0).remove();
                    sumNum--;
                    $oNum.html(Number($oNum.html()) - 1);
                }
            }
            //获取选择的id
            function chooseID() {
                $oPlayer = $(".player");
                var id = "";
                for (var i = 0; i < $oPlayer.length; i++) {
                    var num = $oPlayer.eq(i).find(".votechecknum").eq(0).html();
                    if (num != 0) {
                        id += $oPlayer.eq(i).attr("id") + " " + num + ",";
                    }
                }
                id = id.substr(0, id.length - 1);
                return id;
            }
            //异步请求
            function chooseVote() {
                $.ajax({
                    type: "post",
                    url: "libs/controller/showController.class.php",
                    data: {
                        'type': 'choose',
                        'id': chooseID()
                    },
                    async: true,
                    success: function(data) {
                        if (data) {
                            alert("投票成功");
                            location.reload();
                        }
                    }
                });
            }
        </script>
    </body>

    </html>