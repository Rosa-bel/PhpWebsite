<?php
require_once('../app/controllers/Users/PageComponentsController.php');

class Carte {
    function afficher($info) {
        $baseFolder = rtrim(BASE_URL, '/public');
        $isPartenaire = isset($info['partenaire']) && $info['partenaire'] == 1;
        $cardClass = $isPartenaire ? 'member-card vip-card' : 'member-card';

        echo '
        <div class="' . $cardClass . '">
            <div class="card-header">
                <div class="header-content">
                    <img src="' . $baseFolder . '/' . htmlspecialchars($info['association']['logo']) . '" alt="Association Logo" class="logo">
                    <span class="association-name">' . htmlspecialchars($info['association']['nom']) . '</span>
                </div>
                ' . ($isPartenaire ? '<div class="vip-badge">VIP</div>' : '') . '
            </div>
            <div class="card-body">
                <div class="photo-wrapper">
                    <img src="' . $baseFolder . '/' . htmlspecialchars($info['photo']) . '" alt="Member Photo" class="member-photo">
                </div>
                <div class="member-info">
                    <h2 class="member-name">' . htmlspecialchars($info['prenom']) . ' ' . htmlspecialchars($info['nom']) . '</h2>
                    <p class="member-id">ID: ' . htmlspecialchars($info['id']) . '</p>
                </div>
            </div>
            <div class="card-footer">
                <img src="' . htmlspecialchars($info['qrcode']) . '" alt="QR Code" class="qr-code">
            </div>
        </div>';
    }
}
?>