<?php
include '../includes/db.php';
include '../includes/header.php';

// Vérifier si l'ID de l'utilisateur est fourni
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Requête SQL préparée avec PDO
    $sql_delete = "DELETE FROM users WHERE id = :id";
    $stmt_delete = $conn->prepare($sql_delete);

    // Exécuter la requête avec la valeur de l'ID
    if ($stmt_delete->execute([':id' => $id])) {
        echo "Utilisateur supprimé avec succès.";
        header("Location: liste_utilisateurs.php");
        exit();
    } else {
        echo "Erreur : " . implode(" ", $stmt_delete->errorInfo());
    }
}
?>

<head>
    <link rel="stylesheet" href="../css/ams.css">
</head>

<main>
    <h1>Supprimer un utilisateur</h1>
    <form method="post" action="">
        <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <button type="submit">Supprimer</button>
        <a href="admin_utilisateurs.php">Annuler</a>
    </form>
</main>

<?php
include '../includes/footer.php';
?>
