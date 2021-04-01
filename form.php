<?php

$host = '127.0.0.1';
$db = 'forest';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (!empty($_POST)) {
    if ('add' == $_POST['action']) {

        $sql = "INSERT INTO trees ( name, height, type)
        VALUES (:name, :h, :type )"; // suformuojam
        $stmt = $pdo->prepare($sql); //perduodam i db
        $stmt->execute([
            'name' => $_POST['name'],
            'h' => $_POST['height'],
            'type' => $_POST['type']
        ]); //perduodam i db

        header('Location: http://localhost/zuikis-main/box2/db/form.php');
    }
}

//delete
if ('delete' == $_POST['action']) {

    $sql = "DELETE FROM trees WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['id']
    ]);
}



?>
<form action="" method="post">
    Name: <input type="text" name="name">
    Type: <input type="text" name="type">
    Height: <input type="text" name="height">
    <button type="submit" name="action" value="add">Plant a tree</button>
</form>
<form action="" method="post">

    id: <input type="text" name="id">
    <button type="submit" name="action" value="delete">delete</button>
</form>

<?php
echo '<h1>Viskas</h1>';
$sql = "SELECT name, height, id FROM trees"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['id'] . ' ' . $row['name'] . ' ' . $row['height'] . "<br>";
}