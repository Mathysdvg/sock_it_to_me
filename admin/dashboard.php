<?php
session_start();

// Sécurité : rediriger si l'utilisateur n'est pas admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header('Location: accueil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
<?php include('header.php'); ?>

<main>
    <h1>Tableau de bord Admin</h1>
    <p>Bienvenue dans l'espace de gestion de la boutique.</p>

    <ul>
        <li><a href="admin_produits.php">Gérer les produits</a></li>
        <li><a href="admin_utilisateurs.php">Gérer les utilisateurs</a></li>
        <li><a href="admin_commandes.php">Gérer les commandes</a></li>
    </ul>
</main>

<?php include('footer.php'); ?>
</body>
</html>