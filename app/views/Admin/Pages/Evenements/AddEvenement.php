<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\EventActiviteController.php") ; 
require_once("../app/controllers/Form.php") ; 



class PageAddEvenement extends PageView { 


    public function afficher() { 

        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css' , 'Admin/Common.css'] ; 
        $this->entete($css , "Ajouter un événement");
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';

      
        $c = new EventActiviteController() ; 
        //Ajout d'un evenement
        $formcontroller = new FormController() ; 
        $input = $formcontroller->getForm("addevenement") ; 
    
        $view = new InsertView(BASE_URL. "/admin/Evenements" , function ($data) use ($c) { $c->addevenement($data) ; 
        } , "Ajouter un événement" , $input) ; 


        echo '<div id ="addpartenaireform">' ; 
        $view->afficher() ; 
        echo '</div>' ; 
        echo '</div>';
    
        echo '</div>'; 
    
        echo '</body>';
        echo '</html>';
    }




}




?>


