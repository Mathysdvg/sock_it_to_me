<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];

    $sql = "INSERT INTO produits (nom, prix, description) VALUES (:nom, :prix, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nom' => $nom, ':prix' => $prix, ':description' => $description]);
    header('Location: liste_produits.php');
    exit();
}
?>

    <h1>Ajouter un produit</h1>
    <form method="post">
        <label>Nom:</label>
        <input type="text" name="nom" required>

        <label>Prix:</label>
        <input type="number" step="0.01" name="prix" required>

        <label>Description:</label>
        <textarea name="description"></textarea>

        <button type="submit">Ajouter</button>
    </form>

<?php include '../includes/footer.php'; ?>