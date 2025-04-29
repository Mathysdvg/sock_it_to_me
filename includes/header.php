<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sock It To Me</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/global.css">
</head>
<body>
<header class="site-header">
    <div class="header-container">
        <img src="../images/logo.png" alt="Logo Sock It To Me" class="logo">
        <nav class="main-nav">
            <li><a href="../client/accueil.php">Accueil</a></li>
            <li><a href="../client/panier.php">Panier</a></li>
            <?php if (isset($_SESSION['utilisateur_id'])): ?>
                <li>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom']); ?> !</li>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true): ?>
                    <li><a href="../admin/dashboard.php">Dashboard</a></li>
                <?php endif; ?>
                <li><a href="../client/logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="../client/inscription.php">Inscription</a></li>
                <li><a href="../client/connexion.php">Connexion</a></li>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main>
