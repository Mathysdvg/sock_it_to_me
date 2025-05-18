<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (nom, email, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $mot_de_passe_hash]);

    echo "<p class='success'>Inscription réussie ! <a href='connexion.php'>Connectez-vous</a></p>";
}
?>

<head>
    <link rel="stylesheet" href="../css/auth.css">
</head>

<div class="auth-container">
    <section class="auth-box">
        <h2>S'inscrire</h2>
        <form method="post" action="">
            <label>Nom :</label>
            <input type="text" name="nom" required>

            <label>Email :</label>
            <input type="email" name="email" required>

            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <button type="submit">S'inscrire</button>
        </form>
    </section>
</div>

<?php include '../includes/footer.php'; ?>
