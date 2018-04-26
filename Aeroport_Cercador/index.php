<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Comparador de vols 1.0</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="jquery.ui.datepicker-es.js"></script>

    <script>
      $(function () {
      $.datepicker.setDefaults($.datepicker.regional["es"]);
      $("#datepicker").datepicker({
      firstDay: 1,
      onSelect: function (DS) {
      },
      });
      });
    </script>
  </head>

  <body>
    Fecha:
    <input type="text" id="datepicker" />
    <div id="datepicker"></div>
  </body>
</html>

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
//comencem la sessió
session_start();

	$link = mysqli_connect( '127.0.0.1', 'vols', 'vols','cercador');

	if (!$link) {
					include("errorinclude.php");
				}


//formulari

  $sql="SELECT IATA FROM aeroportsdefinitiu ORDER BY IATA";
		//echo $sql;

	$result = mysqli_query($link,$sql);
	if (!$result) {
		include("errorinclude.php");
	}

echo "<form action= 'DataRequest.php' method=GET>";

	echo "Salida<br><br>";
  echo "<select name=AS>";
  echo "<option value=''>Escoja un aeropuerto</option><br>";
	while ($row = mysqli_fetch_array($result)) {
		echo "<option value='".$row[0]."'>".$row[0]."</option>";
	}
  echo "</select>";
	echo "Llegada<br><br>";

  $result = mysqli_query($link,$sql);
  if (!$result) {
    include("errorinclude.php");
  }


  echo "<select name=AA>";
  echo "<option value=''>Escoja un aeropuerto</option>";
  while ($row = mysqli_fetch_array($result)) {
    echo "<option value='".$row[0]."'>".$row[0]."</option>";
  }
  echo "</select>";
	echo "<table><tr><td><input type=submit value=LOGIN></td></form></td></tr></table>";

echo"</center>";
?>
