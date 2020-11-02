<?php 

include_once "ConexionControlador.php";
include_once "Constants.php";

class RegistroControlador{

    public $respuesta;

    public function registrarUsuario($postdata){
        if($postdata == null){
            $this->respuesta = array("mensaje" => Constants::$ERROR_PETICION, "respuesta" => false);;
        }else{
            if($postdata->correo != null && $postdata->usuario != null && $postdata->contrasena != null){
                $conexionControl = new ConexionControlador();
                $conexion = $conexionControl->conectar();
                $hash = md5($postdata->contrasena);
                //*Verificar que no exista otro correo igual.
                $consulta = $conexion->query("SELECT correo FROM usuarios WHERE correo = '$postdata->correo'");
                if($consulta){
                    $rows = mysqli_num_rows($consulta);
                    if($rows >= 1){
                        $this->respuesta = array("mensaje" => Constants::$ERROR_CORREO_EXISTE, "respuesta" => false);
                    }else{
                        $consulta = $conexion->query("INSERT INTO usuarios (correo, contrasena, nombre) VALUES ('$postdata->correo', '$hash', '$postdata->usuario')");
                        if($consulta){
                            $this->respuesta = array("mensaje" => Constants::$REGISTRO_EXITOSO, "respuesta" => true);
                        }else{
                            $this->respuesta = array("mensaje" => Constants::$ERROR_REGISTRO, "respuesta" => false); 
                        } 
                    }
                }else{
                    $this->respuesta = array("mensaje" => Constants::$ERROR_CONSULTA_BD, "respuesta" => false);;
                }
                
            }else{
                $this->respuesta = array("mensaje" => Constants::$ERROR_PETICION, "respuesta" => false);;
            }
        }

        return json_encode($this->respuesta);
    }

}

?>