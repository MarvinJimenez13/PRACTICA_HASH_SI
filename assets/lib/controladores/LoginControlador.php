<?php 

include_once "ConexionControlador.php";
include_once 'Constants.php';

class LoginControlador{

    public $respuesta;

    public function iniciarSesion($postdata){
        if($postdata == null){
            $this->respuesta = array("mensaje" => Constants::$ERROR_PETICION, "respuesta" => false);;
        }else{
            if($postdata->correo != null && $postdata->contrasena != null){
                $conexionControl = new ConexionControlador();
                $conexion = $conexionControl->conectar();
                $hash = md5($postdata->contrasena);
                $consulta = $conexion->query("SELECT * FROM usuarios WHERE correo = '$postdata->correo' AND contrasena = '$hash'");
                if($consulta){
                    $rows = mysqli_num_rows($consulta);
                    if($rows >= 1){
                        $this->respuesta = array("mensaje" => Constants::$INICIO_CORRECTO, "respuesta" => true);
                    }else{
                        $this->respuesta = array("mensaje" => Constants::$ERROR_DATOS_INCORRECTOS, "respuesta" => false);
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