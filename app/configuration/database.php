<?php 
require_once("config.php");

Trait Database {
   
   private function connection() {
    $string = "mysql:dbname=".DBNAME.";host=".DBHOST;
    try {
        $c = new PDO( $string , DBUSER, DBPASS);
        

    }
 catch (PDOException $ex) { 
    printf("erreur de connexion à la bdd" ,  $ex->getMessage() );
    exit() ; 
   
    }
    return $c ; 

    }

    private function deconnexion($c) { 
        $c = null ; 

    }

    public function requete ($query , $data=[]) { 
        $c = $this->connection() ; 
        $stm = $c->prepare($query) ; 
        $res = $stm->execute($data) ;
        $result = $stm->fetchAll(PDO::FETCH_ASSOC); 
        $this->deconnexion($c) ;
        return $result ;  
        


    }

 
   

}


?>