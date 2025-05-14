<?php
include '../includes/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "DELETE FROM produits WHERE id = :id";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([':id' => $id])) {
    header('Location: liste_produits.php');
    exit();
} else {
    echo "Erreur lors de la suppression du produit.";
}
?>

