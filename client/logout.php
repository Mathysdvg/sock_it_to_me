<?php
include '../includes/db.php';
include '../includes/header.php';
?>
<?php
session_start();
session_unset();
session_destroy();

header("Location: ../client/produit.php");
exit();
?>
<?php include '../includes/footer.php'; ?>
