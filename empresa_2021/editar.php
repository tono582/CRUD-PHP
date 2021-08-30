<!doctype html>
<html lang="en">
  <head>
    <title>Empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
  <?php
        include("datos_conexion.php");
        $id = $_GET['id'];
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $db_conexion ->real_query("SELECT * from empleados where id_empleado=".$id."");
        $resultado = $db_conexion->use_result();     
        while($fila = $resultado->fetch_assoc()){                           

  ?>      
      <h1>Editar Empleados</h1>
      <div class="container">     
        <form class="d-flex" action="" method="post">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label"><b>Código</b></label>
                    <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Código: E001" value="<?php echo $fila['codigo'] ?>" required>                 
                </div>
                <div class="mb-3">
                    <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: Nombre1 Nombre2" value="<?php echo $fila['nombres'] ?>"required>
                </div>
                <div class="mb-3">
                    <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: Apellido1 Apellido2" value="<?php echo $fila['apellidos'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_direccion" class="form-label"><b>Dirección</b></label>
                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Dirección: #casa calle avenida lugar" value="<?php echo $fila['direccion'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_telefono" class="form-label"><b>Teléfono</b></label>
                    <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Teléfono: 12345678" value="<?php echo $fila['telefono'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
                  <select class="form-select" name="drop_puesto" id="drop_puesto">
                    <option value=0>---- Puesto ----</option>
                    <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("select id_puesto as id, puesto from puestos;");
                    $resultado = $db_conexion->use_result();
                    while($row = $resultado->fetch_assoc()){
                        if($fila['id_puesto'] == $row['id'])
                        echo"<option selected='selected' value=".$row['id'].">". $row['puesto'] ."</option>";
                        else
                        echo"<option value=".$row['id'].">". $row['puesto'] ."</option>";
                    }                    
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="lbl_fn" class="form-label"><b>Fecha Nacimiento</b></label>
                    <input type="date" name="txt_fn" id="txt_fn" class="form-control" value="<?php echo $fila['fecha_nacimiento'] ?>" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Editar">
                </div>                
            </div>
        </form>
      </div>

    <?php
    }
    $db_conexion ->close(); 

    ?>

<?php 
    if(isset($_POST["btn_editar"])){
        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $txt_codigo =utf8_decode( $_POST["txt_codigo"]);
        $txt_nombres =utf8_decode( $_POST["txt_nombres"]);
        $txt_apellidos =utf8_decode( $_POST["txt_apellidos"]);
        $txt_direccion =utf8_decode( $_POST["txt_direccion"]);
        $txt_telefono =utf8_decode( $_POST["txt_telefono"]);
        $drop_puesto =utf8_decode( $_POST["drop_puesto"]);
        $txt_fn =utf8_decode( $_POST["txt_fn"]);
        $sql="UPDATE empleados SET codigo='".$txt_codigo."',nombres='".$txt_nombres."',apellidos='".$txt_apellidos."',direccion='".$txt_direccion."',telefono='".$txt_telefono."',fecha_nacimiento='".$txt_fn."',id_puesto=".$drop_puesto." 
        WHERE id_empleado=".$id.";";
        if($db_conexion->query($sql)===true){
            $db_conexion ->close();
            echo"Exito";
            echo '<script language="javascript">alert("Empleado Editado con Exito");</script>';
            print "<script>window.setTimeout(function() { window.location = '/empresa_2021/index.php' }, 1);</script>";
        }else{
            echo"Error" . $sql . "<br>".$db_conexion ->close();

        }

    }

?>    
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>