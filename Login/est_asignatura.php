
<?php
$conexion = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD"); 
session_start();
$id_estudiante=$_SESSION['ID_estudiante'];
$nombre_estudiante = $_SESSION['Nombre_estudiante'];
if($conexion)
{
	//Consulta para conseguir los temas que tiene una asignatura
	$consulta="SELECT ID_asignatura FROM asignatura_alumno WHERE ID_estudiante=$id_estudiante";
	$resultado=mysqli_query($conexion,$consulta);
			
}
else
{
	echo "<h2>Error de conexion con la Base de datos</h2>";
}
	
//Creamos vectores vacios para almacenar los id de examenes que ha realizado el alumno y la nota en ese examen
$id_asignaturas=array();

//Almacenamos en los vectores anteriores los datos almacenado en la Base de Datos
while($row=mysqli_fetch_row($resultado))
{
	array_push($id_asignaturas,$row[0]);
}

//Creamos un vector vacio para almacenar el id del tema al que pertenecen los examenes que ha realizado el alumno
$nombres=array();

foreach($id_asignaturas as $id)
{
	if($conexion)
	{
		$consulta2="SELECT nombre FROM asignatura WHERE ID_asignatura=$id";
		$resultado2=mysqli_query($conexion,$consulta2);

		while($row=mysqli_fetch_row($resultado2))
		{
			array_push($nombres, $row[0]);			
		}
	}
}
mysqli_close($conexion);   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pagina principal del estudiante</title>
</head>
<body>
	<h1>Bienvenido <?php echo $nombre_estudiante;?></h1>
	<h4>Seleccione una de sus asignaturas para ver las opciones</h4>
	<ol>
    <?php
    $i=0;
    while($i < count($id_asignaturas)) 
	{ 
	?>
        <li>
            <a href="indexEst.php?id=<?php echo $id_asignaturas[$i]?>" >
                <?php echo $nombres[$i]; echo '<br>'; ?>
            </a>                                            
		</li>
    <?php 
	$i++; 
	} 
	?>
	</ol>
	<a href = "login.php"><input type = "button" value = "Cerrar sesion"></a>
</body>
</html>