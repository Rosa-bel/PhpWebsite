<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\EventActiviteController.php") ; 
require_once("../app/controllers/Form.php") ; 



class PageActivites  extends PageView { 


    public function afficher() { 

        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css' , 'Admin/Common.css'] ; 
        $this->entete($css , "Liste des activités");
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';
        echo '<div class="buttons">' ; 
        echo '<h2> Liste des Activités </h2>' ; 
        echo '<a href="' . BASE_URL . '/admin/Activites/Ajouter" id="add"> Ajouter une activité </a>' ; 
        echo '</div>' ; 

        //table des activités
        $c = new EventActiviteController();
        $activites = $c->getactivite();
        $headers = [] ; 
        if (!empty($activites) && is_array($activites)) {
            $headers = array_keys($activites[0]);
           }
        
        $table = new TableView(function ($data) use ($c) { $c->deleteactivite($data) ; 
        } , "/admin/Activites/Modifier?id=" ,  $headers, $activites);
        $table->afficher(); 
        
       

        echo '</div>';
    
        echo '</div>'; 
        echo '</body>';
        echo '</html>';
    }




}




?>


