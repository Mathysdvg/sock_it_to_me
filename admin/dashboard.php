<?php
include '../includes/db.php';
include '../includes/header.php';
?>
<head>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<main>
    <h1>Tableau de bord Admin</h1>
    <p>Bienvenue dans l'espace de gestion de la boutique.</p>

    <div class="admin-buttons">
        <a href="admin_produits.php" class="btn-admin">Gérer les produits</a>
        <a href="admin_utilisateurs.php" class="btn-admin">Gérer les utilisateurs</a>
    </div>
</main>

<?php
include '../includes/footer.php';
?>
