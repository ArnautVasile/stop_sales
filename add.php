<?php
	require('mysqli_connect.php');
	//print_r($_POST);

	$type_of_camera = $_POST['type_of_camera'];
	$type_of_occupation = $_POST['type_of_occupation'];
	$nr_of_cams = $_POST['nr_of_cams'];
	$name_of_camera = $_POST['name_of_camera'];
	$start_day = $_POST['start_day'];
	$end_day = $_POST['end_day'];

	if($end_day <= $start_day)
	{
		header('Location: add_camera.php?error=1');
		exit;
	}

	if ($nr_of_cams != "0")
	{		
		while ($nr_of_cams != 0)
		{
			$query = "INSERT INTO modify (type_of_camera, type_of_occupation, nr_of_cams, name_of_camera, start_day, end_day) VALUES ('$type_of_camera', '$type_of_occupation', '$nr_of_cams', '$name_of_camera', '$start_day', '$end_day')"; 
			mysqli_query($conn, $query);

			$nr_of_cams--;
		}
	}
	else
	{
		$query = "INSERT INTO modify (type_of_camera, type_of_occupation, nr_of_cams, name_of_camera, start_day, end_day) VALUES ('$type_of_camera', '$type_of_occupation', '$nr_of_cams', '$name_of_camera', '$start_day', '$end_day')"; 
		mysqli_query($conn, $query);
	}


	header('Location: add_camera.php');
?>
