<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
  <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<table>
  	<tr>
    	<th>Cam/Zi</th>
    	
      <?php
    	//	if (!empty($_GET))
    	//	{
    	//		$date = $_GET['start_day']; 
    	//	}
    		//else
    	//	{
    		$date = date('m-d'); 
    	//	}
    		$date1 = str_replace('-', '/', $date); 
        	$tomorrow = date('m-d', strtotime($date1 . "+0 days"));
    		$i = 15;
    		while ($i != 0)
    		{
    			echo '<th>'. $tomorrow .'</th>';
    			$date1 = str_replace('-', '/', $date); 
				  $tomorrow = date('m-d', strtotime($date1 . "+1 days"));
    			$date = $tomorrow;		
    			$i--;

   		 	}
   		?>
	</tr>
 	<?php           
    require('mysqli_connect.php');


    function exist($id_camera_hotel, $date)
    {
      require('mysqli_connect.php');

    //  echo $id_camera_hotel;      
      $sql = 'SELECT * FROM stop_sales';
      $query = mysqli_query($conn, $sql);        
      while ($row = mysqli_fetch_array($query, MYSQLI_NUM))
      {
          if ($row[3] == $id_camera_hotel)
          {
            if ($date <= $row[2] && $date >= $row[1])
              return(0);
          }        
      }
    }

    $try = 'SELECT * FROM disponibility ORDER BY id_camera ASC';
    $camer = mysqli_query($conn, $try);
    while (($num_de_camera = mysqli_fetch_array($camer, MYSQLI_NUM)))
    {
      $new = "SELECT * FROM cameras WHERE id_camera='$num_de_camera[1]'";
      $send = mysqli_query($conn, $new);
      while ($room = mysqli_fetch_array($send, MYSQLI_NUM))
        echo '<tr> <td> '.$room[2].'</td>';         
      $date = date('Y-m-d'); 
      $date1 = str_replace('-', '/', $date); 
      $tomorrow = date('Y-m-d', strtotime($date1 . "+0 days"));
      $i = 15;
      while ($i != 0)
      {
        if ($tomorrow <= $num_de_camera[4] && $tomorrow >= $num_de_camera[3]) 
        {
          //  $val = exist($num_de_camera[2], $tomorrow);
            //print_r($val);
          if ($num_de_camera[5] != "camere garantie")
          {
            if (exist($num_de_camera[2], $tomorrow) == '0')    
              echo '<td bgcolor="black"></td>';
            else if ($num_de_camera[5] == "camere la cerere")
                echo '<td bgcolor="yellow" ></td>';
          
          }
          //if ($num_de_camera[5] == "camere la cerere")
          //  echo '<td bgcolor="yellow" ></td>';
          if ($num_de_camera[5] == "camere alotment")
            echo '<td bgcolor="blue" ></td>';
          if ($num_de_camera[5] == "camere garantie")
            echo '<td bgcolor="green" ></td>';
        }
        else 
        {
          echo '<td></td>';
        }   
        //echo '<td>'. $num_de_camera[2] .'</td>';          
        $date1 = str_replace('-', '/', $date); 
        $tomorrow = date('Y-m-d', strtotime($date1 . "+1 days"));
        $date = $tomorrow;
        $i--;
      }
        //  echo '<td></td>';
        echo '</tr>';
      }
  ?>

</table>

</body>
</html>