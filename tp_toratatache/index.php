<?php
session_start();

 require_once __DIR__ . '/includes/todos.php';

// Initialiser les tâches si la session n'existe pas encore
// OU si l'action "reset" est demandée
if (!isset($_SESSION['todos']) || (isset($_GET['action']) && $_GET['action'] === 'reset')) {
  $_SESSION['todos'] = $defaultTodos;
}

$todos = &$_SESSION['todos'];

//Ajouter une tâche

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["action"]) && $_POST["action"] === "add" && isset($_POST["task_name"])) {
    $taskName = trim($_POST["task_name"]);
  }

  if (!empty($taskName)) {
    $newId = uniqid();

    $todos[] = [
      "id" => $newId,
      "name" => $taskName,
      "done" => false,
    ];
  }

  header("location: " . $_SERVER['PHP_SELF']).
  exit();
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

        <!--Formulaire pour ajouter une tâche-->

        <form method="POST" action="" class="todo-form">
          <input type="text" name="task_name" placeholder="Ajouter une tâche..." required>
          <input type="hidden" name="action" value="add">
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        
        <ul class="todo-list">
          <?php foreach ($todos as $todo) : ?>
            <li class="todo-item">
              <span class="todo-name <?php echo $todo["done"] ? "low-opacity" : ""; ?>">
                <?php echo $todo["name"]; ?>
              </span>

              <!-- Formulaire pour valider/annuler -->
              <form method="POST" action="toggle-todo.php" style="display: inline;">
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