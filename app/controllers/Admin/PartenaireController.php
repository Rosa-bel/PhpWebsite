<?php
require_once("../app/models/Model.php");

class PartenaireController { 


public function addpartenaire($data) {
    $updated['nom'] = $data['Nom'] ;
    $updated['lien'] = $data['Lien'] ;
    $updated['ville'] = $data['Ville'] ;
    $updated['categorie'] = $data['Catégorie'] ;
    $updated['logo'] = $data['Logo'] ;
    $r =  $data["Remise"] ; 

 

    $model = new Model("partenaires") ; 
    $model->insert($updated) ;

    
    $remisemodel = new Model('remise') ;
    $remise = [] ; 
    $remise['detail'] = $r ; 
    //$remisemodel->insert($remise) ; 
     

    
}

public function getpartenairewhere ($data) { 
    $model = new Model ("partenaires") ; 
    $results = $model->selectwhere ($data) ;

    return $results ;  


}


public function getpartenaire() {
    $model = new Model("partenaires") ; 
    $results = $model->selectAll() ; 
    return $results ;   
}







public function getcategoriepartenaire() {
    $model = new Model("categoriepartenaire") ; 
    $results = $model->selectAll() ; 
    return $results ; 

    
}


public function deletepartenaire($id) { 
    $model = new Model("partenaires") ; 

    $result = $model->selectwhere(["id"=>$id]) ;
    $result = $result[0] ;

    if ($result && isset($result['logo'])&& $result['logo'] != "") {
        $photoPath = '../'.$result['logo'];
        if (file_exists($photoPath)) {
            unlink($photoPath); 
        }
    }
    $results = $model->delete($id) ; 
}


public function updatepartenaire($id , $update) { 

    $model = new Model("partenaires") ; 
    $data['nom'] = $update['Nom'] ; 
    $data['ville'] = $update['Ville'] ; 
    $data['lien'] = $update['Lien'] ; 
    $data['categorie'] = $update['Catégorie'] ; 
    $id = ['id'=> $id] ; 
    if($update["Logo"] !="") { 
        $data['logo'] = $update['Logo'] ; 
       echo('AAAAAAAA') ; 
      
    }
    $results = $model->update($id , $data) ; 
}


}


?>