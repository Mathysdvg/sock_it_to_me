<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sock It To Me</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
<header class="site-header">
    <div class="header-container">
        <img src="images/logo.png" alt="Logo Sock It To Me" class="logo">
        <nav class="main-nav">
            <a href="accueil.php">Accueil</a>
            <a href="panier.php">Panier</a>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true): ?>
                <li><a href="dashboard.php">Admin</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['id'])): ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="login.php">Connexion</a></li>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main>
