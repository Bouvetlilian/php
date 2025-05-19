<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    if (isset($_SESSION['todos'])) {
        foreach ($_SESSION['todos'] as &$todo) {
            if ($todo["id"] === $id) {
                $todo["done"] = !$todo["done"];
                break;
            }
        }
    }

    header("location: index.php");
    exit();
} else {
    header("location: index.php");
    exit();
}      

?>