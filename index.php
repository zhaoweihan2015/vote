<?php
  require_once('libs/config/connect.php');
  $sql = 'SELECT * FROM `votetable`';
  $res = $mysql ->query($sql);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    </head>

    <body>
        <!--数组拼接-->
        <?php
			    while ( $row = $res ->fetch_assoc()) {
			?>
            <div>
                <div id="<?php echo $row['id'] ?>">
                    <?php echo $row['id'] ?>
                </div>
                <div>
                    <?php echo $row['name'] ?>
                </div>
                <div class="votenum">
                    <?php echo $row['votenum'] ?>
                </div>
                <input type="checkbox" onclick="return chechchos();" value="<?php echo $row['id'] ?>">
            </div>
            <?php 
          }
		?>
            <button onclick="chooseVote();">click</button>



            <script type="application/javascript">
                var chooseinput = document.getElementsByTagName('input');
                //checkbox选择限制
                function chechchos() {
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
                }
                //获取选择的id
                function chooseID() {
                    var id = "";
                    for (var i = 0; i < chooseinput.length; i++) {
                        if (chooseinput[i].checked) {
                            id += chooseinput[i].value + ",";
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
                                location.reload()
                            }
                        }
                    });
                }
            </script>
    </body>

    </html>