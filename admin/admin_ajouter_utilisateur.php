<?php
include '../includes/db.php';
if (!isset($pdo)) {
    die("Erreur : connexion PDO non établie");
}
include '../includes/header.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $is_admin = $_POST['is_admin'];

    // Requête SQL préparée pour insérer les données
    $sql = "INSERT INTO users (nom, email, mot_de_passe, is_admin) VALUES (?, ?, ?, ?)";

    // Préparer la requête
    $stmt = $pdo->prepare($sql);

    if ($stmt) {
        // Lier les paramètres
        $stmt->bind_param("sssi", $nom, $email, $mot_de_passe, $is_admin);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Nouvel utilisateur ajouté avec succès.";
        } else {
            echo "Erreur: " . $stmt->error;
        }

        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "Erreur: " . $pdo->error;
    }
}
?>

<head>
    <link rel="stylesheet" href="../css/ams.css">
</head>

<main>
    <h1>Ajouter un utilisateur</h1>
    <form method="post" action="">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>
        <br>
        <label for="is_admin">Est admin :</label>
        <input type="number" name="is_admin" id="is_admin" required>
        <br>
        <button type="submit">Ajouter</button>
    </form>
</main>

<?php
include '../includes/footer.php';
?>
