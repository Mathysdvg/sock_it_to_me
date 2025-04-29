<?php
include '../includes/db.php';
include '../includes/header.php';

$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$utilisateurs = $stmt->fetchAll();
?>
<head>
    <link rel="stylesheet" href="../css/dashboard.css">
    <a href="dashboard.php" class="btn-retour">← Retour au Dashboard</a>
    <a href="ajouter_produit.php" class="btn-ajouter">+ Ajouter un produit</a>
</head>
<main>
    <h2>Gestion des Utilisateurs</h2>
    <table>
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Admin ?</th><th>Actions</th></tr>
        <?php foreach ($utilisateurs as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['nom']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['is_admin'] ? 'Oui' : 'Non' ?></td>
                <td>
                    <a href="modifier_utilisateur.php?id=<?= $u['id'] ?>">Modifier</a> |
                    <a href="supprimer_produit.php?id="<?= $u['id'] ?>>Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include '../includes/footer.php'; ?>
