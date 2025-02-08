<?php


class MembreController{


public function getMembres() { 
    $model = new Model("utilisateur") ; 

    $attributs =[ 'id' , 'nom' , 'prenom' , 'username' ,'piece_identite' , 'photo' , 'membre','bloque' , 'partenaire' , 'admin' ] ; 
    $negation['valide'] = "0000-00-00" ; 
   $resu = $model->selectAttributes($attributs , [] , $negation ) ; 
  return $resu; 

}

public function getMembresPartenaire() { 
    $model = new Model("utilisateur"); 
    $profileCont = new ProfilController();
    $attributs = ['id', 'nom', 'prenom']; 
    $negation['valide'] = "0000-00-00"; 
    $negation['partenaire'] = "1"; 
    $negation['admin'] = "1";
    $resu = $model->selectAttributes($attributs, [], $negation); 

    foreach ($resu as &$row) { 
        $abonnementStatus = $profileCont->verifierAbonnement($row['id']);
        $row['carte_type'] = $abonnementStatus ? $abonnementStatus : "Aucune carte valable";
    }

    return $resu; 
}


public function getdemandeadhesion() {
  $model = new Model("utilisateur");
 $cond = ['valide' => '0000-00-00']; 
 $attributs =[ 'id' , 'nom' , 'prenom' , 'username' ,'piece_identite' , 'photo'   ] ; 

$resu = $model->selectAttributes($attributs , $cond , [] ) ; 
  return $resu;
}


public function validateDemandeAdhesion($data) { 
 
  $demandemodel = new Model("utilisateur"); 

  foreach($data as $id) { 
  $inscription = $demandemodel->selectwhere(["id"=>$id]) ;
  $inscription = $inscription[0] ; 



  $updatedemande= ['valide'=> date("Y-m-d") ]; 

  $cond = ['id'=>$id] ; 
  $demandemodel->update( $cond ,$updatedemande) ;

  }
  
  

}



}



?>
