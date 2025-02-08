<?php
require_once("../app/models/Model.php");

class BenevolatDonController { 

public function getDons() { 

    $donmodel = new Model("don") ; 
    $dons = $donmodel->selectAll() ; 
    return $dons ; 
} 


public function validateDon($data) { 
     
    $demandemodel = new Model("don"); 
  
    foreach($data as $id) { 
    $inscription = $demandemodel->selectwhere(["id"=>$id]) ;
    $inscription = $inscription[0] ; 
  
  
  
    $updatedemande= ['datevalidation'=> date("Y-m-d") ]; 
  
    $cond = ['id'=>$id] ; 
    $demandemodel->update( $cond ,$updatedemande) ;
  
    }
 
  
  }

public function getBenevolats() { 

    $donmodel = new Model("benevolat") ; 
    $dons = $donmodel->selectAll() ; 
    return $dons ; 
} 


public function validateBenevolat($data) { 
     
    $demandemodel = new Model("benevolat"); 
  
    foreach($data as $id) { 
    $inscription = $demandemodel->selectwhere(["id"=>$id]) ;
    $inscription = $inscription[0] ; 
  
  
  
    $updatedemande= ['valide'=> date("Y-m-d") ]; 
  
    $cond = ['id'=>$id] ; 
    $demandemodel->update( $cond ,$updatedemande) ;
  
    }
 
  
  }

public function getAbonnements() { 

    $model = new Model("abonnement") ; 
    $abonnement = $model->selectAll() ; 
    return $abonnement ; 
}

public function FaireUnDon($info) { 

    $donmodel = new Model("don") ; 
    if (isset($_SESSION[USERKEY])) {
        $data['utilisateur_id'] = $_SESSION[USERKEY];
    }
    else $data['utilisateur_id'] = 0 ; 
    $data['date'] = date("Y-m-d") ;
    $data['montant'] = $info['Montant'] ;
    $data['recu'] = $info['Reçu'] ;
    $data['datevalidation'] = "0000-00-00" ;


    $donmodel->insert($data) ; 
} 

public function benevolat($info) { 

    $benevolatmodel = new Model("benevolat") ; 

    $resu = $benevolatmodel->selectwhere(["evenement_id"=>$info['Evenement'] , "utilisateur_id"=>$_SESSION[USERKEY]]) ;
    
    if($resu !=NULL) {
     return;
        
    }
    else {
    if (isset($_SESSION[USERKEY])) {
        $data['utilisateur_id'] = $_SESSION[USERKEY];
    }
    $data['date'] = date("Y-m-d") ;
    $data['datevalidation'] = "0000-00-00" ;
    $data['evenement_id'] = $info['Evenement'] ;


    $benevolatmodel->insert($data) ;  }
} 


public function demanderAide($info) { 

    $aidemodel = new Model("demandeaide") ; 
    if (isset($_SESSION[USERKEY])) {
        $data['utilisateur_id'] = $_SESSION[USERKEY];
    }
    $data['date'] = date("Y-m-d") ;
    $data['datevalidation'] = "0000-00-00" ;
    $data['description'] = $info['Description'] ;
    $data['categorie'] = $info['Catégorie-aide'] ;
    $data['dossier_zip'] = $info['Dossier-demande-aide'] ;

    $aidemodel->insert($data) ;



}

}

?>