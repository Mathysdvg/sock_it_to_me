<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<form method="post" action="">
    <label>Pseudo :</label>
    <input type="text" name="pseudo" required><br>

    <label>Email :</label>
    <input type="email" name="email" required><br>

    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br>

    <button type="submit">S'inscrire</button>
</form>

<?php include '../includes/footer.php'; ?>
