<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\PartenaireController.php") ; 
require_once("../app/controllers/Form.php") ; 
require_once("../app/views/Admin/Components/ModifyView.php") ; 



class PageModifyPartenaire  extends PageView { 


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
        //Modification
        $formcontroller = new FormController() ; 
        $input = $formcontroller->getForm("addpartenaire") ; 
        //récuperer les infos du partenaire
        $info['id']=$_GET["id"] ;  
        $p = $c->getpartenairewhere($info); 
        $p = $p[0];
        $data['Nom'] = $p['nom'] ; 
        $data['Ville'] = $p['ville'] ; 
        $data['Lien'] = $p['lien'] ; 
        $data['Catégorie'] = $p['categorie'] ; 
        $data['Logo'] = $p['logo'] ; 
        $p['Remise'] = 50 ; 


    
        $view = new ModifyView( BASE_URL. "/admin" , function ($id , $data) use ($c) { $c->updatepartenaire($id , $data) ; 
        } , "Modifier  Partenaire" , $input) ; 
        
        echo '<div id ="addpartenaireform">' ; 
        $view->afficher($data) ; 
        echo '</div>' ; 
        echo '</div>';
    
        echo '</div>'; 
    
        echo '</body>';
        echo '</html>';
    }




}




?>


