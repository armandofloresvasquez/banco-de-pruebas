<?php include("../includes/header.php"); ?>
<?php
    //Instanciar  la conexion y la base de datos
    $baseDatos = new Basemysql();
    $db = $baseDatos->connect();

    //Instanciamos el objeto con el que vamos a trabajas
    $inventario_almacen = new Inventario($db);
    $resultado = $inventario_almacen->leer();
    


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
        <h3>Lista de inventario de materiales</h3>
    </div>
    <!-- <div class="col-sm-4 offset-2">
        <a href="crear_material.php" class="btn btn-warning w-100"><i class="bi bi-plus-circle-fill"></i> Nuevo
            Material</a>
    </div> -->
</div>
<div class="row mt-2">
    <div class="col-sm-12">


        <table id="tblInventario" class="display table-responsive" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    
                    <th>Descripción</th>
                    <th>Unidad</th>
                    <th>Existencia</th>
                    <th>Fecha solicitud ped.</th>
                    <th># Solicitud</th>
                    <th># Orden ped.</th>
                    <th>Proveedor</th>
                    <th>Cant. Solicitada</th>
                    <th>Cant. Entergada</th>
                    <th>Entrega final</th>
                    <th>Area</th>
                    <th>Fecha entrega ped.</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultado as $inventario) :?>
                <tr>
                    <td><?php echo $inventario->id; ?></td>
                    
                    <td><?php echo $inventario->descripcion; ?></td>
                    <td><?php echo $inventario->unidad; ?></td>
                    <td><?php echo $inventario->existencia_materiales; ?></td>
                    <td><?php echo $inventario->fecha_solicitud_pedido; ?></td>
                    <td><?php echo $inventario->solicitud_pedido; ?></td>
                    <td><?php echo $inventario->orden_pedido; ?></td>
                    <td><?php echo $inventario->proveedor_name; ?></td>
                    <td><?php echo $inventario->cant_pendiente; ?></td>
                    <td><?php echo $inventario->cant_entregada; ?></td>
                    <td><?php echo $inventario->fecha_entrega_final; ?></td>
                    <td><?php echo $inventario->area; ?></td>
                    <td><?php echo $inventario->fecha_entrega_ped; ?></td>
                    <td>
                        <a href="editar_inventario.php?id=<?php echo $inventario->id; ?>" class="btn btn-warning"><i
                                class="bi bi-pencil-fill"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("../includes/footer.php") ?>

<script>
$(document).ready(function() {
    $('#tblInventario').DataTable();
});
</script>