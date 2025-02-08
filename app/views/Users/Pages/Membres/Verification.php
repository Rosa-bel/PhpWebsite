<?php 

include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\LoginController.php");
include_once("../app/views\Users\Components\upperbarProfil.php");
include_once("../app/views\Users\Components\membres\Datatable.php");
include_once("../app\controllers\Users\ProfilController.php");

class PageVerification extends PageView { 

    public function afficher() {

        echo '<html lang="en">';
      
        echo '<body>';
        $c = new LoginController(); 
        $c->verifSessionPartenaire(); 

        $css = ['Users/Profil/Info.css', 'Users/Profil/DataTable.css'];
        $this->entete($css, "Login");

        echo '<div class="page-layout">';
        // Sidebar section profil
        echo '<aside class="sidebar">';
        $navbar = new NavBar("nav-profil", "Profil");
        $navbar->afficher();
        echo '</aside>';
    
        echo '<div class="main-content">';
            
        // Affichage de la upper bar
        $navbar = new upperBarProfil();
        $navbar->afficher();
    
        echo '<div class="info-display">';

        // Search bar
        echo '<form method="GET" action="' . BASE_URL .'/Profil/Verification '. '" class="search-bar">';
        echo '<input type="number" name="search" placeholder="Rechercher par ID" required>';
        echo '<button type="submit">Rechercher</button>';
        echo '</form>';

        // Get search parameter if exists
        $searchId = isset($_GET['search']) ? intval($_GET['search']) : null;

        $memberController = new MembreController();
        $members = $memberController->getMembresPartenaire();

        // Filter members based on search ID if provided
        if ($searchId !== null) {
            $members = array_filter($members, function ($member) use ($searchId) {
                return isset($member['id']) && $member['id'] === $searchId;
            });
        }

        // Display the datatable
        $headers = [];
        if (!empty($members) && is_array($members)) {
            $headers = array_keys($members[0]);
        }
        $datatable = new DataTable("Liste des utilisateurs", $headers, $members);
        $datatable->afficher();

        echo '</div>';
        echo '</div>'; 
        echo '</div>'; 
    
        echo '</body>';
        echo '</html>';
    }
}
?>
