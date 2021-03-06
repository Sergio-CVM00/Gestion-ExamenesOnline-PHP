<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">

    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CRUD PREGUNTAS</title>
</head>
<?php

    $id_Asignatura=$_SESSION['ID_asignatura'];
    $consulta2= "SELECT nombre from asignatura WHERE ID_asignatura=$id_Asignatura";
    $resultado2=mysqli_query($conn,$consulta2);
    $nombre_Asignatura=mysqli_fetch_row($resultado2);

    //$consulta_temas= "SELECT ID_tema from tema WHERE ID_asignatura=$id_Asignatura";
    $consulta_temas= "SELECT ID_tema, nombre from tema WHERE ID_asignatura=$id_Asignatura";
    $temaHeader = mysqli_query($conn,$consulta_temas);
    
?>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand">Preguntas de <?php echo $nombre_Asignatura[0]; ?></a>
            <a class="nav-link text-white"> Temas disponibles: <?php while( $tema_Asignatura = mysqli_fetch_row($temaHeader) ){echo $tema_Asignatura[0].': '.$tema_Asignatura[1].', ';}  ?> </a>
            <li class="nav-item">
                <a class="nav-link text-white" href ="../Login/indexPro.php?id=<?php echo $id_Asignatura;?>" >Volver al menu</a>
            </li>
        </div>
        
    </nav>
