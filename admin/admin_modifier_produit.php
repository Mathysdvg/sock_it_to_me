<?php
include '../includes/db.php';
include '../includes/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];

    $sql = "UPDATE produits SET nom = :nom, prix = :prix, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nom' => $nom, ':prix' => $prix, ':description' => $description, ':id' => $id]);
    header('Location: liste_produits.php');
    exit();
} else {
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $produit = $stmt->fetch();
}
?>

    <h1>Modifier un produit</h1>
    <form method="post">
        <label>Nom:</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>

        <label>Prix:</label>
        <input type="number" step="0.01" name="prix" value="<?= htmlspecialchars($produit['prix']) ?>" required>

        <label>Description:</label>
        <textarea name="description"><?= htmlspecialchars($produit['description']) ?></textarea>

        <button type="submit">Modifier</button>
    </form>

<?php include '../includes/footer.php'; ?>