<?php
// Inclusion du fichier d'initialisation
require_once '../includes/init.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un contact</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container">
        <h1>Ajouter un contact</h1>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="actions/create_contact.php">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="favorite">
                    Ajouter aux favoris
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Ajouter</button>
                <a href="index.php">Annuler</a>
            </div>
        </form>
    </div>
</body>

</html>