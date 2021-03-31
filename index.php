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

//skaitymas
echo '<h1>Viskas</h1>';
$sql = "SELECT name, height, id FROM trees"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['id'] . ' ' . $row['name'] . ' ' . $row['height'] . "<br>";
}

echo '<h1>Trees 1 </h1>';

$sql = "SELECT name, height, id 
FROM trees
WHERE type = 3 AND height >4
"; //db filter
echo '<h1>lapuociai</h1>';
$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['id'] . ': ' . $row['name'] . ' ' . $row['height'] . "<br>";
}

echo '<h1>Viskas pagal auksti </h1>';
$sql = "SELECT name, height, id FROM trees ORDER BY height DESC"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['id'] . '- ' . $row['name'] . ' ' . $row['height'] . "<br>";
}

// $sql = "SELECT name, height, id 
// FROM trees

// ORDER BY height DESC
// ";
echo '<h1>Lapuociai pagal auksti </h1>';
$sql = "SELECT name, height, id FROM trees WHERE type = 2 ORDER BY height ASC"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['id'] . ': ' . $row['name'] . ' ' . $row['height'] . "<br>";
}

//delete
$sql = "DELETE FROM trees WHERE name='kastonas'";
$pdo->query($sql);

//irasymas
$sql = "SELECT name, height, id 
FROM trees

ORDER BY height ASC
";

$sql = "INSERT INTO trees (id, name, height, type)
VALUES (5,'visnia', 5.9, 2)"; // suformuojam
$pdo->query($sql); //perduodam i db


// update
$sql = "UPDATE trees SET height=19.10  WHERE name='beržas'";
$pdo->query($sql); //perduodam i db
