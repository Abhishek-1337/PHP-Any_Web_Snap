<?php

   $screen_shot_image2='';
   if(isset($_POST['screen_shot']))
   {
       $api = "AIzaSyBVeLiYQ-tqIsxk-GGMC3_lMvZOgDTsuR4";
       $url = $_POST['url'];
       $screen_shot_json = file_get_contents("https://pagespeedonline.googleapis.com/pagespeedonline/v5/runPagespeed?url=$url&category=CATEGORY_UNSPECIFIED&strategy=DESKTOP&key=$api");
       $screen_shot_result = json_decode($screen_shot_json,true);
       $screen_shot = $screen_shot_result['lighthouseResult']['audits']['full-page-screenshot']['details'];
       $screen_shot_image = $screen_shot['screenshot'];
       $screen_shot_image2 = "<img src = '".$screen_shot_image['data']."' width=75% height=auto/>";
   }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="/cwr/automation/screenshot.php" method="POST">
           <label name="url">Enter URL:</label>
           <input type="url" name="url"/>

           <input type="submit" name="screen_shot"/>
           <br>
           <br>
        </form>
        <br>

        <?php

        echo $screen_shot_image2;
        ?>
    </div>
</body>
</html>