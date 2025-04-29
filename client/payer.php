<?php
include '../includes/db.php';
include '../includes/header.php';
?>

    <head>
        <link rel="stylesheet" href="../css/payer.css">
    </head>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $status = 'en cours'; // Statut de la commande
    $dateCommande = date('Y-m-d H:i:s');

    // Insérer dans la table commandes
    $stmt = $pdo->prepare("INSERT INTO commandes (id_user, statut, date_commande) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $status, $dateCommande]);
    $commandeId = $pdo->lastInsertId();

    // Récupérer les produits du panier
    $stmt = $pdo->prepare("SELECT produit_id, quantite FROM panier WHERE utilisteur_id = ?");
    $stmt->execute([$userId]);
    $panier = $stmt->fetchAll();

    // Insérer dans la table commande_details
    foreach ($panier as $item) {
        $produitId = $item['produit_id'];
        $quantite = $item['quantite'];
        $stmt = $pdo->prepare("INSERT INTO commande_details (id_commande, id_produit, quantite) VALUES (?, ?, ?)");
        $stmt->execute([$commandeId, $produitId, $quantite]);
    }

    // Supprimer le panier
    $stmt = $pdo->prepare("DELETE FROM panier WHERE utilisteur_id = ?");
    $stmt->execute([$userId]);

    echo "Paiement effectué avec succès !";
} else {
    // Afficher le formulaire de paiement
    ?>

    <h1>Paiement</h1>
    <form method="POST" action="">
        <label for="card_number">Numéro de carte :</label>
        <input type="text" id="card_number" name="card_number" required><br><br>

        <label for="expiration_date">Date d'expiration :</label>
        <input type="text" id="expiration_date" name="expiration_date" required><br><br>

        <label for="cvv">CVV :</label>
        <input type="text" id="cvv" name="cvv" required><br><br>

        <button type="submit">Valider le paiement</button>
    </form>
    </body>
    </html>
    <?php
}
?>
<?php include '../includes/footer.php'; ?>
