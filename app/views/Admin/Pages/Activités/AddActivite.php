<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\EventActiviteController.php") ; 
require_once("../app/controllers/Form.php") ; 



class PageAddActivite  extends PageView { 


    public function afficher() { 

        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css' , 'Admin/Common.css'] ; 
        $this->entete($css , "Ajouter une Activité");
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';

      
        $c = new EventActiviteController() ; 
        //Ajout d'une activité
        $formcontroller = new FormController() ; 
        $input = $formcontroller->getForm("addactivite") ; 
    
        $view = new InsertView(BASE_URL. "/admin/Activites" , function ($data) use ($c) { $c->addactivite($data) ; 
        } , "Ajouter une Activité" , $input) ; 


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


