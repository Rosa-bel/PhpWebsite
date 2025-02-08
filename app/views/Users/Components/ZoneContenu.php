<?php
require_once("../app/controllers/Users/PartenaireController.php");

class ZoneContenu {
    private $redirectUrl;

    public function __construct($redirectUrl = '') {
        $this->redirectUrl = $redirectUrl;
    }

    public function afficher($nb, $title) {
        $c = new EventActiviteController();
        $activites = $c->getactivite();
        
        if ($nb > 0) {
            $activites = array_slice($activites, 0, $nb);
        }

        // Container wrapper for better centering
        echo '<div class="section-wrapper">';
        // Section title
        echo '<h2 class="section-title">' . $title . '</h2>';
        
        // Activities grid container
        echo '<div class="activities-container">';
        
        foreach ($activites as $activite) {
            echo '<div class="activity-card">';
            
            echo '<div class="activity-image">';
            if (!empty($activite['photo'])) {
                echo '<img src="' . '../' . htmlspecialchars($activite['photo']) . '" alt="' . htmlspecialchars($activite['titre']) . '">';
            } else {
                echo '<img src="placeholder.jpg" alt="No image available">';
            }
            echo '</div>';

            echo '<div class="activity-content">';
            echo '<h3>' . htmlspecialchars($activite['titre']) . '</h3>';
            
            echo '<span class="category-badge">' . htmlspecialchars($activite['categorie']) . '</span>';
            
            $description = strlen($activite['description']) > 100 ? 
                substr($activite['description'], 0, 97) . '...' : 
                $activite['description'];
            echo '<p>' . htmlspecialchars($description) . '</p>';
            
            echo '</div>'; // End activity-content
            echo '</div>'; // End activity-card
        }
        
        echo '</div>'; // End activities-container

        // Single "Voir plus" button centered below all cards
        if ($this->redirectUrl) {
            echo '<div class="voir-plus-wrapper">';
            echo '<a href="' . htmlspecialchars($this->redirectUrl) . '" class="voir-plus-btn">Voir plus</a>';
            echo '</div>';
        }
        
        echo '</div>'; // End section-wrapper

        // Output CSS
        echo '<style>
            .section-wrapper {
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem 1rem;
            }

            .section-title {
                text-align: center;
                font-size: 2rem;
                color: #333;
                margin-bottom: 2rem;
                position: relative;
                padding-bottom: 0.5rem;
            }

            .section-title:after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 3px;
                background-color: #007bff;
            }

            .activities-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .activity-card {
                background: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
                transition: transform 0.2s, box-shadow 0.2s;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .activity-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
            }

            .activity-image {
                position: relative;
                padding-top: 56.25%; /* 16:9 aspect ratio */
                overflow: hidden;
            }

            .activity-image img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .activity-content {
                padding: 1.25rem;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .activity-content h3 {
                margin: 0 0 0.75rem 0;
                font-size: 1.1rem;
                color: #333;
            }

            .category-badge {
                display: inline-block;
                padding: 0.25rem 0.75rem;
                background-color: #f8f9fa;
                color: #495057;
                border-radius: 15px;
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
                align-self: flex-start;
            }

            .activity-content p {
                color: #666;
                line-height: 1.4;
                font-size: 0.9rem;
                margin: 0;
                flex-grow: 1;
            }

            .voir-plus-wrapper {
                text-align: center;
                margin-top: 2rem;
            }

            .voir-plus-btn {
                display: inline-block;
                padding: 0.75rem 2.5rem;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 25px;
                transition: all 0.2s;
                font-weight: 500;
            }

            .voir-plus-btn:hover {
                background-color: #0056b3;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            @media (max-width: 768px) {
                .section-wrapper {
                    padding: 1.5rem 1rem;
                }

                .section-title {
                    font-size: 1.75rem;
                    margin-bottom: 1.5rem;
                }

                .activities-container {
                    gap: 1rem;
                }

                .activity-content {
                    padding: 1rem;
                }
            }
        </style>';
    }
}
?>