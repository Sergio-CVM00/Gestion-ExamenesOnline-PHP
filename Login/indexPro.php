


<?php
    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $_SESSION['ID_asignatura'] = $id;
    }
?>

<h1>Eres profesor</h1>
<a href = "../Generacion_examenes/formulario_generacion.php">Generar examen</a>
<br>
<a href = "../Visualizacion_resultados/formulario_visualizacion_profesores.php">Visualizar resultados</a>
<br>
<a href = "..\crud-preguntas\index.php">Gestor de preguntas</a>
<br>