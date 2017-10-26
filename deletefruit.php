<!--
Name: Angelena Ward
Class: Server-Side Languages
Assignment: Fruit DB App
Date: April 16, 2015
-->
<?php
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost;dbname=ssl;port=8889', $user, $pass);
$fruitid = $_GET['id'];
$stmt = $dbh->prepare("DELETE FROM fruits where id IN (:fruitid)");
$stmt->bindParam(':fruitid', $fruitid);
$stmt->execute();
header('Location: http://localhost:8888/fruit_DB/ads.php');//redirect us back to the fruits page
die();
?>