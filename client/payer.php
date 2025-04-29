<?php
include '../includes/db.php';
include '../includes/header.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: connexion.php");
    exit();
}

$utilisateur_id = $_SESSION['utilisateur_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $card_number = $_POST['card-number'];
    $expiry_date = $_POST['expiry-date'];
    $cvv = $_POST['cvv'];
    $card_holder = $_POST['card-holder'];

    // Supprimer le panier
    $stmt = $pdo->prepare("DELETE FROM panier WHERE utilisateur_id = ?");
    $stmt->execute([$utilisateur_id]);

    $message = "Paiement effectué avec succès !";
}
?>
<head>
    <link rel="stylesheet" href="../css/payer.css">
</head>
<main>
    <h1>Paiement</h1>

    <?php if (isset($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php else: ?>
        <form method="post" action="">
            <label for="card-number">Numéro de carte</label>
            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>

            <label for="expiry-date">Date d'expiration</label>
            <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" required>

            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>

            <label for="card-holder">Nom du titulaire de la carte</label>
            <input type="text" id="card-holder" name="card-holder" placeholder="Nom Complet" required>

            <button type="submit">Payer</button>
        </form>
    <?php endif; ?>
</main>

<?php include '../includes/footer.php'; ?>
