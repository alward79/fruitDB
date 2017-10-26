<!--
Name: Angelena Ward
Class: Server-Side Languages
Assignment: Fruit DB API
Date: April 23, 2015
-->

<?php 
header("Content-type:application/json");

$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);
$sql = 'SELECT * FROM fruits ORDER BY RAND() LIMIT 1;';
$stmnt = $dbh->prepare($sql);
$stmnt->execute();
$result = $stmnt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>