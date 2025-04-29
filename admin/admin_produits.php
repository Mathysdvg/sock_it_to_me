<?php
include '../includes/db.php';
include '../includes/header.php';

$stmt = $pdo->prepare("SELECT * FROM produits");
$stmt->execute();
$produits = $stmt->fetchAll();
?>
    <head>
        <link rel="stylesheet" href="../css/dashboard.css">
        <a href="dashboard.php" class="btn-retour">← Retour au Dashboard</a>
        <a href="ajouter.php" class="btn-ajouter">+ Ajouter un produit</a>
    </head>
    <main>
        <h2>Gestion des Produits</h2>
        <table>
            <tr><th>ID</th><th>Nom</th><th>Taille</th><th>Prix</th><th>Stock</th><th>Image</th><th>Actions</th></tr>
            <?php foreach ($produits as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nom']) ?></td>
                    <td><?= $p['taille'] ?></td>
                    <td><?= $p['prix'] ?> €</td>
                    <td><?= $p['stock'] ?></td>
                    <td><?= $p['image'] ?></td>
                    <td>
                        <a href="modifier.php>">Modifier</a> |
                        <a href="supprimer.php">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
<?php include '../includes/footer.php'; ?>