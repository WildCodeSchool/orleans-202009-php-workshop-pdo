<?php
    require 'connec.php';

    // mecanisme d'authentification pour réserver la suppression à un admin

    $pdo = new PDO(DSN, USER, PASSWORD);

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $query = "DELETE FROM story WHERE id=:id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

        $statement->execute();

        header("Location: index.php");
    }
