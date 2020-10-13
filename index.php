<?php
require 'connec.php';

$pdo = new PDO(DSN, USER, PASSWORD);

$statement = $pdo->query("SELECT * FROM story");
$stories = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des histoires</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Liste des histoires</h1>
<main class="stories">
<?php

foreach ($stories as $story) : ?>
    <div>
        <h2><?= $story['title'] ?></h2>
        <p><?= $story['description'] ?></p>
        <div><?= $story['author'] ?></div>
        <a href="edit.php?id=<?= $story['id'] ?>">Editer</a>
        <form action="delete.php" method="POST">
            <input type="hidden" name="id" value="<?= $story['id'] ?>">
            <button>Supprimer</button>
        </form>
    </div>
<?php endforeach ?>
</main>
</body>
</html>
