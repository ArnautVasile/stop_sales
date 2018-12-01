<?php
	require('mysqli_connect.php');

	$type_of_camera = $_POST['type_of_camera'];
	$type_of_occupation = $_POST['type_of_occupation'];
	$nr_of_cams = $_POST['nr_of_cams'];
	$name_of_camera = $_POST['name_of_camera'];
	$start_day = $_POST['start_day'];
	$end_day = $_POST['end_day'];

	
	$id_hotel = '1';

	$sql = "SELECT id_camera FROM cameras WHERE denumire_camera='$name_of_camera'";
	$query = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_NUM))
	{
		$id_camera = $row[0];
	}

	$sql = "SELECT * FROM max WHERE id_camera='$id_camera' and id_hotel='$id_hotel'";
	$query = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_NUM))
	{
		$id_camera_hotel = $row[0];
	}
	
	$sql = "SELECT * FROM max WHERE id_camera='$id_camera' AND id_hotel='$id_hotel'";
	$query = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_NUM))
	{
		$maxim = $row[3]; 
	}
	$sqli = "SELECT * FROM disponibility WHERE id_camera='$id_camera'";
	$querty = mysqli_query($conn, $sqli);
	$count = mysqli_num_rows($querty);
	
	if ($count >= $maxim && $start_day >= $end_day)
	{
		header('Location: diagrama.php?limit=1&error=2');
		exit;
	}
	else if ($count >= $maxim)
	{
		header('Location: diagrama.php?error=2');
		exit;	
	}
	else if ($start_day >= $end_day)
	{
		header('Location: diagrama.php?limit=1');
		exit;
	}
	else
	{
		if ($nr_of_cams >= $maxim)
			$nr_of_cams = $maxim - $count; 
	}	 
//	if($end_day <= $start_day)
//	{
//		header('Location: add_camera.php?error=1');
//		exit;
//	}

	if ($nr_of_cams != "0")
	{		
		while ($nr_of_cams != 0)
		{
			if ($end_day > $start_day)
			$query = "INSERT INTO disponibility (id_camera, id_camera_hotel, data_start, data_end, tip_alocare) VALUES ('$id_camera', '$id_camera_hotel', '$start_day', '$end_day', '$type_of_camera')"; 
			mysqli_query($conn, $query);

			$nr_of_cams--;
		}
	}
	else
	{
			if ($end_day > $start_day)
			$query = "INSERT INTO disponibility (id_camera, id_camera_hotel, data_start, data_end, tip_alocare) VALUES ('$id_camera', '$id_camera_hotel', '$start_day', '$end_day', '$type_of_camera')"; 
		mysqli_query($conn, $query);
	}

	header('Location: diagrama.php');


?>
