<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;

$id = $_GET['id'] ?? null;


// Récupère les données actuelles du produit
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
$stmt->execute([':id' => $id]);
$produit = $stmt->fetch();

if (!$produit) {
    echo "Produit non trouvé.";
    exit();
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $taille = $_POST['taille'];
    $prix = $_POST['prix'];
    $image = $_POST['image'];
    $stock = $_POST['stock'];

    // Mise à jour du produit
    $sql = "UPDATE produits SET nom = :nom, taille = :taille, prix = :prix, image = :image, stock = :stock WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':taille' => $taille,
        ':prix' => $prix,
        ':image' => $image,
        ':stock' => $stock,
        ':id' => $id
    ]);

    header("Location: admin_produits.php");
    exit();
}
?>

<head>
    <link rel="stylesheet" href="../css/ams.css">
</head>

<main>
    <h1>Modifier un produit</h1>
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>

        <label>Taille :</label>
        <select name="taille" required>
            <?php
            $tailles = ['S', 'M', 'L', 'XL'];
            foreach ($tailles as $taille_option) {
                $selected = ($produit['taille'] === $taille_option) ? 'selected' : '';
                echo "<option value=\"$taille_option\" $selected>$taille_option</option>";
            }
            ?>
        </select>

        <label>Prix :</label>
        <input type="number" step="0.01" name="prix" value="<?= htmlspecialchars($produit['prix']) ?>" required>

        <label>Image (URL ou nom de fichier) :</label>
        <input type="text" name="image" value="<?= htmlspecialchars($produit['image']) ?>" required>

        <label>Stock :</label>
        <input type="number" name="stock" value="<?= htmlspecialchars($produit['stock']) ?>" required>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
