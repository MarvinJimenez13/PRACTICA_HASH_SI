loginApp = angular.module("Login", []);

var loginControlador = function($scope, $http){

    $scope.sesion = {};

    $scope.registro = function(){
        window.location.href = "index";
    }

    $scope.iniciarSesion = function(){
        if($scope.sesion.correo != "" && $scope.sesion.correo !== undefined){
            if($scope.sesion.contrasena != "" && $scope.sesion.contrasena !== undefined){
                $http.post('assets/lib/Login.php', JSON.stringify($scope.sesion), {headers : {'Content-Type' : 'application/json'}})
                .then(function(response){
                    alert(response.data.mensaje);
                });
            }else{
                alert("Ingresa tu contraseña");
            }
        }else{
            alert("Ingresa un correo válido");
        }
    }

}

loginApp.controller("loginControlador", ['$scope', '$http', loginControlador]);