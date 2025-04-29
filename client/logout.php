<?php
include '../includes/db.php';
include '../includes/header.php';
?>
<?php
session_start();
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session

// Redirection vers la page d'accueil (ou une page de connexion si tu préfères)
header("Location: ../client/accueil.php");
exit();
?>
<?php include '../includes/footer.php'; ?>
