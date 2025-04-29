<?php
include '../includes/db.php';
include '../includes/header.php';

$stmt = $pdo->prepare("SELECT * FROM commandes");
$stmt->execute();
$commandes = $stmt->fetchAll();
?>
    <head>
        <link rel="stylesheet" href="../css/dashboard.css">
        <a href="dashboard.php" class="btn-retour">← Retour au Dashboard</a>
        <a href="ajouter_produit.php" class="btn-ajouter">+ Ajouter un produit</a>
    </head>
    <main>
        <h2>Gestion des Commandes</h2>
        <table>
            <tr><th>ID</th><th>ID Utilisateur</th><th>Date</th><th>Total</th><th>Statut</th></tr>
            <?php foreach ($commandes as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= $c['utilisateur_id'] ?></td>
                    <td><?= $c['date_commande'] ?></td>
                    <td><?= $c['total'] ?> €</td>
                    <td><?= htmlspecialchars($c['statut']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
<?php include '../includes/footer.php'; ?>