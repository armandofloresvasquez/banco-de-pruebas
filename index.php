<?php include("config/conexion.php") ?>
<?php include("models/usuario.php") ?>
<?php

//Instanciar  la conexion y la base de datos
$baseDatos = new Basemysql();
$db = $baseDatos->connect();

//Instanciamos el objeto Usuario
$usuario = new Usuario($db);
$resultado = $usuario->leer();
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * 
        FROM usuarios 
        WHERE email = '$email' 
        AND 
        password = '$password'";
$resultado = $db->prepare($sql);
$resultado->execute();


$row = $resultado->fetch(PDO::FETCH_ASSOC);
        //var_dump($row);
         if($row > 1){
             $email = $row['email'];
             $area= $row['centro_costo'];
             $rol_id = $row['rol_id'];
            
             $_SESSION['email'] = $email;
             $_SESSION['area'] = $area;
             $_SESSION['rol_id'] = $rol_id;
         
               var_dump($_SESSION);
               
        
             switch($rol_id)		//inicio de sesión de usuario base de roles
             {
                 case 1:
                    echo "Admin";
                    $_SESSION["admin_login"]=$email;			
                    $loginMsg="Admin: Inicio sesión con éxito";	
                      header("refresh:3;admin/inventario.php");	
                     break;
                     
                 case 2;
                 echo "Usuario_area";
                    $_SESSION["rol_id"]=$rol_id;				
                    $loginMsg="Personal: Inicio sesión con éxito";		
                    //header("refresh:3;personal/personal_portada.php");
                    header("refresh:3;admin/inventario.php");	
                     break;
                     
                 case "usuarios":
                     $_SESSION["usuarios_login"]=$email;				
                     $loginMsg="Usuario: Inicio sesión con éxito";	
                     header("refresh:3;usuarios/usuarios_portada.php");		
                     break;
                     
                 default:
                     $errorMsg[]="correo electrónico o contraseña o rol incorrectos";
             }
         }
        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 ads">
                <div class="image" style="text-align: center;">
                    <img class="mb-4 shadow-2" src="../assets/images/bootstrap-solid.png" alt="" height="200">
                </div>
            </div>
            <div class="col-md-6 login-form">
                <h3>Almacen Central</h3>
                <form class="" method="post" action="">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Ingrese su correo">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="password" placeholder="ingrese su contraseña">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="entrar" class="btn btn-secondary btn-lg btn-block">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>