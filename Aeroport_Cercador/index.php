<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Comparador de vols</title>
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
  body {
    background:url(https://i.imgur.com/3AOydxb.jpg?1);
    }

  #cajaBusqueda {
    margin-top:150px;
    width:auto;
    height:auto;
    background:rgba(255,255,255, 0.4);
    color:#0a0a0a;
    font-family:verdana;
    padding:40px 0px 40px 0px;
    -webkit-background-clip: padding-box;
		background-clip: padding-box;
  }

  input[type=submit] {
    background-color: #f4511e;
    border: none;
    color: white;
    padding: 10px;
    text-align: center;
    font-size: 16px;
    opacity: 0.6;
    transition: 0.5s;
  }
  input[type=submit]:hover{
    opacity:1;
  }

  select,input {
    border:0;
    padding:5px;
  }
  input {
    padding:6px;
  }
</style>
</head>

<body>

<center>
<?php
//comencem la sessió
//10.1.29.174
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

  echo "<div id='cajaBusqueda'><table><tr><td><form action= '../Aeroport_Cercador/resultado.php' method=GET>";

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
    echo "<option value='".$row[0]."'>".$row[1]."</option>";
  }
  ?>
</select>
</td></td>
      <td>
      Fecha de ida<br>
      <input type="text" name=DS id="datepicker" />
      </td>
      <td>
      Fecha de vuelta<br>
      <input type="text" name=DA id="datepicker1" />
      </td>
  <?php
  echo"<td>Billete infantil<br>";
  echo"<select name=IN>";
  echo"<option value=''>Número de billetes</option>";
  echo"<option value='0'>0</option>";
  echo"<option value='1'>1</option>";
  echo"<option value='2'>2</option>";
  echo"<option value='3'>3</option>";
  echo"<option value='4'>4</option>";
  echo"<option value='5'>5</option>";
	echo"<option value='6'>6</option>";
	echo"<option value='7'>7</option>";
  echo"<option value='8'>8</option>";

  echo"<td>Billete adulto<br>";
  echo"<select name=AD>";
  echo"<option value=''>Número de billetes</option>";
  echo"<option value='0'>0</option>";
  echo"<option value='1'>1</option>";
	echo"<option value='2'>2</option>";
	echo"<option value='3'>3</option>";
	echo"<option value='4'>4</option>";
	echo"<option value='5'>5</option>";
	echo"<option value='6'>6</option>";
	echo"<option value='7'>7</option>";
	echo"<option value='8'>8</option>";
  echo"</td></tr></table>";
  echo"<br>";
  echo"</td></tr></table><input type=submit value=BUSCA></div>";
  echo"</center>";
  ?>
