<?php
	session_start();
	//id de estudiante y asignatura que es pasado por session
	$id_Asignatura=$_SESSION['ID_asignatura'];
	$id_estudiante=$_SESSION['ID_estudiante'];

	//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
	if($conexion)
	{
		//Consulta para conseguir los temas que tiene una asignatura
		$consulta="SELECT nombre FROM estudiante WHERE ID_estudiante=$id_estudiante";
		$consulta2="SELECT nombre from asignatura WHERE ID_asignatura=$id_Asignatura";
		$consulta3="SELECT estudiante_examen.Nota, tema.nombre FROM estudiante_examen, examen, tema WHERE estudiante_examen.ID_estudiante=$id_estudiante AND tema.ID_asignatura=$id_Asignatura AND estudiante_examen.ID_examen=examen.ID_examen AND examen.ID_tema=tema.ID_tema";

		$resultado=mysqli_query($conexion,$consulta);
		$resultado2=mysqli_query($conexion,$consulta2);
		$resultado3=mysqli_query($conexion,$consulta3);
	}
	else
	{
		echo "<h2>Error de conexion con la Base de datos</h2>";
	}

	$nombre_alumno=mysqli_fetch_row($resultado);
	$nombre_Asignatura=mysqli_fetch_row($resultado2);

	//Creamos vectores vacios para almacenar los id de examenes que ha realizado el alumno y la nota en ese examen
	$temas=array();
	$nota=array();

	//Almacenamos en los vectores anteriores los datos almacenado en la Base de Datos
	while($row=mysqli_fetch_row($resultado3))
	{
		array_push($nota,$row[0]);
		array_push($temas, $row[1]);
	}

	mysqli_close($conexion);
	//Mostramos los resultados
	echo "<h2>Resultados de la asignatura: ";
	echo $nombre_Asignatura[0];
	echo "</h2>";
	
	$i=0;
	$j=0;
	if(count($temas) === 0)
	{
		echo "No hay resultados que mostrar";
	}
	else
	{
		echo "<table border=1>";
		echo '<tr bgcolor=#091DFB>
			<td style = "width: 140px; text-align: center">
				<p style=color:white>Nombre del Tema</p>
			</td>
			<td style = "width: 140px; text-align: center">
				<p style=color:white>Nota del examen</p>
			</td>
			</tr>';

		while($i<count($temas))
		{
		echo "<tr bgcolor=#C0C0C0>";
		
		echo '<td style = "text-align: center">';
		echo $temas[$j];
		echo "</td>";
		echo '<td style = "text-align: center">';
		echo $nota[$j];
		echo "</td>";
		$j++;
		
		echo "</tr>";
		$i++;
		}
		echo "</table>";
	}
	
	echo "<br>";
	echo "<br>";
	echo "<a href = '../Login/indexEst.php?id=$id_Asignatura'><input type = 'button' value = 'Volver'></a>";
?>

<!DOCTYPE html>
<head>
	<title>Resultados</title>
</head>
</html>