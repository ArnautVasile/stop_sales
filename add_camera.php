<?php
	require('mysqli_connect.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Modificarea disponibilitatii camerei</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="camera.css">


</head>

<body>
	<form method="POST" action="add.php">
		<h2>Modificarea disponibilitatii camerei</h2>
		<br>
		<table>
			<tr>
				<th>
					<span>Tip de camera</span>
				</th>
				<th>
					<span>Tip de ocupare</span>
				</th>
				<th>
					<span>Numarul de Camere</span>
				</th>
				<th>
					<span>Numele Camerei</span>
				</th>
				<th>
					<label for="start">Start date</label>
				</th>
				<th>
					<label for="start">Stop sales date</label>
				</th>
			</tr>
			<tr>	
				<td>
					<select name="type_of_camera">
						<?php 
						$query = 'SELECT tip_de_camera FROM type_of_camera';
						$camera = mysqli_query($conn, $query);

						while ($row = mysqli_fetch_array($camera, MYSQLI_NUM))
						echo '<option name="tipe_of_camera">'.$row[0].'</option>';
						?>
					</select>
				</td>
				<td>
					<select name="type_of_occupation">
						<option>stopsales</option>
						<option>rezervare</option>
						<option>renuntare la camere</option>
						<option>alotment expirate</option>
					</select>
				</td>
				<td>
					<input type="number" value="1" name="nr_of_cams">
				</td>
				<td>
					<select name="name_of_camera">
  					 	<option>camera dubla</option>
						<option>camera dubla cu vedere la mare</option>
						<option>camera la parter</option>
					</select>
				</td>
				<td>
					<?php echo '<input type="date" id="start" name="start_day" value="'. date("Y-m-d") .'" min="'. date("Y-m-d") .'" max="2019-12-31">';?>
      			</td>
				<td>
       				<?php echo '<input type="date" id="start" name="end_day" value="'. date("Y-m-d") .'" min="'. date("Y-m-d") .'" max="2019-12-31">';?>
      			</td>	
				<td>
					<input value="Modifica camera" type="submit" name="submit">
				</td>
			</tr>
		</table>
	</form>
	<p>
		<?php
		if (!empty($_GET['error']))
		{
			$error = $_GET['error'];
			if ($error == 1)
			{
				echo 'End day trebuie sa fie mai mare ca start day ';
			}
		}
		?>
	</p>
</body>
</html>
