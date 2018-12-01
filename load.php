<?php

require('mysqli_connect.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<table>
  	<tr>
    	<th>Cam/Zi</th>
    	
      <?php

    		if (empty($_GET))
    		{


    		        //$date = $_GET['start_day']; 
                $last = "SELECT * FROM disponibility ORDER BY id DESC LIMIT 1 ";
                $data = mysqli_query($conn, $last);
                while ($test = mysqli_fetch_array($data, MYSQLI_NUM))
                {
                  //print_r($test);
                  //echo $test[5];
                  $date = $test[3];
                  //$date = "11/28/2018";    
                }
                  //$date = "11/28/2018";    
                $comanda = "SELECT * FROM disponibility";
                $quer = mysqli_query($conn, $comanda);
                $count = mysqli_num_rows($quer);
                if ($count == '0')
                  $date = date('m-d');
        }
    		else
    		{
    			$date = date('m-d'); 
    		}
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
				  $try = 'SELECT * FROM disponibility ORDER BY id_camera ASC';
          $camer = mysqli_query($conn, $try);
          while($num_de_camera = mysqli_fetch_array($camer, MYSQLI_NUM))
          { 
            $new = "SELECT * FROM cameras WHERE id_camera='$num_de_camera[1]'";
            $send = mysqli_query($conn, $new);
            while ($room = mysqli_fetch_array($send, MYSQLI_NUM))
              echo '<tr> <td> '.$room[2].'</td>';   
            
            	if (empty($_GET))
    					 {
    						//$date = $_GET['start_day']; 
    					  $last = "SELECT * FROM disponibility ORDER BY id DESC LIMIT 1 ";
                $data = mysqli_query($conn, $last);
                while ($test = mysqli_fetch_array($data, MYSQLI_NUM))
                {
                  //print_r($test);
                //  echo $test[5];
                  $date = $test[3];
                  //$date = "11/28/2018";    
                }
                 
              }
    					else
			   	 		{
    						$date = date('Y-m-d'); 
    					}
  		 			 	$date1 = str_replace('-', '/', $date); 
              $tomorrow = date('Y-m-d', strtotime($date1 . "+0 days"));
              $i = 15;
                while ($i != 0)
              {
                if  (($tomorrow <= $num_de_camera[4] && $tomorrow >= $num_de_camera[3]))
                {
                  //echo '<td bgcolor="#202020" >'. $tomorrow .'</td>';
                    if ($num_de_camera[5] == "camere la cerere")
                      echo '<td bgcolor="yellow" ></td>';
                    if ($num_de_camera[5] == "camere alotment")
                      echo '<td bgcolor="blue" ></td>';
                    if ($num_de_camera[5] == "camere garantie")
                      echo '<td bgcolor="green" ></td>';
                    //echo '<td bgcolor="#202020" ></td>';                
                  
                  }
                  else
                  {
                    echo '<td> </td>';
                  }
                $date1 = str_replace('-', '/', $date); 
              $tomorrow = date('Y-m-d', strtotime($date1 . "+1 days"));
                $date = $tomorrow;
        
              $i--;
                }
              echo '</tr>';
            }   
        
	?>

	</table>

</body>
</html>