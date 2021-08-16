<?php include("../includes/header.php") ?>

<?php

//Instanciar  la conexion y la base de datos
$baseDatos = new Basemysql();
$db = $baseDatos->connect();

//Validar si se envio el id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//Instanciamos el objeto con el que vamos a trabajas
$inventario_almacen = new Inventario($db);
$resultado = $inventario_almacen->leer_individual($id);

//Actualizar material
if (isset($_POST["editarMaterial"])) {
    //Obtenemos valores de los campos

    $idInventario = $_POST['id'];
    $cod_material = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $unidad = $_POST['unidad'];
    $existencia_materiales = $_POST['existencia'];
    $fecha_solicitud_pedido = $_POST['fecha_solicitud'];
    $solicitud_pedido = $_POST['solicitud_pedido'];
    $orden_pedido = $_POST['orden_pedido'];
    $cod_proveedor = $_POST['proveedor'];
    $cant_entregada = $_POST['cantidad_entregada'];
    $cant_pendiente = $_POST['cantidad_pendiente'];
    $fecha_entrega_pedido = $_POST['fecha_entrega_ped'];
    $area = $_POST['area'];
    $entrega_final = $_POST['entrega_final'];
    $fecha_entrega_final = $_POST['fecha_entrega_final'];
    
    

    //Validamo que los campos no estén vacíos
    // if (empty($idInventario) || $idInventario == '' || empty($codigo) || $codigo == '' || empty($descripcion) || $descripcion == '' || empty($unidad) || $unidad == '') {
    //     $error = "Error, algunos campos están vacíos";
    // } else {
        //Actualizar un registro del Inventario
        if ($inventario_almacen->actualizar($idInventario, $fecha_entrega_final)) {
            $mensaje = "Material actualizado correctamente";
            header("location: inventario.php?mensaje=" . urlencode($mensaje));
            exit();
        } else {
            $error = "Error, no se pudo actualizar";
        }
    }
//}

//Borrar Material

