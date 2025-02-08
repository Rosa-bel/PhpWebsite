<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\PartenaireController.php") ; 
require_once("../app/controllers/Form.php") ; 



class PageAddPartenaire  extends PageView { 


    public function afficher() { 

        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css' , 'Admin/Common.css'] ; 
        $this->entete($css , "Ajouter un Partenaire");
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';

      
        $c = new PartenaireController() ; 
        //Ajout d'un parteanire
        $formcontroller = new FormController() ; 
        $input = $formcontroller->getForm("addpartenaire") ; 
        $view = new InsertView(BASE_URL. "/admin" , function ($data) use ($c) { $c->addpartenaire($data) ; 
        } , "Ajouter un Partenaire" , $input) ; 


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


