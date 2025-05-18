<?php
include '../includes/db.php';
include '../includes/header.php';
global $pdo;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $utilisateur['id'];
        $_SESSION['nom'] = $utilisateur['nom'];
        $_SESSION['is_admin'] = $utilisateur['is_admin'];
        header("Location: produit.php");
        exit();
    } else {
        echo "<p class='error'>Email ou mot de passe incorrect.</p>";
    }
}
?>

<head>
    <link rel="stylesheet" href="../css/auth.css">
</head>

<div class="auth-container">
    <section class="auth-box">
        <h2>Connexion</h2>
        <form method="post" action="">
            <label>Email :</label>
            <input type="email" name="email" required>

            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <button type="submit">Se connecter</button>
        </form>
    </section>
</div>

<?php include '../includes/footer.php'; ?>
