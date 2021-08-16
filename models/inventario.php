<?php

    class Inventario{
        private $conn;
        private $table = 'maestro';

        //Propiedades de materiales
        public $id;
        public $cod_material;
        public $descripcion;
        public $unidad;
        public $existencia_materiales;
        public $fecha_solicitud_pedido;
        public $solicitud_pedido;
        public $orden_pedido;
        public $cant_solicitud_pedido;
        public $cant_pedida;
        public $cod_proveedor;
        public $proveedor_name;
        public $cant_entregada;
        public $cant_pendiente;
        public $entrega_final;
        public $observaciones;
        public $area;
        public $fecha_entrega_pedido;
        
        //Constructor de nuestra clase
        public function __construct($db) {
            $this->conn = $db;
        }

        //Primer metodo obtener (leer) materiales
        public function leer(){
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC LIMIT 5000';

            //Preparamos la sentencia
            $stmt = $this->conn->prepare($query);

            //Ejecutamos query
            $stmt->execute();
            $inventario_almacen = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $inventario_almacen;
        }

        //Obtener material individual
        public function leer_individual($id){
            //Crear query
            $query = 'SELECT *  FROM ' . $this->table . '  WHERE id = ? LIMIT 0,1';

            //Preparar sentencia
            $stmt = $this->conn->prepare($query);

            //Vincular parámetro
            $stmt->bindParam(1, $id);

            //Ejecutar query
            $stmt->execute();
            $inventario_almacen = $stmt->fetch(PDO::FETCH_OBJ);
            return $inventario_almacen;
        }

        //Primer metodo crear material
        public function crear($codigo, $descripcion, $unidad){
           
            //Crear query
            $query = 'INSERT INTO ' . $this->table . ' (codigo, descripcion, unidad)VALUES(:codigo, :descripcion, :unidad)';

            //Preparamos la sentencia
            $stmt = $this->conn->prepare($query);
            
            //Hacemos un vinculo de parametros
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR); 
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR); 
            $stmt->bindParam(':unidad', $unidad, PDO::PARAM_STR); 
           
            //Ejecutamos query
            if($stmt->execute()){
                return true;
            }
            //si hay error
            printf("Error #s\n",$stmt->error);

            $stmt->execute();
            $materiales = $stmt->fetch(PDO::FETCH_OBJ);
            return $materiales;
            
        }

          //Actualizar un material
          //public function actualizar($idInventario, $cant_entregada, $fecha_entrega_pedido, $entrega_final, $fecha_entrega_final){
          public function actualizar($idInventario,  $fecha_entrega_final){
        
            //Crear query
            //$query = "UPDATE " . $this->table . " `codigo` = :dcodigo ,`descripcion` = :descripcion ,`unidad` = :unidad WHERE id = :id";
            //$query = 'UPDATE ' . $this->table . ' SET cant_entregada = :cantEntregada, fecha_entrega_ped = :fechaEntrega, entrega_final, = :entregaFinal, fecha_entrega_final = :fechaEntregaFinal WHERE id = :id';
            
            $query = 'UPDATE `maestro` SET `fecha_entrega_final`=:fechaEntregaFinal WHERE id = :id;';
            
             //Preparar sentencia
             $stmt = $this->conn->prepare($query);

             //Vincular parámetro
            // $stmt->bindParam(':cantEntregada', $cant_entregada, PDO::PARAM_INT);              
             //$stmt->bindParam(':fechaEntrega', $fecha_entrega_pedido, PDO::PARAM_STR);
             //$stmt->bindParam(':entregaFinal', $entrega_final, PDO::PARAM_INT);
             $stmt->bindParam(':fechaEntregaFinal', $fecha_entrega_final, PDO::PARAM_STR);
             $stmt->bindParam(':id', $idInventario, PDO::PARAM_INT);
             
             //Ejecutar query
             if ($stmt->execute()) {
                 return true;

             }
     
             //Si hay error 
             printf("error $s\n", $stmt->error);

        }

        
        //Borrar un Material
        public function borrar($idMaterial){
            //Crear query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            //Preparar sentencia
            $stmt = $this->conn->prepare($query);

            //Vincular parámetro
            $stmt->bindParam(":id", $idMaterial, PDO::PARAM_INT);         

            //Ejecutar query
            if ($stmt->execute()) {
                return true;
            }

            //Si hay error 
            printf("error $s\n", $stmt->error);

        }

      

    }


?>