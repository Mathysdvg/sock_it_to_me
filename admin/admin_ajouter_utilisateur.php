<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motdepasse = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $is_admin = isset($_POST["is_admin"]) && $_POST["is_admin"] == "1" ? 1 : 0;

    // Requête préparée sécurisée
    $sql = "INSERT INTO users (nom, email, mot_de_passe, is_admin) 
            VALUES (:nom, :email, :mot_de_passe, :is_admin)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':mot_de_passe' => $motdepasse,
        ':is_admin' => $is_admin
    ]);

    header('Location: admin_utilisateurs.php');
    exit();
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
        <select name="is_admin" id="is_admin" required>
            <option value="0">Non</option>
            <option value="1">Oui</option>
        </select>
        <br>

        <button type="submit">Ajouter</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
