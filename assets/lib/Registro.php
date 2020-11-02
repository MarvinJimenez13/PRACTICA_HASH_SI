<?php 
include_once "controladores/RegistroControlador.php";

$postdata = json_decode(file_get_contents('php://input'), false);
$registro = new RegistroControlador();
echo $registro->registrarUsuario($postdata);

?>