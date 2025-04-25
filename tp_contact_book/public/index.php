<?php
// Inclusion du fichier d'initialisation
require_once '../includes/init.php';

// Récupération de tous les contacts
$contacts = $contactManager->getAllContacts();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Carnet de contacts</title>
</head>

<body>
    <div class="container">
        <h1>Carnet de contacts</h1>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <a href="create.php" class="btn">Ajouter un contact</a>

        <?php if (empty($contacts)): ?>
            <p>Aucun contact dans le carnet.</p>
        <?php else: ?>
            <table class="contact-list">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Favori</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $id => $contact): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($contact['name']); ?></td>
                            <td><?php echo htmlspecialchars($contact['email']); ?></td>
                            <td><?php echo $contact['favorite'] ? '<span class="star">★</span>' : ''; ?></td>
                            <td class="actions">
                                <a href="edit.php?id=<?php echo $id; ?>">Modifier</a>
                                <a href="actions/delete_contact.php?id=<?php echo $id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>