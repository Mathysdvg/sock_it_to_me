<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $taille = $_POST['taille'];
    $prix = $_POST['prix'];
    $image = $_POST['image'];
    $stock = $_POST['stock'];

    // Requête préparée sécurisée
    $sql = "INSERT INTO produits (nom, taille, prix, image, stock) 
            VALUES (:nom, :taille, :prix, :image, :stock)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':taille' => $taille,
        ':prix' => $prix,
        ':image' => $image,
        ':stock' => $stock
    ]);

    header('Location: admin_produits.php');
    exit();
}
?>

<head>
    <link rel="stylesheet" href="../css/ams.css">
</head>

<main>
    <h1>Ajouter un produit</h1>
    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Taille :</label>
        <select>
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
        </select>

        <label>Prix :</label>
        <input type="number" step="0.01" name="prix" required>

        <label>Image (URL ou nom de fichier) :</label>
        <input type="text" name="image" required>

        <label>Stock :</label>
        <input type="number" name="stock" required>

        <button type="submit">Ajouter</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
