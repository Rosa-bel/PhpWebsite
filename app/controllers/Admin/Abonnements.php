<?php
require_once("../app/models/Model.php");

class AbonnementsController { 


    public function getAbonnements() { 
        $model = new Model("abonnement");
    
        $attributs = ['id', 'utilisateur_id', 'recu_virement', 'expiration', 'carte_id', 'valide'];
        $resu = $model->selectAttributes($attributs, [], []);
    
        $finalResults = []; 
    
        foreach ($resu as $abonnement) {
            $finalResults[] = [
                'id' => $abonnement['id'],
                'utilisateur_id' => $abonnement['utilisateur_id'],
                'recu_virement' => $abonnement['recu_virement'],
                'expiration' => $abonnement['expiration'],
                'carte_id' => $abonnement['carte_id'],
                'valide' => $abonnement['valide'],
                'carte_nom' => $this->getCarteType($abonnement['carte_id']), // Replaced value
                'Username' => $this->getMembreUsername($abonnement['utilisateur_id'])['username'], // Replaced value
            ];
        }
    
        return $finalResults;
    }
    
    

    public function getCarteType ($id) { 

        $cartemodel = new Model("typecarte") ;
        $cond = ['id' => $id] ;
        $attributs= ['nom'] ;
        $resu = $cartemodel->selectAttributes($attributs , $cond , []) ;
        
        return $resu[0]['nom'] ;
    }

    public function getMembreUsername ($id) { 

        $membremodel = new Model("utilisateur") ;
        $cond = ['id' => $id] ;
        $attributs = ['username' ] ;
        $resu = $membremodel->selectAttributes($attributs , $cond , []) ;
        return $resu[0] ;
        
        }
    
    
    public function validateAbonnement($data) { 
     
      $demandemodel = new Model("abonnement"); 
    
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