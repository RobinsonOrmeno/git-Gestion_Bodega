<?php 
       session_start();
    include 'Productos.php';
 
    if(isset($_POST['crear'])){
    $error = false;
    $msgError = "";
    $ok = false;
    $msgOk = "";
    $prod = new Productos;
    $cod_producto = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $proveedor = $_POST['proveedor'];
    $fecha_ingreso = $_POST['fecha'];
    
    $result = $prod->agregarProducto($cod_producto,$descripcion,$stock,$proveedor,$fecha_ingreso);
    if($result){
        $ok = true;
        $msgOk = "Se agregó correctamente";
    }else{
        $error = true;
        $msgError = "No se pudo agregar el Producto";
          
    }
    


}

 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Agregar productos</title>
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
                <?php
                    // La siguiente validación verifica el cargo del usuario que esta viendo esta pagina para asignarle el flujo que tendra el links con imagen "Home"

                    if ($_SESSION['cargo']=='Admin')  {
                            echo "<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a>";
                    }else {
                            echo "<a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>";
                    };

                    error_reporting(E_ALL  ^  E_NOTICE  ^  E_WARNING);
                ?> 
            </div>
            


            <div class="derecha">

                <a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
            </div>
        </div>
        <br><h1 align="center">GESTIÓN DE PRODUCTOS</h1>     

            <div class="formulario">


                <form name="registro" method="post" action="" enctype="application/x-www-form-urlencoded">
                    <div class="campo">
                        <label for="codigo">Código del producto:</label>
                        <input type="text" name="codigo" required/>
                    </div>

                    
                    <div class="campo">
                        <label for="nombre">Descripción:</label>
                        <input type="text" name="descripcion" required/>
                    </div>

                    <div class="campo">
                        <label for="stock">Stock:</label>
                        <input type="number" name="stock" required/>
                    </div>
                    

                    <div class="campo">
                        <label for="proveedor">Proveedor:</label>
                        <input type="text" name="proveedor" required/>
                    </div>

                    <div class="campo">
                        <label for="fecha">Fecha ingreso:</label>
                        <input type="date" name="fecha" required/>
                    </div>

                    <div class="botones">
                        <input type="submit" name="crear" value="Agregar producto"/>
                    </div>

                </form>
            </div>

        </div>
    </body>
</html>