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


//read
echo '<h1>Inner</h1>';
$sql = "SELECT *

FROM trees
INNER JOIN types
ON types.id = trees.type; 



"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['type'] . '-- ' . $row['name'] . ' ' . $row['height'] . ' -- ' . $row['id'] . "<br>";
}
echo '<h1>LEFT</h1>';
$sql = "SELECT *

FROM trees
LEFT JOIN types
ON types.id = trees.type; 



"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['type'] . '-- ' . $row['name'] . ' ' . $row['height'] . ' -- ' . $row['id'] . "<br>";
}
echo '<h1>RIGHT</h1>';
$sql = "SELECT *

FROM trees
RIGHT JOIN types
ON types.id = trees.type; 



"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['type'] . '-- ' . $row['name'] . ' ' . $row['height'] . ' -- ' . $row['id'] . "<br>";
}
echo '<h1>NEW</h1>';
$sql = "SELECT trees.id as tid, name, height, 
types.type as tt 
FROM trees
RIGHT JOIN types
ON types.id = trees.type
ORDER BY  height

"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['tid'] . '-- ' . $row['tt'] . ' --' . $row['height'] . "<br>";
}