<?php
require_once("../app/controllers/Users/PartenaireController.php");


class PartenaireTable {
    public function afficher($filtres) {
        $c = new UserPartenaireController();
    
        $partenaires = $c->getuserpartenaires($filtres);
        $categories = $c->getcategoriepartenaire();
        $villes = $c->getvilles();

        echo '<div class="filters-container">';
        echo '<h3>Liste des partenaires</h3>';
        
        echo '<div class="filter-group">';
        echo '<label for="category-filter">Categories</label>';
        echo '<select id="category-filter" class="filter-select">';

        echo '<option value="">All Categories</option>';
        foreach ($categories as $cat) {
 
            $selected = (isset($filtres['categorie']) && $filtres['categorie'] == $cat['id']) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($cat['id']) . '" ' . $selected . '>'
                . htmlspecialchars($cat['nom']) . '</option>';
        }
        echo '</select>';
        echo '</div>';
        
  
        echo '<div class="filter-group">';
        echo '<label for="city-filter">Cities</label>';
        echo '<select id="city-filter" class="filter-select">';
        echo '<option value="">All Cities</option>';
        foreach ($villes as $ville) {
            $selected = (isset($filtres['ville']) && $filtres['ville'] == $ville) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($ville) . '" ' . $selected . '>'
                . htmlspecialchars($ville) . '</option>';
        }
        echo '</select>';
        echo '</div>';
        
        echo '</div>';
        


        echo '<div id="cards-container" class="cards-grid">';
        $this->renderCards($partenaires);
        echo '</div>';

       ?>

<script>
    $(document).ready(function () {
        $('#category-filter, #city-filter').on('change', function () {
            var category = $('#category-filter').val();
            var city = $('#city-filter').val();

 
            var currentUrl = window.location.href.split('?')[0]; 
            var params = new URLSearchParams(window.location.search);
            console.log(params) ; 

    
            if (category) {
                params.set('categorie', category);
            } else {
                params.delete('categorie');
            }
            if (city) {
                params.set('ville', city);
            } else {
                params.delete('ville');
            }


            var updatedUrl = currentUrl + '?' + params.toString();
            console.log(updatedUrl);

   
            window.history.pushState({}, '', updatedUrl);

            window.location.href = updatedUrl; 


        });
    });
</script>

        <?php
    }

    private function renderCards($partenaires) {
        foreach ($partenaires as $row) {
            echo '<div class="card">';
            echo '<div class="card-logo">';

            $baseFolder = rtrim(BASE_URL, '/public');

            echo '<img src="'.$baseFolder.'/'. htmlspecialchars($row['logo']) . '" alt="' . htmlspecialchars($row['nom']) . '">';
            echo '</div>';
            echo '<div class="card-content">';
            echo '<h3>' . htmlspecialchars($row['nom']) . '</h3>';
            echo '<p>' . htmlspecialchars($row['ville']) . '</p>';
            echo '<a href="' . htmlspecialchars($row['lien']) . '" class="btn-showmore">Show More</a>';
            echo '</div>';
            echo '</div>';
        }
    }
}
?>
