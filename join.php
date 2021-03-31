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

FROM clients
INNER JOIN phones
ON clients.id = phones.client;"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['id'] . ' ' . $row['name'] . ' ' . $row['number'] . "<br>";
}




echo '<h1>Left</h1>';
$sql = "SELECT clients.id as cid, name, phones.id as pid, number

FROM clients
LEFT JOIN phones
ON clients.id = phones.client;"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['cid'] . ' ' . $row['name'] . ' ' . $row['number'] . "<br>";
}



echo '<h1>Right</h1>';
$sql = "SELECT clients.id as cid, name, phones.id as pid, number

FROM clients
RIGHT JOIN phones
ON clients.id = phones.client;"; //db formating

$stmt = $pdo->query($sql); // perdavimas i db, gaunu statement (object)

while ($row = $stmt->fetch()) {
    echo $row['pid'] . ' ' . $row['name'] . ' ' . $row['number'] . "<br>";
}