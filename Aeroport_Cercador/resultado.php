<!doctype html>
<?php
//INICIEM LA SESSIO
	session_start();

	$link = mysqli_connect( '192.168.1.40', 'vols', 'vols','cercador');

	if (!$link) {
					include("errorinclude.php");
				}

  $_SESSION['AS'] = $_GET["AS"];
  $_SESSION['AA'] = $_GET["AA"];
  $_SESSION['DS'] = $_GET["DS"];
	$_SESSION['DA'] = $_GET["DA"];
  $_SESSION['IN'] = $_GET["IN"];
  $_SESSION['AD'] = $_GET["AD"];


  //Actualizamos el formato de la fecha para que sea compatible con el de la base de datos
  $originalDateDS = $_SESSION['DS'];
  $newDateDS = date("Y-m-d", strtotime($originalDateDS));
  //echo $newDateDS;
  $originalDateDA = $_SESSION['DA'];
  $newDateDA = date("Y-m-d", strtotime($originalDateDA));
  //echo $newDateDA;


  //Creamos una carpeta temporal "Searching" donde se guardarán las carpetas de cada persona que le haya dado a buscar(con nombre ID de la sesión) y allí guardamos
  //todos los XML resultado de la busqueda a los servicios Web "DataRequest.php" y luego los unimos en 1 solo XML, lo personalizamos con XLASDASD y lo enseñamos.


	//echo session_id();
	$carpeta="./searching/".session_id();

	//Funcion que se encarga de borrar un directorio recursivamente
	function deleteDirectory($dir) {
	    if(!$dh = @opendir($dir)) return;
	    while (false !== ($current = readdir($dh))) {
	        if($current != '.' && $current != '..') {
	            //echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
	            if (!@unlink($dir.'/'.$current))
	                deleteDirectory($dir.'/'.$current);
	        }
	    }
	    closedir($dh);
	    //echo 'Se ha borrado el directorio '.$dir.'<br/>';
	    @rmdir($dir);
	}



	deleteDirectory($carpeta);
  mkdir($carpeta);


  $sqlConsulta = "SELECT * FROM ips";


  //Haceoms un bucle while para coger el contenido de todos las aerolineas y las guardamos en difetentes archivos en xml, con nombre "VueloX.xml"
  $result = mysqli_query($link,$sqlConsulta);
  $i = 0;
  while ($row = mysqli_fetch_array($result)) {
		//$noms[$i] = $row[0];
    //echo $row[$i];

  	$fichero = $row[0];

		$fichero=$fichero."/DataRequest.php?AS=$_SESSION[AS]&AA=$_SESSION[AA]&DS=$newDateDS&DA=$newDateDA&IN=$_SESSION[IN]&AD=$_SESSION[AD]";
		//echo $fichero;
  	$nuevo_fichero = $carpeta."/vuelo".$i.".xml";
  	//echo $fichero."<br>";
  	//echo $nuevo_fichero."<br>";
  	$contingut=file_get_contents('http://'.$fichero);
  	//echo $contingut;

    //La "x" significa que abre el archivo sólo para escribirlo.
  	$fitxer=fopen($nuevo_fichero,"x");
  	fwrite($fitxer,$contingut);
  	fclose($fitxer);
    $i++;
  }



		//Ara crearem un arxiu on unirem tots els vols i els mostrarem a l'usuari.



?>
