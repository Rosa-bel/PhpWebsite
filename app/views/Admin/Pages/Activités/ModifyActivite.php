<?php

require_once("../app/views/PageView.php") ; 
require_once("../app\controllers\Admin\EventActiviteController.php") ; 
require_once("../app/controllers/Form.php") ; 
require_once("../app/views/Admin/Components/ModifyView.php") ; 



class PageModifyActivite extends PageView { 


    public function afficher() { 

        echo '<html lang="en">';
        $css = ['Admin/PagePartenaires.css' , 'Admin/Common.css'] ; 
        $this->entete($css , " Modifier une Activité");
        echo '<body>';
        echo '<div class="container">';
        
        $nav = new NavBar("navbaradmin" , "admin1"); 
        $nav->afficher() ; 
        
        echo '<div class="content-right pagepartenaire">';
        echo '<div class="upperbar">';
        echo '</div>';

      
        $c = new EventActiviteController() ; 
        //Modification
        $formcontroller = new FormController() ; 
        $input = $formcontroller->getForm("addactivite") ; 
        //récuperer les infos de lactivite
        $info['id']=$_GET["id"] ;  
        $p = $c->getactivitewhere($info); 
        $p = $p[0];
  

        $data['Titre'] = $p['titre'] ; 
        $data['Description'] = $p['description'] ; 
        $data['Catégorie'] = $p['categorie'] ; 

    
        $view = new ModifyView( BASE_URL. "/admin" , function ($id , $data) use ($c) { $c->updateactivite($id , $data) ; 
        } , "Modifier une activité" , $input) ; 
        
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


