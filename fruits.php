<!--
Name: Angelena Ward
Class: Server-Side Languages
Assignment: Fruit DB API
Date: April 23, 2015
-->

<?php
$user = "root";
$pass = "root";
$dbh = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$fruitname = $_POST['fruitname'];
	$fruitcolor = $_POST['fruitcolor'];
	$stmt = $dbh->prepare("INSERT INTO fruits (fruitname, fruitcolor) VALUES (:fruitname, :fruitcolor);");
	$stmt->bindParam(':fruitname', $fruitname);
	$stmt->bindParam(':fruitcolor', $fruitcolor);
	$stmt->execute();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Fruits Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body><center>
	<img src="img/fruits.png" width='100%'>
	<h1><font color="a3bb59">Angelena's Fruit DB</h1>
	<section id="addfruit">

	<form action="fruits.php" method="POST">
		<label>Fruit Name: 
			<input type="text" name="fruitname" value="" placeholder="" required>
		</label>
		<label>Fruit Color: 
			<input type="text" name="fruitcolor" value="" placeholder="" required>
		</label></br>
		<label>Fruit Image: 
			<input type="text" name="fruitimage" value="" placeholder="" required>
		</label>
		<input type="submit" name="submit" value="Submit">

	</form>
	<table>
	 	<tr>
			<th>Fruit ID</th>
			<th>Fruit Name</th>
			<th>Fruit Color</th>
			<th>Fruit Image</th>
			<th>Delete</th>
		</tr>	

		<?php
		$stmt = $dbh->prepare('SELECT id, fruitname, fruitcolor FROM fruits;');
		$stmt->execute();
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		foreach($result as $row){
			echo 
				'<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['fruitname'].'</td>
					<td>'.$row['fruitcolor'].'</td>
					<td>'.$row['fruitimage'].'</td>
					<td> <a href="deletefruit.php?id='.$row['id'].'">Delete</a></td>
				</tr>';
		}	
		?>

	</table>
</body>
</html>