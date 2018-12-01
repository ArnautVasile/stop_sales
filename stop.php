<?php
	require('mysqli_connect.php');

	//$type_of_camera = $_POST['type_of_camera'];
	//$type_of_occupation = $_POST['type_of_occupation'];
	//$nr_of_cams = $_POST['nr_of_cams'];
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
	$sql = "INSERT INTO `stop_sales` (`data_start`, `data_end`, `id_camera_hotel`) VALUES ('$start_day', '$end_day', '$id_camera_hotel')";
	$query = mysqli_query($conn, $sql);
		


	header('Location: diagrama.php');
?>
