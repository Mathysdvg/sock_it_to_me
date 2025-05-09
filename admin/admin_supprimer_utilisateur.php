<?php
include '../includes/db.php';
include '../includes/header.php';

// Vérifier si l'ID de l'utilisateur est fourni
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Requête SQL préparée pour supprimer les données
    $sql_delete = "DELETE FROM users WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    // Exécuter la requête
    if ($stmt_delete->execute()) {
        echo "Utilisateur supprimé avec succès.";
        // Rediriger vers une page de liste des utilisateurs ou une autre page
        header("Location: liste_utilisateurs.php");
        exit();
    } else {
        echo "Erreur: " . $stmt_delete->error;
    }

    // Fermer la déclaration
    $stmt_delete->close();
}
?>

<head>
    <link rel="stylesheet" href="../css/ams.css">
</head>

<main>
    <h1>Supprimer un utilisateur</h1>
    <form method="post" action="">
        <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit">Supprimer</button>
        <a href="admin_utilisateurs.php">Annuler</a>
    </form>
</main>

<?php
include '../includes/footer.php';
?>
