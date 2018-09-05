<?php
include 'Personal.php';
//recibo los valores del formulario 
if(isset($_POST['enviar'])){
    $error = false;
    $msgError = "";
    $ok = false;
    $msgOk = "";
    if($_POST['contrasena1'] == $_POST['contrasena2']){
        $personal = new Personal;
        $rut = $_POST['rut'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cargo = $_POST['cargo'];
        $contrasena = md5($_POST['contrasena1']);
        //llamada al metodo agregapersonal con los valores que rescato del formulario
        $result = $personal->agregarPersonal($rut,$nombre,$apellido,$cargo,$contrasena);
        if($result){
            //ok y error son variables booleanas con las que iniciaré los mensajes de error
            $ok = true;
            $msgOk = "Se agregó correctamente";
        }else{
            $error = true;
            $msgError = "No se pudo agregar el personal";
        }
    }else{
        $error = true;
        $msgError = "las contraseñas no coinciden";
    }
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Crear personal</title>
        <link rel="stylesheet" href="estilo.css"/>
    </head>
    <body>

        <div class="contenedor">
            <?php
                error_reporting(E_ALL  ^  E_NOTICE  ^  E_WARNING);
                if($error)
                    echo '<div style="color:red;font-size:24px;">'.$msgError.'</div>';

                if($ok){
                    echo '<div style="color:green;font-size:24px;">'.$msgOk.'</div>';
                }
            ?>
            <div class= "encabezado">
                <div class="izq">
                    <p>Bienvenido/a:<br><?php
                 
                    echo  $_SESSION['nombre'].' '. $_SESSION['apellido'];

                 ?></p>
                </div>

                <div class="centro">
                    <a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a> 
                </div>
                
                <div class="derecha">
                    <a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
                </div>
            </div>

            <br><h1 align="center">GESTIÓN DE PERSONAL</h1>

            <div class="formulario">
                <form ="registro" method="post" action="crear_personal.php" enctype="application/x-www-form-urlencoded">
                    <div class="campo">
                        <label for="cabra">RUT:</label>
                        <input type="text" name="rut" required/>
                    </div>

                    <div class="campo">
                        <div class="en-linea izquierdo">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" required/>
                        </div>

                        <div class="en-linea">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido" required/>
                        </div>
                    </div>

                    <div class="campo">
                        <label for="cargo">Cargo:</label>
                            <select name="cargo" required/>
                                <option value="Admin">Admin</option>
                                <option value="Bodega">Bodega</option>
                            </select>
                    </div>

                    <div class="campo">
                        <div class="en-linea izquierdo">
                            <label for="contrasena1">Contraseña:</label>
                            <input type="password" name="contrasena1" required/>
                        </div>
                        
                        <div class="en-linea">
                            <label for="contrasena2">Repetir contraseña:</label>
                            <input type="password" name="contrasena2" required/>
                        </div>
                    </div>

                    <div class="botones">
                        <input type="submit" name="enviar" value="crear usuario"/>
                        
                    </div>
                </form>
            </div>

        </div>
    </body>
</html>