<?php
   session_start();
	 error_reporting(E_PARSE |E_ERROR);
   header("Content-type: text/xml");
	 header('Content-Disposition: attachment; filename='.$_SESSION['basedades'].'|'.$_SESSION['table'].'|'.'AmbDades'.'.xml');
	 header('Pragma:no-cache');
	 readfile("StructureOnly.csv");







   //Comprobar que te pasan todos los parámetros.
   //$_GET['']
   //http://ip/datarequest.php?AS=BCN&AA=GRD&DS=01-01-01&DA=04-01-01&IN=3&AD=3

	 //connection to bd

	 $link = mysqli_connect('localhost', 'root', ''); //poner datos del toni
			if (!$link) {
			die('Could not connect: ' . mysqli_error($link));
			}



	//echo "---->".$_SESSION['basedades']."----->";
	$db_selected = mysqli_select_db($link,cercador);
	if (!$db_selected) {
		die ('Can\'t use mydb : ' . mysqli_error($link));
	}
//Sentencia sql que demana els vols.
	$sql="desc ".aeroportsdefinitiu;
		//echo $sql;

	$result = mysqli_query($link,$sql);
	if (!$result) {
		die('Invalid query: ' . mysqli_error($link));
	}

	  //calcular el numero de camps que té la taula

	 $numc= mysqli_num_rows($result);
    echo "<?xml version='1.0'?>";
	echo "\r\n";

	echo "\t<!DOCTYPE ".aeroportsdefinitiu."[";
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
	echo "<".$_SESSION['table'].">";
	echo "\r\n";

	//inserció dels registres de la taula.
	$sql="SELECT * FROM ".aeroportsdefinitiu;
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

		for ($i = 0; $i < $numc; $i++) {
			echo "\t"."\t"."<".$noms[$i].">";
			echo $row[$i];
			echo "</".$noms[$i].">";
			echo "\r\n";
		}

		echo "\t"."</vol>";
		echo "\r\n";
	}
	echo "</".$_SESSION['table'].">";
?>
