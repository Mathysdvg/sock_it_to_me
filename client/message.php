<?php
include '../includes/db.php';
include '../includes/header.php';
?>

    <head>
        <link rel="stylesheet" href="../css/contact.css">
    </head>
<body>
<h1>Merci pour votre message !</h1>

<p><strong>Nom :</strong> <?= htmlspecialchars($_POST['nom'] ?? '') ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($_POST['email'] ?? '') ?></p>
<p><strong>Message :</strong><br><?= nl2br(htmlspecialchars($_POST['message'] ?? '')) ?></p>

<a href="contact.php">Retour au formulaire</a>
</body>

<?php include '../includes/footer.php'; ?>