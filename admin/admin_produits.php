<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;

$stmt = $pdo->prepare("SELECT * FROM produits");
$stmt->execute();
$produits = $stmt->fetchAll();
?>
    <head>
        <link rel="stylesheet" href="../css/dashboard.css">
        <a href="dashboard.php" class="btn-retour">← Retour au Dashboard</a>
        <a href="admin_ajouter_produit.php" class="btn-ajouter">+ Ajouter un produit</a>
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
                        <a href="admin_modifier_produit.php?id=<?= $p['id'] ?>" class="btn-retour">Modifier</a>
                        <a href="admin_supprimer_produit.php?id=<?= $p['id'] ?>" class="btn-retour" onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
<?php
include '../includes/footer.php';
?>