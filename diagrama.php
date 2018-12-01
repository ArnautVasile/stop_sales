<?php
require('mysqli_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>refresh</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js">
  </script>
  <script>
    $(document).ready(function() {
      $("button").click(function() {
        $('#comments').load("load.php");
      });
    });
  </script>
  <script>
   // $(document).ready(function(){
    
  //  $("#data").hide();
    
  //  $("button").click(function() {
//      
    //  var date1 = $('#start').val().split("-");
   //   console.log(date1, $('#start').val())
   //   day1 = date1[2];
   //   month1 = date1[1];
   //    year1 = date1[0];
   //   
   //       var date = $('#end').val().split("-");
   //   console.log(date, $('#date-input').val())
   //  day = date[2];
   //   month = date[1];
    //  year = date[0];
   //  if (day1 >= day || month1 > month)
   //   $("#data").show();
   //    else
   //  $("#data").hide();
   //   });
   // });

  </script>
</head>
<body>

<form method="POST" id="myForm" action="add_temp.php">
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
            <option>camere la cerere</option>
            <option>camere garantie</option>
            <option>camere alotment</option>
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
          <input type="number" value="1" name="nr_of_cams" required>
        </td>
        <td>
          <select name="name_of_camera">
            <?php 
            $id_hotel = '1';
            $querty = "SELECT * FROM max WHERE id_hotel='$id_hotel'";
            $camer = mysqli_query($conn, $querty);
            while ($ro = mysqli_fetch_array($camer, MYSQLI_NUM))
            {
              $sql = "SELECT * FROM cameras WHERE id_camera='$ro[2]'";
              $sqli = mysqli_query($conn, $sql);
              while ($rez = mysqli_fetch_array($sqli, MYSQLI_NUM)) 
                echo '<option name="name_of_camera">'.$rez[2].'</option>';
            }
            ?>
          </select>
        </td>
        <td>
          
          <div id="startt"><?php echo '<input type="date" id="start" name="start_day" value="'. date("Y-m-d") .'" min="'. date("Y-m-d") .'" max="2019-12-31">';?></div>
            </td>
        <td>  
            <div id="endd">
              <?php echo '<input type="date" id="end" name="end_day" value="'. date("Y-m-d") .'" min="'. date("Y-m-d") .'" max="2019-12-31">';?>
              </div>
            </td> 
          <!--<input type="date" id="start" name="end_day" value="'. date()" min="2018-01-01" max="2018-12-31">-->
        <td>
          <!--<input id="sub" value="Modifica camera" type="submit" name="submit">-->
          <button id="sub">Save</button>
        </td>
      </tr>
    </table>
    </form>
<br>
<form method="POST" action="stop.php">
<h2>Stop sales</h2>
    <table>
      <tr>
        <th>
          <span>Numele camerei</span>
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
          <select name="name_of_camera">
            <?php 
            $id_hotel = '1';
            $querty = "SELECT * FROM max WHERE id_hotel='$id_hotel'";
            $camer = mysqli_query($conn, $querty);
            while ($ro = mysqli_fetch_array($camer, MYSQLI_NUM))
            {
              $sql = "SELECT * FROM cameras WHERE id_camera='$ro[2]'";
              $sqli = mysqli_query($conn, $sql);
              while ($rez = mysqli_fetch_array($sqli, MYSQLI_NUM)) 
                echo '<option name="name_of_camera">'.$rez[2].'</option>';
            }
            ?>
          </select>
        </td>
        <td>
          
          <div id="startt"><?php echo '<input type="date" id="start" name="start_day" value="'. date("Y-m-d") .'" min="'. date("Y-m-d") .'" max="2019-12-31">';?></div>
            </td>
        <td>  
            <div id="endd">
              <?php echo '<input type="date" id="end" name="end_day" value="'. date("Y-m-d") .'" min="'. date("Y-m-d") .'" max="2019-12-31">';?>
              </div>
            </td> 
          <!--<input type="date" id="start" name="end_day" value="'. date()" min="2018-01-01" max="2018-12-31">-->
        <td>
          <!--<input id="sub" value="Modifica camera" type="submit" name="submit">-->
          <button id="save">Save</button>
        </td>
      </tr>
    </table>
</form>
  <br>
<?php
  if (!empty($_GET['error']))
  {
    if ($_GET['error'] == '2')
      echo '<p>Nu mai sunt camere libere de acest fel.</p>';
  }
  if (!empty($_GET['limit']))
  {
    if ($_GET['limit'] == '1')
    echo '<p id="data">Stop sales date trebuie sa fie mai mare ca start day</p>';
  }

?>
  <div id="comments">
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
</div>
<!--<script src="http://code.jquery.com/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
-->
</body>
</html>