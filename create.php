<?php
    require 'connec.php';

    $pdo = new PDO(DSN, USER, PASSWORD);

    if($_SERVER["REQUEST_METHOD"] === "POST") {
//        foreach($_POST as $name=>$value) {
//            $data[$name] = trim($value);
//        }
        $data = array_map('trim', $_POST);

        if(empty($data['title'])) {
            $errors[] = 'Le titre ne doit pas être vide';
        }
        $maxLength = 255;
        if(strlen($data['title']) > $maxLength) {
            $errors[] = 'Le titre doit faire moins de ' . $maxLength . ' caractères';
        }

        if(strlen($data['author']) > $maxLength) {
            $errors[] = 'Le nom de l\auteur doit faire moins de ' . $maxLength . ' caractères';
        }

        if(!empty($errors)) {
            var_dump($errors);
        } else {
            // insert en bdd
            $query = "INSERT INTO story (title, author, description) VALUES (:title, :author, :description)";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
            $statement->bindValue(':author', $data['author'], PDO::PARAM_STR);
            $statement->bindValue(':description', $data['description'], PDO::PARAM_STR);

            $statement->execute();
            // redirection

            header("Location: index.php");
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout histoire</title>
</head>
<body>
<h1>Ajout histoire</h1>

<form action="" method="POST">
    <div>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" value="<?= $data['title'] ?? '' ?>">
    </div>
    <div>
        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" value="<?= $data['author'] ?? '' ?>">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description"><?= $data['description'] ?? '' ?></textarea>
    </div>
    <button>Créer</button>
</form>
</body>
</html>
