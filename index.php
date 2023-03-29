<?php
require __DIR__ . '/connect.php';

$pdo = new \PDO(DSN, USER, PASS);

  $statement = $pdo->query("SELECT * FROM friend");
  $friends = $statement->fetchAll();
  $errors= [];

if (!empty($_POST)) {
  $firstname =  $_POST['firstname'];
  $lastname = $_POST['lastname'];

  $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
  $statement = $pdo->prepare($query);
  $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
  $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
  $statement->execute();
  header('Location: /');
  exit();
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <ul>
    <?php foreach ($friends as $friend) : ?>
      <li> <?= $friend['firstname'] ?></li>
      <li><?= $friend['lastname'] ?></li>
    <?php endforeach;  ?>
  </ul>

  <form action="/index.php" method="post">
    <div>
      <label for="firstname">Prénom</label>
      <input type="text" id="firstname" name="firstname" placeholder="firstname">
    </div>
    <div>
      <label for="lastname">Nom</label>
      <input type="text" id="lastname" name="lastname" placeholder="lastname">
    </div>
    <button type="submit">Envoyer</button>
  </form>

</body>

</html>