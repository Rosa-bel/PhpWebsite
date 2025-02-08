<?php



class PageView { 

    private $cssfile ; 
    private $title ; 


    public function entete($cssfile , $name) {
        $base = BASE_URL ; 
        echo 
        '<head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$name.'</title>' ; 
         
             foreach ($cssfile as $css) { 
               echo '<link rel="stylesheet" href= "'.$base.'/css/'. $css .'">';
             
             }

             echo'<script src="../app\scripts\jquery.min.js"></script>' ;  
    
          
       echo  '</head>'; 
        
       
    }


    
}


?>