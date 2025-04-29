<?php
include '../includes/db.php';
include '../includes/header.php';

// Gérer l'ajout au panier
if (isset($_SESSION['utilisateur_id'])){
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['produit_id'])) {
        $utilisateur_id = $_SESSION['utilisateur_id'];
        $produit_id = intval($_POST['produit_id']);

        // Vérifier si ce produit est déjà dans le panier
        $stmt = $pdo->prepare("SELECT * FROM panier WHERE utilisateur_id = ? AND produit_id = ?");
        $stmt->execute([$utilisateur_id, $produit_id]);
        $existant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existant) {
            // Si déjà présent, augmenter la quantité
            $stmt = $pdo->prepare("UPDATE panier SET quantite = quantite + 1 WHERE utilisateur_id = ? AND produit_id = ?");
            $stmt->execute([$utilisateur_id, $produit_id]);
        } else {
            // Sinon insérer un nouvel enregistrement
            $stmt = $pdo->prepare("INSERT INTO panier (utilisateur_id, produit_id, quantite) VALUES (?, ?, 1)");
            $stmt->execute([$utilisateur_id, $produit_id]);
        }

        header("Location: produit.php");
        exit();
    }
}


// Récupérer les produits
$stmt = $pdo->prepare("SELECT * FROM produits");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
    <link rel="stylesheet" href="../css/produit.css">
</head>
<main>
    <h1>Bienvenue sur Sock It To Me !</h1>
    <p>Les meilleures chaussettes de l'univers !</p>

    <?php
    if (count($produits) > 0) {
        echo "<div class='produits-container'>";
        foreach ($produits as $produit) {
            echo "<div class='produit-card'>";
            echo "<img src='../images/chaussettes/" . htmlspecialchars($produit["image"]) . "' alt='" . htmlspecialchars($produit["nom"]) . "'>";
            echo "<div class='details'>";
            echo "<h2>" . htmlspecialchars($produit["nom"]) . "</h2>";
            echo "<h3>" . htmlspecialchars($produit["taille"]) . "</h3>";
            echo "<p class='prix'>" . number_format($produit["prix"], 2) . " €</p>";

            // Formulaire pour ajouter au panier
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='produit_id' value='" . htmlspecialchars($produit['id']) . "'>";
            echo "<button type='submit'>Ajouter au panier</button>";
            echo "</form>";

            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>Aucune chaussette disponible.</p>";
    }
    ?>
</main>

<?php include '../includes/footer.php'; ?>
