<?php

class Usuario{
    private $conn;
    private $table = 'usuarios';

    //Propiedades
    public $id;
    public $name;
    public $username;
    public $password;
    public $user_level;
    public $email;
    public $centroCosto;
    public $area;

    //Cosntructor de nuestra clase

    public function __construct($db){

        $this->conn = $db;
    }
    
    
    //Obtener los usuarios

    public function leer(){
        //Crear la consulta
        $query = 'SELECT 
                    u.id AS usuario_id, 
                    u.username AS usuario, 
                    u.name AS usuario_nombre, 
                    u.email AS usuario_email, 
                    u.centro_costo AS area, 
                    u.fecha AS usuario_fecha_creacion, 
                    r.nombre AS rol, c.nombre AS ccosto  
                    FROM ' . $this->table . ' u 
                    INNER JOIN rol r 
                    ON r.id = u.rol_id 
                    INNER JOIN centro_costo c 
                    ON c.centro_costo = u.centro_costo ORDER BY usuario_id DESC';

         //Preparar sentencia
         $stmt = $this->conn->prepare($query);

         //Ejecutar query
         $stmt->execute();
         $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
         return $usuarios;
    }

    //Obtener artículo individual
    public function leer_individual($id){
        //Crear query
        $query = 'SELECT 
                    u.id AS usuario_id, 
                    u.username AS usuario, 
                    u.name AS usuario_nombre,
                    u.email AS usuario_email, 
                    u.centro_costo AS area, 
                    u.fecha AS usuario_fecha_creacion, 
                    r.nombre AS rol, c.nombre AS ccosto  
                    FROM ' . $this->table . ' u 
                    INNER JOIN rol r 
                    ON r.id = u.rol_id 
                    INNER JOIN centro_costo c 
                    ON c.centro_costo = u.centro_costo 
                    WHERE u.id = ? 
                    LIMIT 0,1';

        //Preparar sentencia
        $stmt = $this->conn->prepare($query);

        //Vincular parámetro
        $stmt->bindParam(1, $id);

        //Ejecutar query
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

    //Crear un usuario
    public function actualizar($idUsuario, $rol){
         
        //Crear query
         $query = 'UPDATE ' . $this->table . ' SET rol_id = :rol_id WHERE id = :id';

         //Preparar sentencia
         $stmt = $this->conn->prepare($query);

         //Vincular parámetro
         $stmt->bindParam(":rol_id", $rol, PDO::PARAM_INT);              
         $stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);

         //Ejecutar query
         if ($stmt->execute()) {
             return true;

         }
 
         //Si hay error 
         printf("error $s\n", $stmt->error);

    }

    //Borrar un usuario
    public function borrar($idUsuario){

        //Crear ela consulta
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //Preparamos la sentencia
        $stmt = $this->conn->prepare($query);

        //Vinculamos parámetros
        $stmt->bindParam(":id", $idUsuario, PDO:: PARAM_INT);

        //Ejecutamos la consulta SQL
        if ($stmt->execute()){
            return true;
        }

    }


    //Registrarse
    public function registrar($nombre, $email, $password){

        //Crear ela consulta
        $query = 'INSERT INTO ' . $this->table . ' (username, email, password, rol_id) VALUES(:username, :email, :password, 2)';

        //Encriptamos el password
        $passwordEncriptado = md5($password);
        //Preparamos la sentencia
        $stmt = $this->conn->prepare($query);

        //Vinculamos parámetros
        $stmt->bindParam(":username", $nombre, PDO:: PARAM_STR);
        $stmt->bindParam(":email", $email, PDO:: PARAM_STR);
        $stmt->bindParam(":password", $passwordEncriptado, PDO:: PARAM_STR);
        

        //Ejecutamos la consulta SQL
        if ($stmt->execute()){
            return true;
        }

    }

    //Validar si el email exixte
    public function validar_email($email){
        
        $query = 'SELECT * FROM ' .$this->table. ' WHERE email = :email';

        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $resultado = $stmt->execute();
        $registroEmail = $stmt->fetch(PDO::FETCH_ASSOC);

        if($registroEmail){
            return false;
        }else{
            return true;
        }

    }

    //Metodo de acceso
    public function acceder($email, $password){
        //creamos el query o la consulta      
        $query = 'SELECT * FROM '. $this->table . ' WHERE email = :email AND password = :password';

        //Encriptamos el password
        $passwordEncriptado = md5($password);

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordEncriptado, PDO::PARAM_STR);

        $resultado = $stmt->execute();
        $existeUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($existeUsuario){
            return true;
        }else{
            return false;
        }

    }
    



}




?>