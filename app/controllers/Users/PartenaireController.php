<?php

require_once("../app/models/Model.php");

class UserPartenaireController { 



public function getpartenairewhere ($data) { 
    $model = new Model ("partenaires") ; 
    $results = $model->selectwhere ($data) ;

    return $results ;  


}


public function getcategoriepartenaire() {
    $model = new Model("categoriepartenaire") ; 
    $results = $model->selectAll() ; 
    return $results ; 

    
}
public function getvilles() {
    $model = new Model("partenaires") ; 
    $resu = $model->getColumnValues('ville' , []) ; 
    return $resu ;

    
}







public function getuserpartenaires($filtres) { 

    $m = new Model("partenaires") ; 
    $attributs=['nom' , 'logo' , 'ville' , 'lien' , 'categorie'] ; 
    $resu = $m->selectAttributes($attributs , $filtres , []) ; 
    return $resu ;

}





}


?>