if (isset($_POST["borrarMaterial"])) {
    //Obtenemos valores de los campos
    $idMaterial = $_POST["id"];

    //Instanciamos objeto usuario
    $material = new Inventario($db);

    //Crear usuario
    if ($material->borrar($idMaterial)) {
        $mensaje = "Material borrado correctamente";
        header("Location: material.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        $error = "Error, no se pudo borrar";
    }
}

?>


<div class="row">
<div class="col-sm-12">
            <?php if(isset($_GET['mensaje'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $_GET['mensaje']; ?></strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php endif; ?>
        </div> 
</div>

<div class="row">
    <div class="col-sm-6">
        <h3>Modificar Registro</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 offset-3">
        <form method="POST" action="">
        
        <input type="hidden" name="id" value="<?php echo $resultado->id ?>"></input>
        
        <table class="table table-light">
                <tbody>
                    <tr>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código:</label>
                                <input readonly  class="form-control" type="text" name="codigo" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->cod_material; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Descripción:</label>
                                <input readonly  class="form-control" type="text" name="descripcion" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->descripcion; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="unidad" class="form-label">Unidad:</label>
                                <input readonly  class="form-control" type="text" name="unidad" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->unidad; ?>" required>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="mb-3">
                                <label for="existencia" class="form-label">Existencia:</label>
                                <input readonly  class="form-control" type="text" name="existencia" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->existencia_materiales; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="fecha_solicitud" class="form-label">Fecha solicitud de pedido:</label>
                                <input readonly  class="form-control" type="date" name="fecha_solicitud" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->fecha_solicitud_pedido; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="solicitud_pedido" class="form-label">Solicitud de pedido:</label>
                                <input readonly  class="form-control" type="text" name="solicitud_pedido" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->solicitud_pedido; ?>" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mb-3">
                                <label for="orden_pedido" class="form-label">Orden de pedido:</label>
                                <input readonly  class="form-control" type="text" name="orden_pedido" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->orden_pedido; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="proveedor" class="form-label">Proveedor:</label>
                                <input readonly  class="form-control" type="text" name="proveedor" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->proveedor_name; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Cantidad entregada:</label>
                                <input class="form-control" type="text" name="cantidad_entregada" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->cant_entregada; ?>" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Cantidad pendiente:</label>
                                <input readonly  class="form-control" type="text" name="cantidad_pendiente" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->cant_pendiente; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Fecha entrega de pedido:</label>
                                <input class="form-control" type="date" name="fecha_entrega_ped" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->fecha_entrega_ped; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Area:</label>
                                <input readonly  class="form-control" type="text" name="area" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->area; ?>" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Cantidad entrega de pedido final:</label>
                                <input class="form-control" type="text" name="entrega_final" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->entrega_final; ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Fecha entrega de pedido final:</label>
                                <input class="form-control" type="date" name="fecha_entrega_final" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->fecha_entrega_final; ?>" required>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" name="editarMaterial" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Material</button>
                        </td>
                        <td>
                            <button type="submit" name="borrarMaterial" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Material</button>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        </form>

        <!-- <form method="POST" action="">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código:</label>
                <input class="form-control" type="text" name="codigo" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->cod_material; ?>" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Descripción:</label>
                <input class="form-control" type="text" name="descripcion" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->descripcion; ?>" required>
            </div>
            <div class="mb-3">
                <label for="unidad" class="form-label">Unidad:</label>
                <input class="form-control" type="text" name="unidad" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->unidad; ?>" required>
            </div>
            <div class="mb-3">
                <label for="existencia" class="form-label">Existencia:</label>
                <input class="form-control" type="text" name="existencia" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->existencia_materiales; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_solicitud" class="form-label">Fecha solicitud de pedido:</label>
                <input class="form-control" type="text" name="fecha_solicitud" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->fecha_solicitud_pedido; ?>" required>
            </div>
            <div class="mb-3">
                <label for="solicitud_pedido" class="form-label">Solicitud de pedido:</label>
                <input class="form-control" type="text" name="solicitud_pedido" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->solicitud_pedido; ?>" required>
            </div>
            <div class="mb-3">
                <label for="orden_pedido" class="form-label">Orden de pedido:</label>
                <input class="form-control" type="text" name="orden_pedido" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->orden_pedido; ?>" required>
            </div>
            <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor:</label>
                <input class="form-control" type="text" name="proveedor" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->proveedor_name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Cantidad pendiente:</label>
                <input class="form-control" type="text" name="cant_pend" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->cant_pendiente; ?>" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Cantidad entregada:</label>
                <input class="form-control" type="text" name="cant_entregada" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->cant_entregada; ?>" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Fecha entrega final:</label>
                <input class="form-control" type="text" name="fecha_entrega_final" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->fecha_entrega_final; ?>" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Area:</label>
                <input class="form-control" type="text" name="area" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->area; ?>" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Fecha entrega de pedido:</label>
                <input class="form-control" type="text" name="fecha_entrega_ped" aria-label="Recipient's " aria-describedby="my-addon" value="<?php echo $resultado->fecha_entrega_ped; ?>" required>
            </div>

            <button type="submit" name="editarMaterial" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Material</button>

            <button type="submit" name="borrarMaterial" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Material</button>

        </form> -->




        <!-- <form method="POST" action="">

            <div class="mb-3">

                <input type="hidden" name="id" value="<?php echo $resultado->id ?>"></input>

                <label for="codigo" class="form-label">Código:</label>
                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Ingresa el código"
                    value="<?php echo $resultado->codigo ?>">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion"
                    placeholder="Ingresa la descripción" value="<?php echo $resultado->descripcion ?>">
            </div>
            <div class="mb-3">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" id="unidad"
                    placeholder="Ingresa la descripción de la presentación" value="<?php echo $resultado->unidad ?>">
            </div>


            <button type="submit" name="editarMaterial" class="btn btn-success float-left"><i
                    class="bi bi-person-bounding-box"></i> Editar Material</button>

            <button type="submit" name="borrarMaterial" class="btn btn-danger float-right"><i
                    class="bi bi-person-bounding-box"></i> Borrar Material</button>
        </form> -->
    </div>
</div>
<?php include("../includes/footer.php") ?>