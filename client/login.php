<?php
include '../includes/db.php';
include '../includes/header.php';

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == "register") {
        // INSCRIPTION
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $mot_de_passe = $_POST['mot_de_passe'];

        // Hasher le mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insérer dans la base de données
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $mot_de_passe_hash]);

        echo "<p class='success'>Inscription réussie ! Vous pouvez maintenant vous connecter.</p>";

    } elseif (isset($_POST['action']) && $_POST['action'] == "login") {
        // CONNEXION
        $email = trim($_POST['email']);
        $mot_de_passe = $_POST['mot_de_passe'];

        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['nom'] = $utilisateur['nom'];
            header("Location: accueil.php"); // Rediriger vers la page d'accueil
            exit();
        } else {
            echo "<p class='error'>Email ou mot de passe incorrect.</p>";
        }
    }
}
?>
<head>
    <link rel="stylesheet" href="../css/login.css">
</head>
<!-- Formulaires -->

<div class="auth-container">
    <section class="sign-in">
        <h2>S'inscrire</h2>
        <form method="post" action="accueil.php">
            <input type="hidden" name="action" value="register">

            <label>Nom :</label>
            <input type="text" name="nom" required>

            <label>Email :</label>
            <input type="email" name="email" required>

            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <button type="submit">S'inscrire</button>
        </form>
    </section>

    <section class="log-in">
        <h2>Se connecter</h2>
        <form method="post" action="accueil.php">
            <input type="hidden" name="action" value="login">

            <label>Email :</label>
            <input type="email" name="email" required>

            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <button type="submit">Se connecter</button>
        </form>
    </section>
</div>

<?php include '../includes/footer.php'; ?>
