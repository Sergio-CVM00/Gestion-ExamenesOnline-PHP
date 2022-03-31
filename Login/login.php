<!DOCTYPE html>
<head>
    <title>INICIAR SESION</title>
<head>

<body>
    <h1>Iniciar sesión</h1>
    <form action = "" method = "post">
        <label for = "email">E-Mail</label>
        <br>
        <input type = "text" name = "email">
        <br>
        <br>
        <label for = "pass">Contraseña</label>
        <br>
        <input type = "password" name = "pass">
        <br>
        <br>
        <input type = "submit" name = "login" value = "Inciar Sesion">
    </form>
</body>
<!------------------->
<!--------PHP--------> 
<!------------------->
<?php
    //Comprobar el envio del formulario
    if(isset($_POST["login"]))
    {
        //Comprobar que los campos se han rellenado
        $vacio = false;
        if((trim($_POST["email"]) == "") || (trim($_POST["pass"]) == ""))
        {
            $vacio = true;
        }
        
        if($vacio)  //Mostrar error si algun campo es vacio
        {
            echo '<br>';
            echo "Error:";
            echo '<br>';
            echo "Debes rellenar todos los campos";
        }
        else    //Todos los campos llenos
        {
            //Buscar el usuario en la BD
            //Conexion con la BD
            $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD"); 

            //Consultas
            //Estudiantes
            $slqEst = "SELECT email, pass FROM estudiante";
            $queryEst = mysqli_query($conn, $slqEst) or die ("Error: Busqueda fallida");    
            //Profesores
            $slqPro = "SELECT email, pass FROM profesor";
            $queryPro = mysqli_query($conn, $slqPro) or die ("Error: Busqueda fallida");

            //Cerrar conexion con la BD
            mysqli_close($conn);    

            //Buscar coincidencia
            $encontrado = false;
            //Busqueda en estudiante
            $nfilas = mysqli_num_rows($queryEst);
            for($i = 0; $i < $nfilas; $i++)
            {
                $resultado = mysqli_fetch_array($queryEst);
                if(($resultado["email"] == $_POST["email"]) && ($resultado["pass"] == $_POST["pass"]))
                {
                    $encontrado = true;
                    header("Location: indexEst.php");
                }
            }
            //Busqueda en profesor
            $nfilas = mysqli_num_rows($queryPro);
            for($i = 0; $i < $nfilas; $i++)
            {
                $resultado = mysqli_fetch_array($queryPro);
                if(($resultado["email"] == $_POST["email"]) && ($resultado["pass"] == $_POST["pass"]))
                {
                    $encontrado = true;
                    header("Location: indexPro.php");
                }
            }

            //Usuario no encontrado
            if($encontrado === false)
            {
                echo '<br>';
                echo "Error:";
                echo '<br>';
                echo "E-Mail o contraseña incorrecto";
            }
        }
    }
?>
</html>