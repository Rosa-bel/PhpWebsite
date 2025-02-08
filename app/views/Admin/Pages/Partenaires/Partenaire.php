<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\PartenaireController.php") ; 
require_once("../app/controllers/Form.php") ; 
require_once("../app/views/Admin/Components/tableview.php") ; 



class PagePartenaire  extends PageView { 


    public function afficher() { 

        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css'  , 'Admin/Common.css'] ; 
        $this->entete($css , "Liste des membres");
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';
        echo '<div class="buttons">' ; 
        echo '<h2> Liste des partenaires </h2>' ; 
        echo '<a href="' . BASE_URL . '/admin/Partenaires/Ajouter" id="addpartenaire"> Ajouter un partenaire </a>' ; 
        echo '</div>' ; 

        //table des parteanires
        $c = new PartenaireController();
        $partenaires = $c->getpartenaire(); 
        $headers = [] ; 
        if (!empty($partenaires) && is_array($partenaires)) {
            $headers = array_keys($partenaires[0]);
           }
        $table = new TableView(function ($data) use ($c) { $c->deletepartenaire($data) ; 
        } , "/admin/Partenaires/Modifier?id=",$headers ,  $partenaires);
        $table->afficher(); 
        
       
    



        echo '</div>';
    
        echo '</div>'; 
        echo '</body>';
        echo '</html>';
    }




}




?>


