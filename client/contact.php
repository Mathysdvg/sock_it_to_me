<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<head>
    <link rel="stylesheet" href="../css/contact.css">
</head>
<body>
    <h1>Contactez-nous</h1>
    <form action="message.php" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" name="nom" id="nom" required><br><br>

        <label for="email">Email :</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="message">Message :</label><br>
        <textarea name="message" id="message" rows="5" required></textarea><br><br>

        <button type="submit">Envoyer</button>
    </form>
</body>

<?php include '../includes/footer.php'; ?>