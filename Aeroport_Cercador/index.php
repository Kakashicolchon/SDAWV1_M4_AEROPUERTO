<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>jQuery UI Datepicker - Entrada de texto</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jquery.ui.datepicker-es.js"></script>
<script>
$(function () {
$.datepicker.setDefaults($.datepicker.regional["es"]);
$("#datepicker").datepicker({
firstDay: 1
});
$("#datepicker1").datepicker({
firstDay: 1
});
});
</script>
<style type='text/css'>
  #cajaBusqueda {
    margin-top:150px;
    width:auto;
    height:auto;
    background:#fafafa;
    color:#0a0a0a;
    font-family:verdana;
  }
</style>
</head>

<body>

<center>
<?php
//comencem la sessió
//10.1.16.219
session_start();

	$link = mysqli_connect( '127.0.0.1', 'vols', 'vols','cercador');

	if (!$link) {
					include("errorinclude.php");
				}


//formulari

  $sql="SELECT IATA,concat_ws('-',IATA,City) FROM aeroportsdefinitiu ORDER BY IATA";
		//echo $sql;

	$result = mysqli_query($link,$sql);
	if (!$result) {
		include("errorinclude.php");
	}

  echo "<div id='cajaBusqueda'><table><tr><td><form action= 'DataRequest.php' method=GET>";

	echo "<div class='titSeccio'>Desde</div>";
  echo "<select name=AS>";
  echo "<option value=''>Escoja un aeropuerto</option>";
	while ($row = mysqli_fetch_array($result)) {
		echo "<option value='".$row[0]."'>".$row[1]."</option>";
	}
  echo "</select></td>";
	echo "<td><div class='titSeccio'>A</div>";
  $result = mysqli_query($link,$sql);
  if (!$result) {
    include("errorinclude.php");
  }
  echo "<select name=AA>";
  echo "<option value=''>Escoja un aeropuerto</option>";
  while ($row = mysqli_fetch_array($result)) {
    echo "<option value='".$row[0]."'>".$row[0]."</option>";
  }
  ?>
</select>
</td></td>
      <td>
      Fecha de ida<br>
      <input type="text" id="datepicker" />
      </td>
      <td>
      Fecha de vuelta<br>
      <input type="text" id="datepicker1" />
      </td>
  <?php
  echo"<td>Billete infantil<br>";
  echo"<select name=Billete>";
  echo"<option value='IN'>Número de billetes</option>";
  echo"<option value=''>0</option>";
  echo"<option value=''>1</option>";
  echo"<option value=''>2</option>";
  echo"<option value=''>3</option>";
  echo"<option value=''>4</option>";
  echo"<option value=''>5</option>";
	echo"<option value=''>6</option>";
	echo"<option value=''>7</option>";
  echo"<option value=''>8</option>";

  echo"<td>Billete adulto<br>";
  echo"<select name=Billete>";
  echo"<option value='IN'>Número de billetes</option>";
  echo"<option value=''>0</option>";
  echo"<option value=''>1</option>";
	echo"<option value=''>2</option>";
	echo"<option value=''>3</option>";
	echo"<option value=''>4</option>";
	echo"<option value=''>5</option>";
	echo"<option value=''>6</option>";
	echo"<option value=''>7</option>";
	echo"<option value=''>8</option>";
  echo"</td></tr></table>";
  echo"</td></tr></table><input type=submit value=BUSCA></div>";
  echo"</center>";
  ?>
