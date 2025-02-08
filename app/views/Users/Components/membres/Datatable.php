<?php

class DataTable {
    private $headers; // Headers for the table
    private $rows; // Rows of data to display
    private $title; // Title for the table

    public function __construct($title, array $headers, array $rows) {
        $this->title = $title;
        $this->headers = $headers;
        $this->rows = $rows;
    }

    public function afficher() {
        echo '<div class="datatable-wrapper">';

        // Display the title
        echo '<h2 class="datatable-title">' . htmlspecialchars($this->title) . '</h2>';

        // Display the table
        echo '<div class="tablewrapper">';
        echo "<table class='table' border='1' cellpadding='10' cellspacing='0'>";

        // Display headers
        echo "<thead><tr>";
        foreach ($this->headers as $header) {
            echo "<th>" . htmlspecialchars($header) . "</th>";
        }
        echo "</tr></thead>";

        // Display rows
        echo "<tbody>";
        foreach ($this->rows as $row) {
            echo "<tr>";
            foreach ($row as $key => $cell) {
                if ($key === 'Reçu') { // Check if the column is "Reçu"
                    $basePath = rtrim(BASE_URL, '/public');
                    echo '<td><a href="' . $basePath . '/' . htmlspecialchars($cell) . '" target="_blank">Voir le reçu</a></td>';
                } else {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</tbody>";

        echo "</table>";
        echo '</div>';

        echo '</div>';
    }
}

?>
