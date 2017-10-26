<?php 
// Fruit Ads API
$content = file_get_contents("http://localhost:8888/fruit_DB/fruitget.php");
$contents = json_decode($content);

// PDO connection
$user = "root";
$pass = "root";
$dbh   = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	// echo "This is a POST Method";
	$fruitname  = $_POST['fruitname'];
	$fruitcolor = $_POST['fruitcolor'];
	$fruitimage = $_POST['fruitimage'];
	$stmt = $dbh->prepare("INSERT INTO fruits (fruitname, fruitcolor, fruitimage) VALUES (:fruitname, :fruitcolor, :fruitimage);");
	
	$stmt->bindParam(':fruitname', $fruitname);
	$stmt->bindParam(':fruitcolor', $fruitcolor);
	$stmt->bindParam(':fruitimage', $fruitimage);
	$stmt->execute();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Fruits Database API</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body><center>

	<img src="img/fruits.png" width='100%'>
	<h1><font color="a3bb59">Angelena's Fruit DB</h1>
	<section id="addfruit">

		<form action="ads.php" method="POST">
			<label>Fruit Name: 
				<input type="text" name="fruitname" value="" placeholder="" required>
			</label>
			<label>Fruit Color: 
				<input type="text" name="fruitcolor" value="" placeholder="" required>
			</label>
			<label>Fruit Image: 
				<input type="text" name="fruitimage" value="" placeholder="website.com/image.jpg" required>
			</label>
			<input type="submit" name="submit" value="Submit">

		</form>
	</section>
	<section id="manage-fruit">
		<div class="col-xs-4" id="fruitad">
			<h2>The Fruit of the Day</h2>
			<h4><?= $contents->fruitcolor; ?> <?= $contents->fruitname; ?></h4>
			<img src="<?= $contents->fruitimage; ?>">
		</div>
		<table>
			<tr>
				<th>Fruit ID</th>
				<th>Fruit Name</th>
				<th>Fruit Color</th>
				<th>Fruit Image</th>
				<th>Delete</th>
			</tr>

			<!-- query and print fruit; (delete) -->
			<?php 
			$stmt = $dbh->prepare('SELECT * FROM fruits;');
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
		</section>	
	</body></table>
</html>