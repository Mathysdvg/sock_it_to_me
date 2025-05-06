<?php
include '../includes/db.php';
include '../includes/header.php';

// Vérifier si l'ID de l'utilisateur est fourni
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les données de l'utilisateur à modifier
$sql_select = "SELECT * FROM users WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$user = $result->fetch_assoc();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $is_admin = $_POST['is_admin'];

    // Requête SQL préparée pour mettre à jour les données
    $sql_update = "UPDATE users SET nom = ?, email = ?, mot_de_passe = ?, is_admin = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssii", $nom, $email, $mot_de_passe, $is_admin, $id);

    // Exécuter la requête
    if ($stmt_update->execute()) {
        echo "Utilisateur modifié avec succès.";
        // Rediriger vers la même page pour actualiser
        header("Location: modifier_utilisateur.php?id=$id");
        exit();
    } else {
        echo "Erreur: " . $stmt_update->error;
    }

    // Fermer la déclaration
    $stmt_update->close();
}
?>

<head>
    <link rel="stylesheet" href="../css/ams.css">
</head>

<main>
    <h1>Modifier un utilisateur</h1>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" value="<?php echo htmlspecialchars($user['mot_de_passe']); ?>" required>
        <br>
        <label for="is_admin">Est admin :</label>
        <input type="number" name="is_admin" id="is_admin" value="<?php echo htmlspecialchars($user['is_admin']); ?>" required>
        <br>
        <button type="submit">Modifier</button>
    </form>
</main>

<?php
include '../includes/footer.php';
?>
