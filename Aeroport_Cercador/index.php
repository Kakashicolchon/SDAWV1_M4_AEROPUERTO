10.1.20.28/m4/SDAWV1_M4_AEROPUERTO/
<meta charset="UTF-8">
  <style type="text/css">
      body {
	     }

       input[type=submit] {
			  }

        input[type=submit]:hover {
				}


    </style>

<center>
<?php
//formulari

  $sql="SELECT IATA FROM aerportsdefinitiu";
		//echo $sql;

	$result = mysql_query($sql);
	if (!$result) {
		include("errorinclude.php");
	}

echo "<form action= 'DataRequest.php' method=GET>";

	echo "Salida<br><br>";
  echo "<option value=''>Escoge un aeropuerto</option>";
	while ($row = mysql_fetch_array($result)) {
		echo "<option value='".$row[0]."'>".$row[0]."</option>";
	}
	echo "Llegada<br><br>";
  echo "<option value=''>Escoge un aeropuerto</option>";
  while ($row = mysql_fetch_array($result)) {
    echo "<option value='".$row[0]."'>".$row[0]."</option>";
  }

	echo "<table><tr><td><input type=submit value=LOGIN></td></form></td></tr></table>";

echo"</center>";
?>
