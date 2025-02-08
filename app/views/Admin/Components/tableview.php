<?php

class TableView { 
    private $headers; 
    private $rows;  
    private $title;
    private $deletefunction; 
    private $updatefunction; 
    private $searchQuery; 
    private $modifyurl ;	

    public function __construct($delete, $modifyurl ,  array $headers, array $rows) {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->deletefunction = $delete; 
        $this->searchQuery = ''; 
        $this->modifyurl = $modifyurl ; 
    }

    public function afficher() {
    
        $this->handleAjaxSearch();
        
       
        
   
        if (isset($_GET['search'])) {
            $this->searchQuery = $_GET['search'];
            $this->rows = $this->filterRows($this->searchQuery);
        }

  
        if (isset($_GET['id'])) { 
            call_user_func($this->deletefunction, $_GET['id']);
            echo "DELETED"; 
            header("Location: " . BASE_URL . "\admin");
            exit; 
        }

    
        echo '<form id="searchsection" method="GET" action="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '" class="search-form">';
        echo '<input type="text" id="searchinputadmin" name="search" value="' . htmlspecialchars($this->searchQuery) . '" placeholder="Search..." />';
        echo '<button id="seachbutton" type="submit">Search</button>';
        echo '</form>';


        echo '<div class="tablewrapper">';
        echo "<table class='table' border='1' cellpadding='10' cellspacing='0'>";

        //Keys pour les données de type images
        $imagekeys = ["photo", "piece_identite", "image","logo"];
        $linkkeys = ["link" , "lien"];


        echo "<thead><tr>";


        foreach ($this->headers as $header) {
            echo "<th>" . htmlspecialchars($header) . "</th>";
        }
        echo "<th>Operations</th>";
        echo "</tr></thead>";

        echo "<tbody>";
        foreach ($this->rows as $row) {
            echo "<tr>";


         foreach ($row as $key => $cell) {
                if (in_array($key, $imagekeys)) {
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
            echo "<td>
            <a href='" . BASE_URL . $this->modifyurl . htmlspecialchars($row['id']) . "'>
                <button class='modify-btn'>Modify</button>
            </a>
            <a href='" . htmlspecialchars($_SERVER['REQUEST_URI']) . "?id=" . htmlspecialchars($row['id']) . "&action=delete'>
                <button class='delete-btn'>Delete</button>
            </a>
          </td>";
            echo "</tr>";
        }
        echo "</tbody>";

        echo "</table>";
        echo '</div>';
    }

    private function filterRows($searchQuery) {
        $filteredRows = [];
        foreach ($this->rows as $row) {
            foreach ($row as $cell) {
                if (stripos($cell, $searchQuery) !== false) {
                    $filteredRows[] = $row;
                    break;
                }
            }
        }
        return $filteredRows;
    }

    public function handleAjaxSearch() {
        if (isset($_GET['ajax_search'])) {
            $searchQuery = $_GET['ajax_search'];
            $filteredRows = $this->filterRows($searchQuery);
            header('Content-Type: application/json');
        
            exit;
        }
    }
    
}
?>
