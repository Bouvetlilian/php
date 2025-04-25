<?php
// Inclusion du fichier d'initialisation
require_once '../includes/init.php';

// Vérification si un ID est fourni
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$contact = $contactManager->getContactById($id);

// Vérification si le contact existe
if (!$contact) {
    $_SESSION['message'] = 'Contact introuvable.';
    $_SESSION['message_type'] = 'error';
    redirect('index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un contact</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container">
        <h1>Modifier un contact</h1>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="actions/edit_contact.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="favorite" <?php echo $contact['favorite'] ? 'checked' : ''; ?>>
                    Ajouter aux favoris
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Enregistrer</button>
                <a href="index.php">Annuler</a>
            </div>
        </form>
    </div>
</body>

</html>