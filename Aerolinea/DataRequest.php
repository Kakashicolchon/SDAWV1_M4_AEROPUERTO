<?php
   session_start();

   //$_SESSION['AS'] = $_GET["AS"];
   //$_SESSION['AA'] = $_GET["AA"];

	 error_reporting(E_PARSE |E_ERROR);
   header("Content-type: text/xml");
	 header('Content-Disposition: attachment; filename='.'Aerolinea'.'.xml');
	 header('Pragma:no-cache');
	 readfile("StructureOnly.csv");

   //Coger variables (GET)





   //Comprobar que te pasan todos los parámetros.
   //$_GET['']7
   //http://ip/datarequest.php?AS=BCN&AA=GRD&DS=01-01-01&DA=04-01-01&IN=3&AD=3
//SELECT * FROM vols WHERE AS='AAR' AND AA='ABD'Invalid query:
	 //connection to bd
                          //poner ip del toni
	 $link = mysqli_connect('127.0.0.1', 'vol', 'vol', 'pinpoinairlines'); //poner datos del toni
			if (!$link) {
			die('Could not connect: ' . mysqli_error($link));
			}



	//echo "---->".$_SESSION['basedades']."----->";
//Sentencia sql que demana els vols.
	$sql="desc ".vols;
		//echo $sql;

	$result = mysqli_query($link,$sql);
	if (!$result) {
		die('Invalid query: ' . mysqli_error($link));
	}

	  //calcular el numero de camps que té la taula

	 $numc= mysqli_num_rows($result);
    echo "<?xml version='1.0'?>";
	echo "\r\n";

	echo "\t<!DOCTYPE ".vols."[";
	echo "\r\n";
	echo "\t"."<!ELEMENT vol (";
	$result=mysqli_query($link,$sql);
	$cmpt=0;
	while ($row = mysqli_fetch_array($result)) {

		if ($cmpt < $numc-1){
		echo $row[0].", ";
		} else {
		echo $row[0];
		}
		$cmpt++;
	}
//<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

	echo ")>";
	echo "\r\n";
	$result = mysqli_query($link,$sql);
	$numero=0;
	while ($row = mysqli_fetch_array($result)) {
		echo "\t"."<!ELEMENT ".$row[0]." (#PCDATA)>";
		// Taula amb els camps del registre.
		$noms[$numero] = $row[0];
		$numero++;
		echo "\r\n";
	}



	echo "]>";
	echo "\r\n";
	echo "<".vols.">";
	echo "\r\n";
  //$_GET["AS"]
	//inserció dels registres de la taula.
	$sql="SELECT * FROM ".vols." WHERE AS1='".$_GET["AS"]."' AND AA='".$_GET["AA"]."' AND DS='".$_GET["DS"]."' AND DA='".$_GET["DA"]."' AND IN1='".$_GET["IN"]."' AND AD='".$_GET["AD"]."'";
	//echo $sql;

	$result = mysqli_query($link,$sql);
	if (!$result) {
		die('Invalid query: ' . mysqli_error());
	}
	$result = mysqli_query($link,$sql);
	while ($row = mysqli_fetch_array($result)) {

		echo "\t"."<vol>";
		echo "\r\n";

		//escriurem tots els camps del registre

    /*
		for ($i = 0; $i < $numc-1; $i++) {
			echo "\t"."\t"."<".$noms[$i].">";
			echo $row[$i];
			echo "</".$noms[$i].">";
			echo "\r\n";
		}
    */

		echo "\t"."\t"."<AS>".$row[0]."</AS>";
		echo "\r\n";
		echo "\t"."\t"."<AA>".$row[1]."</AA>";
		echo "\r\n";
		echo "\t"."\t"."<DS>".$row[2]."</DS>";
		echo "\r\n";
		echo "\t"."\t"."<DA>".$row[3]."</DA>";
		echo "\r\n";
		echo "\t"."\t"."<IN>".$row[4]."</IN>";
		echo "\r\n";
		echo "\t"."\t"."<AD>".$row[5]."</AD>";
		echo "\r\n";




		echo "\t"."</vol>";
		echo "\r\n";
	}
	echo "</".vols.">";
  //echo "</".$_SESSION['table'].">";
?>
