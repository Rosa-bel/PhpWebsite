<?php
require_once("../app/models/Model.php");

class EventActiviteController { 


public function addactivite($data) {
    $updated['titre'] = $data['Titre'] ;
    $updated['description'] = $data['Description'] ;
    $updated['categorie'] = $data['Catégorie'] ;
    $updated['photo'] = $data['Photo'] ;
    $model = new Model("activite") ; 
    $model->insert($updated) ; 
     

    
}

public function getactivitewhere ($data) { 
    $model = new Model ("activite") ; 
    $results = $model->selectwhere ($data) ;

    return $results ;  


}

public function getevenementwhere ($data) { 
    $model = new Model ("evenement") ; 
    $results = $model->selectwhere ($data) ;

    return $results ;  


}



public function getactivite() {
    $model = new Model("activite") ; 
    $results = $model->selectAll() ; 
    return $results ; 

    
}

public function getcategorieactivite() {
    $model = new Model("categorieactivite") ; 
    $results = $model->selectAll() ; 
    return $results ; 

    
}


public function deleteactivite($id) { 
    $model = new Model("activite") ; 
    $result = $model->selectwhere(["id"=>$id]) ;
    $result = $result[0] ;

    if ($result && isset($result['photo'])&& $result['photo'] != "") {
        $photoPath = '../'.$result['photo'];
        if (file_exists($photoPath)) {
            unlink($photoPath); 
        }
    }
    $results = $model->delete($id) ; 
}


public function updateactivite($id , $data) { 
    $updated['titre'] = $data['Titre'] ;
    $updated['description'] = $data['Description'] ;
    $updated['categorie'] = $data['Catégorie'] ;
    if($data["Photo"]!= "") { 
        $updated['photo'] = $data['Photo'] ;
    }

    $model = new Model("activite") ; 
    $id = ['id'=> $id] ; 
    $model->update($id , $updated) ; 
     

}

public function updateevent($id , $data) { 
    $updated['nom'] = $data['Nom'] ;
    $updated['description'] = $data['Description'] ;
    $updated['categorie'] = $data['Catégorie'] ;
    if($data["Photo"]!= "") { 
        $updated['photo'] = $data['Photo'] ;
    };
    $model = new Model("evenement") ; 
    $id = ['id'=> $id] ; 
    $model->update($id , $updated) ; 
     

}






public function getevenement() {
    $model = new Model("evenement") ; 
    $results = $model->selectAll() ; 
    return $results ; 

    
}


public function categorieEvenement($id) { 
    $model = new Model('categorieevenement') ; 
    $cond['id'] = $id ; 
    $resu = $model->selectAttributes(['nom'] ,$cond , [] ) ;
    return resu[0]['nom'] ;  

}

public function categorieActivite($id) { 
    $model = new Model('categorieactivite') ; 
    $cond['id'] = $id;
    $resu = $model->selectAttributes(['nom'] ,$cond , [] ) ;
    return resu[0]['nom'] ;  

}

public function deleteevenement($id) { 
    $model = new Model("evenement") ; 
    $result = $model->selectwhere(["id"=>$id]) ;
    $result = $result[0] ;
    
    if ($result && isset($result['photo']) && $result['photo'] != "") {
        $photoPath = '../'.$result['photo'];
        if (file_exists($photoPath)) {
            unlink($photoPath); 
        }
    }
    $results = $model->delete($id) ;
}



public function addevenement($data) {
    $updated['nom'] = $data['Nom'] ;
    $updated['description'] = $data['Description'] ;
    $updated['categorie'] = $data['Catégorie'] ;
    $updated['date'] = $data['Date'] ;
    $updated['photo'] = $data['Photo'] ;
    $model = new Model("evenement") ; 
    $model->insert($updated) ; 
     

    
}
}


?>