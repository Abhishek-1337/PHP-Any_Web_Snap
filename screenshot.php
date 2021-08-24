
<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    
    <body>
        <div class="container" align="center" style="margin-top: 210px">
            <form action="/cwr/automation/screenshot.php" method="POST">
    
                <div class="container">
                    <label name="url">Enter URL:</label>
                    <br>
                    <input type="url" name="url" />
                </div>
                <br>
                <div class="container">
                    <label name="key">Paste your google API key here:</label>
                    <br>
                    <input type="text" name="key" />
                </div>
                <br>
                <input type="submit" name="screen_shot" /><button name="download">Download</button>
                <br>
                <br>
            </form>
            <br>
            <?php
                include 'download2.php';
                if(isset($_POST['screen_shot']))
                {
                    $api_key = $_POST['key'];
                    $url = $_POST['url'];
                    $objMain = new Main($api_key, $url);
                    echo $objMain->getSnap();
                
                }
                else if(isset($_POST['download']))
                {
                    $api_key = $_POST['key'];
                    $url = $_POST['url'];
                    $objMain = new Main($api_key, $url);
                    $objMain->downloadSnapFunc();
                    
                }
            ?>
        </div>
    </body>
    
    </html>
