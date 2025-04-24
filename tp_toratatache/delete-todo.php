<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    
    if (isset($_SESSION['todos'])) {
        // Créer un nouveau tableau sans la tâche à supprimer
        $newTodos = [];
        foreach ($_SESSION['todos'] as $todo) {
            if ($todo["id"] !== $id) {
                $newTodos[] = $todo;
            }
        }
        
        // Remplacer l'ancien tableau par le nouveau
        $_SESSION['todos'] = $newTodos;
    }
    
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>