<?php 

include_once "controladores/LoginControlador.php";

$postdata = json_decode(file_get_contents('php://input'), false);
$login = new LoginControlador();
echo $login->iniciarSesion($postdata);

?>