<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: login.php");
    exit();
}

$utilisateur_id = $_SESSION['utilisateur_id'];

// Gérer la mise à jour de la quantité
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    $produit_id = intval($_POST['produit_id']);

    if ($_POST['action'] === 'update') {
        $quantite = intval($_POST['quantite']);
        if ($quantite > 0) {
            $stmt = $pdo->prepare("UPDATE panier SET quantite = ? WHERE utilisateur_id = ? AND produit_id = ?");
            $stmt->execute([$quantite, $utilisateur_id, $produit_id]);
        }
    } elseif ($_POST['action'] === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM panier WHERE utilisateur_id = ? AND produit_id = ?");
        $stmt->execute([$utilisateur_id, $produit_id]);
    }

    header("Location: panier.php");
    exit();
}

// Récupérer les produits du panier
$stmt = $pdo->prepare("
    SELECT p.*, c.quantite
    FROM produits p
    JOIN panier c ON p.id = c.produit_id
    WHERE c.utilisateur_id = ?
");
$stmt->execute([$utilisateur_id]);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer le total du panier
$total = 0;
foreach ($produits as $produit) {
    $total += $produit['prix'] * $produit['quantite'];
}
?>

<head>
    <link rel="stylesheet" href="../css/panier.css">
</head>
<main>
    <h1>Votre Panier</h1>

    <div class="panier-layout">
        <div class="panier-container">
            <?php if (count($produits) > 0) : ?>
                <?php foreach ($produits as $produit) : ?>
                    <div class="panier-item">
                        <img src="../images/chaussettes/<?= htmlspecialchars($produit["image"]) ?>" alt="<?= htmlspecialchars($produit["nom"]) ?>">
                        <div class="details">
                            <h2><?= htmlspecialchars($produit["nom"]) ?></h2>
                            <h3><?= htmlspecialchars($produit["taille"]) ?></h3>
                            <p class="prix"><?= number_format($produit["prix"], 2) ?> €</p>
                            <form method="post" action="">
                                <input type="hidden" name="produit_id" value="<?= htmlspecialchars($produit['id']) ?>">
                                <input type="number" name="quantite" value="<?= htmlspecialchars($produit['quantite']) ?>" min="1">
                                <button type="submit" name="action" value="update">Mettre à jour</button>
                                <button type="submit" name="action" value="delete">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Votre panier est vide.</p>
            <?php endif; ?>
        </div>

        <div class="panier-resume">
            <h2>Résumé du Panier</h2>
            <p>Total: <?= number_format($total, 2) ?> €</p>
            <?php if (count($produits) > 0) : ?>
            <a href="payer.php" class="btn-payer">Passer à l'achat<a/>
                <?php endif; ?>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
