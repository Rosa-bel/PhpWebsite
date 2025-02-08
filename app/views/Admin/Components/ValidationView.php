<?php

class ValidationView {
    private $headers;
    private $rows;
    private $title;
    private $validationFunction;
    private $url ; 

    public function __construct(callable $validationFunction, array $headers, array $rows , $url) {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->validationFunction = $validationFunction;
        $this->url = $url ; 
    }

    public function afficher() {
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validate'])) {
            $selectedIds = $_POST['selected_ids'] ?? [];
            if (!empty($selectedIds)) {
                call_user_func($this->validationFunction, $selectedIds);
                header("Location: " . $this->url);
                exit; 
               
            } 
        }
      

        //Affichage du tableau
        echo '<form id="validation-form" method="POST" action="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">';

        echo '<div class="tablewrapper">';
        echo "<table class='table' border='1' cellpadding='10' cellspacing='0'>";
        $imgkeys = ["photo", "piece_identite", "image", "logo" , "recu" , "recu_virement"];
        $linkkeys = [ "lien" ];
        echo "<thead><tr>";
        foreach ($this->headers as $header) {
            echo "<th>" . htmlspecialchars($header) . "</th>";
        }
        echo "<th>Select</th>";
        echo "</tr></thead>";

        echo "<tbody>";
        foreach ($this->rows as $row) {
            echo "<tr>";
            foreach ($row as $key => $cell) {
                if (in_array($key, $imgkeys)) {
                    echo "<td>";
                    $baseFolder = rtrim(BASE_URL, '/public');
                    $imageUrl = $baseFolder . '/' . htmlspecialchars($cell);
        
                  
                    echo '<a href="' . $imageUrl . '" target="_blank">';
                    echo '<img src="' . $imageUrl . '" alt="Image" style="max-width: 100px; max-height: 100px;">';
                    echo '</a>';
                    echo "</td>";
                } elseif (in_array($key, $linkkeys)) {
                    echo "<td>";
                    echo '<a href="' . htmlspecialchars($cell) . '" target="_blank">Lien</a>';
                    echo "</td>";
                } else {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
            }
        
           
            $isLocked = (isset($row['valide']) && $row['valide'] !== '0000-00-00') || 
                        (isset($row['datevalidation']) && $row['datevalidation'] !== '0000-00-00');
            
            echo "<td><input type='checkbox' name='selected_ids[]' value='" . htmlspecialchars($row['id']) . "' " . 
                 ($isLocked ? "checked disabled" : "") . "></td>"; 
            echo "</tr>";
        }
        
        echo "</tbody>";

        echo "</table>";
        echo '</div>';

        
        echo '<button type="submit" id="validate-button" name="validate">Valider</button>';

        echo '</form>';

    
    }
}

?>
