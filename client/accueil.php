<?php
include '../includes/db.php';
include '../includes/header.php';
$stmt = $pdo->prepare("SELECT * FROM produits");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
    <link rel="stylesheet" href="../css/accueil.css">
</head>
<main>
    <h1>Bienvenue sur Sock It To Me !</h1>
    <p>Les meilleures chaussettes de l'univers !</p>

        <?php
        $sql = "SELECT nom, prix,taille, image FROM produits";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $chaussettes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des produits
        if (count($chaussettes) > 0) {
            echo "<div class='produits-container'>";
            foreach ($chaussettes as $chaussette) {
                echo "<div class='produit-card'>";
                echo "<img src='../images/chaussettes/" . htmlspecialchars($chaussette["image"]) . "' alt='" . htmlspecialchars($chaussette["nom"]) . "'>";
                echo "<div class='details'>";
                echo "<h2>" . htmlspecialchars($chaussette["nom"]) . "</h2>";
                echo "<h3>" . htmlspecialchars($chaussette["taille"]) . "</h3>";
                echo "<p class='prix'>" . number_format($chaussette["prix"], 2) . " €</p>";
                echo "<a href=" . "'produit.php'><button>Voir plus</button></a>";
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
