<?php
     session_start();
	 error_reporting(E_PARSE |E_ERROR);
     header("Content-type: text/xml");
	 header('Content-Disposition: attachment; filename='.$_SESSION['basedades'].'|'.$_SESSION['table'].'|'.'AmbDades'.'.xml');
	 header('Pragma:no-cache');
	 readfile("StructureOnly.csv");



	 //connection to bd

	 $link = mysqli_connect($_SESSION['ip'], $_SESSION['username'], $_SESSION['password']);
			if (!$link) {
			die('Could not connect: ' . mysqli_error());
			}
	//echo "---->".$_SESSION['basedades']."----->";
	$db_selected = mysqli_select_db($link,$_SESSION['basedades']);
	if (!$db_selected) {
		die ('Can\'t use mydb : ' . mysqli_error());
	}

	$sql="desc ".$_SESSION['table'];
		//echo $sql;

	$result = mysqli_query($link,$sql);
	if (!$result) {
		die('Invalid query: ' . mysqli_error());
	}

	  //calcular el numero de camps que té la taula

	 $numc= mysqli_num_rows($result);
    echo "<?xml version='1.0'?>";
	echo "\r\n";

	echo "<!DOCTYPE ".$_SESSION['table']."[";
	echo "\r\n";
	echo "\t"."<!ELEMENT registre (";
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

	//inserci� dels registres de la taula.
	$sql="SELECT * FROM ".$_SESSION['table'];
		//echo $sql;

	$result = mysqli_query($link,$sql);
	if (!$result) {
		die('Invalid query: ' . mysqli_error());
	}
	$result = mysqli_query($link,$sql);
	while ($row = mysqli_fetch_array($result)) {

		echo "\t"."<registre>";
		echo "\r\n";

		//escriurem tots els camps del registre

		for ($i = 0; $i < $numc; $i++) {
			echo "\t"."\t"."<".$noms[$i].">";
			echo $row[$i];
			echo "</".$noms[$i].">";
			echo "\r\n";
		}

		echo "\t"."</registre>";
		echo "\r\n";
	}
	echo "</".$_SESSION['table'].">";
?>
