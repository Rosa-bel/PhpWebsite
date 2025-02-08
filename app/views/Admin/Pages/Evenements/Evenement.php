<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\EventActiviteController.php") ; 
require_once("../app/controllers/Form.php") ; 
require_once("../app/views/Admin/Components/tableview.php") ; 



class PageEvenements extends PageView { 


    public function afficher() { 

        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css'  , 'Admin/Common.css'] ; 
        $this->entete($css , "Liste des événements ");
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';
        echo '<div class="buttons">' ; 
        echo '<h2> Liste des événements </h2>' ; 
        echo '<a href="' . BASE_URL . '/admin/Evenements/Ajouter" id="addpartenaire"> Ajouter un événement </a>' ; 
        echo '</div>' ; 

        //table des evenement
        $c = new EventActiviteController();
        $evenement = $c->getevenement(); 
        $headers = [] ; 
        if (!empty($evenement) && is_array($evenement)) {
            $headers = array_keys($evenement[0]);
           }

           
        $table = new TableView(function ($data) use ($c) { $c->deleteevenement($data) ; 
        } , "/admin/Evenements/Modifier?id=",$headers ,  $evenement);
        $table->afficher(); 
        
       
    



        echo '</div>';
    
        echo '</div>'; 
        echo '</body>';
        echo '</html>';
    }




}




?>


