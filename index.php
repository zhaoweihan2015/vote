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
                <input type="checkbox" name="votecheck" value="<?php echo $row['id'] ?>">
            </div>
            <?php 
          }
		?>
            <button onclick="chooseVote();">click</button>
            <script type="application/javascript">
                function chooseID() {
                    var chooseinput = document.getElementsByTagName('input');
                    var id = "";
                    for (var i = 0; i < chooseinput.length; i++) {
                        if (chooseinput[i].checked) {
                            id += chooseinput[i].value + ",";
                        }
                    }
                    id = id.substr(0, id.length - 1);
                    return id;
                }

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