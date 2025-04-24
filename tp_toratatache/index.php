<?php
session_start();

$defaultTodos = [
  ["id" => "a7749a0f-cf14-4b95-9864-8893c695bcaf", "name" => "apprendre le HTML", "done" => false],
  ["id" => "28c7bc7b-c389-4962-a6bc-3be459b62fc0", "name" => "apprendre le JS", "done" => false],
  ["id" => "d264692e-a9b9-4e30-a11f-7a7c210c7ff2", "name" => "apprendre le PHP", "done" => false],
  ["id" => "f5454d36-53ec-473c-a083-0f309eb92b40", "name" => "coder, coder, coder", "done" => false],
];

// Initialiser les tâches si la session n'existe pas encore
// OU si l'action "reset" est demandée
if (!isset($_SESSION['todos']) || (isset($_GET['action']) && $_GET['action'] === 'reset')) {
  $_SESSION['todos'] = $defaultTodos;
}

$todos = &$_SESSION['todos'];

// Traiter les actions de validation/annulation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["action"]) && $_POST["action"] === "toggle" && isset($_POST["id"])) {
    $id = $_POST["id"];
    
    foreach ($todos as &$todo) {
      if ($todo["id"] === $id) {
        $todo["done"] = !$todo["done"];
        break;
      }
    }
    
    // Rediriger pour éviter la soumission multiple
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/includes/head.php' ?>
<title>ToraTaTache</title>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/includes/header.php' ?>
    <div class="content">
      <div class="todo-container">

        <h1>Mes tâches</h1>
        
        <!-- Bouton pour réinitialiser toutes les tâches -->
        <div style="text-align: right; margin-bottom: 20px;">
          <a href="?action=reset" class="btn btn-small">Réinitialiser les tâches</a>
        </div>

        <ul class="todo-list">
          <?php foreach ($todos as $todo) : ?>
            <li class="todo-item">
              <span class="todo-name <?php echo $todo["done"] ? "low-opacity" : ""; ?>">
                <?php echo $todo["name"]; ?>
              </span>

              <!-- Formulaire pour valider/annuler -->
              <form method="POST" action="" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $todo["id"]; ?>">
                <input type="hidden" name="action" value="toggle">
                <button type="submit" class="btn btn-primary btn-small">
                  <?php echo $todo["done"] ? "annuler" : "valider"; ?>
                </button>
              </form>

              <!-- Formulaire pour supprimer -->
              <form method="POST" action="delete-todo.php" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $todo["id"]; ?>">
                <button type="submit" class="btn btn-danger btn-small">
                  Supprimer
                </button>
              </form>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <?php require_once __DIR__ . '/includes/footer.php' ?>

  </div>
</body>

</html>