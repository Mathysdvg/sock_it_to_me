<?php
include '../includes/db.php';
include '../includes/header.php';

// Récupérer le type d'élément à sélectionner automatiquement
$default_type = isset($_GET['type']) ? $_GET['type'] : 'produit';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $type = $_POST['type'];

    // Initialiser les variables pour la requête SQL
    $table = '';
    $colonnes = '';
    $valeurs = '';

    // Déterminer la table et les colonnes en fonction du type
    switch ($type) {
        case 'produit':
            $nom = $_POST['nom'];
            $taille = $_POST['taille'];
            $prix = $_POST['prix'];
            $image = $_POST['image'];
            $stock = $_POST['stock'];
            $table = 'produits';
            $colonnes = 'nom, taille, prix, image, stock';
            $valeurs = "'$nom', '$taille', $prix, '$image', $stock";
            break;
        case 'utilisateur':
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $is_admin = $_POST['is_admin'];
            $table = 'users';
            $colonnes = 'nom, email, mot_de_passe, is_admin';
            $valeurs = "'$nom', '$email', '$mot_de_passe', $is_admin";
            break;
        case 'commande':
            $id_user = $_POST['id_user'];
            $statut = $_POST['statut'];
            $date_commande = $_POST['date_commande'];
            $table = 'commandes';
            $colonnes = 'id_user, statut, date_commande';
            $valeurs = "$id_user, '$statut', '$date_commande'";
            break;
        case 'commande_details':
            $id_commande = $_POST['id_commande'];
            $id_produit = $_POST['id_produit'];
            $quantite = $_POST['quantite'];
            $prix_total = $_POST['prix_total'];
            $table = 'commande_details';
            $colonnes = 'id_commande, id_produit, quantite, prix_total';
            $valeurs = "$id_commande, $id_produit, $quantite, $prix_total";
            break;
        default:
            echo "Type d'élément invalide.";
            exit;
    }

    // Requête SQL pour insérer les données
    $sql = "INSERT INTO $table ($colonnes) VALUES ($valeurs)";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        echo "Nouvel élément ajouté avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<head>
    <link rel="stylesheet" href="../css/ajouter.css">
</head>

<main>
    <h1>Ajouter un élément</h1>
    <form method="post" action="">
        <label for="type">Type d'élément :</label>
        <select name="type" id="type" required>
            <option value="produit" <?php echo $default_type == 'produit' ? 'selected' : ''; ?>>Produit</option>
            <option value="utilisateur" <?php echo $default_type == 'utilisateur' ? 'selected' : ''; ?>>Utilisateur</option>
            <option value="commande" <?php echo $default_type == 'commande' ? 'selected' : ''; ?>>Commande</option>
            <option value="commande_details" <?php echo $default_type == 'commande_details' ? 'selected' : ''; ?>>Détails de Commande</option>
        </select>
        <br>

        <!-- Champs pour les produits -->
        <div id="produit_fields" class="hidden">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            <br>
            <label for="taille">Taille :</label>
            <input type="text" name="taille" id="taille" required>
            <br>
            <label for="prix">Prix :</label>
            <input type="text" name="prix" id="prix" required>
            <br>
            <label for="image">Image :</label>
            <input type="text" name="image" id="image" required>
            <br>
            <label for="stock">Stock :</label>
            <input type="number" name="stock" id="stock" required>
            <br>
        </div>

        <!-- Champs pour les utilisateurs -->
        <div id="utilisateur_fields" class="hidden">
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
            <input type="number" name="is_admin" id="is_admin" required>
            <br>
        </div>

        <!-- Champs pour les commandes -->
        <div id="commande_fields" class="hidden">
            <label for="id_user">ID Utilisateur :</label>
            <input type="number" name="id_user" id="id_user" required>
            <br>
            <label for="statut">Statut :</label>
            <input type="text" name="statut" id="statut" required>
            <br>
            <label for="date_commande">Date de Commande :</label>
            <input type="datetime-local" name="date_commande" id="date_commande" required>
            <br>
        </div>

        <!-- Champs pour les détails de commande -->
        <div id="commande_details_fields" class="hidden">
            <label for="id_commande">ID Commande :</label>
            <input type="number" name="id_commande" id="id_commande" required>
            <br>
            <label for="id_produit">ID Produit :</label>
            <input type="number" name="id_produit" id="id_produit" required>
            <br>
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite" required>
            <br>
            <label for="prix_total">Prix Total :</label>
            <input type="text" name="prix_total" id="prix_total" required>
            <br>
        </div>

        <button type="submit">Ajouter</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var produitFields = document.getElementById('produit_fields');
            var utilisateurFields = document.getElementById('utilisateur_fields');
            var commandeFields = document.getElementById('commande_fields');
            var commandeDetailsFields = document.getElementById('commande_details_fields');

            function showFields(type) {
                produitFields.classList.add('hidden');
                utilisateurFields.classList.add('hidden');
                commandeFields.classList.add('hidden');
                commandeDetailsFields.classList.add('hidden');

                if (type === 'produit') {
                    produitFields.classList.remove('hidden');
                } else if (type === 'utilisateur') {
                    utilisateurFields.classList.remove('hidden');
                } else if (type === 'commande') {
                    commandeFields.classList.remove('hidden');
                } else if (type === 'commande_details') {
                    commandeDetailsFields.classList.remove('hidden');
                }
            }

            typeSelect.addEventListener('change', function() {
                showFields(this.value);
            });

            // Afficher les champs en fonction du type sélectionné par défaut
            showFields(typeSelect.value);
        });
    </script>
</main>

<?php
include '../includes/footer.php';
?>
