<?php

// error_reporting(0);
class Main{

    public $screen_shot_image2;
    public $screen_shot_json;
    public $api_key;
    public $url;
    public $base64strImg;
    
    public function fileContent()
    {
    
     $this->screen_shot_json = @file_get_contents("https://pagespeedonline.googleapis.com/pagespeedonline/v5/runPagespeed?url=$this->url&category=CATEGORY_UNSPECIFIED&strategy=DESKTOP&key=$this->api_key");
    //  echo $this->screen_shot_json."hello"; --> for debugging
    
    
    }
    
    public function __construct($api_key, $url)
    {
         $this->api_key = $api_key;
         $this->url = $url;
         $this->fileContent();
      
         if(!$this->screen_shot_json)//If there is no data returned for the screenshot.
         {
             echo "<div class='container' align='center'>No content fetched due to some errors.</div>";
         }
         else{
    
             $screen_shot_result = json_decode($this->screen_shot_json,true);//true to decode as associative array
             $screen_shot = $screen_shot_result['lighthouseResult']['audits']['full-page-screenshot']['details'];
             $screen_shot_image = $screen_shot['screenshot'];
             $download_snap = $screen_shot_image['data'];
             $snap = str_replace(array('_','-'), array('/','+'), $download_snap);
             $this->screen_shot_image2 = "<img src = '".$snap."' width=75% height=auto/>";
            

        }
       
    }

    public function downloadSnapFunc()
    {
       
        $this->base64strImg = $this->screen_shot_image2;
        if(!$this->base64strImg)
        {
            echo "<div align='center'>FAILED</div>";
        }
        else{
            define('DIRECTORY','C:\Users\G-root\Downloads');
            $image_parts = explode(";base64,", $this->base64strImg); // String separate
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = "\\".uniqid() . '.png';
            file_put_contents(DIRECTORY.$file, $image_base64);
            echo "<div align='center'>File Downloaded</div>";
        }
    }


    public function getSnap()
    {
        return $this->screen_shot_image2;
    }

}

?>