<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: admin_utilisateurs.php");
exit;

 include '../includes/footer.php';
?>

