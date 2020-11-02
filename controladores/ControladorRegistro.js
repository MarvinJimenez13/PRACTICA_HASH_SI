registroApp = angular.module("Registro", []);

var registro = function($scope, $http){

    $scope.registro = {};

    $scope.error = function(error){
        alert(error)
    };

    $scope.registrar = function(){
        if($scope.registro.usuario != "" && $scope.registro.usuario !== undefined){
            if($scope.registro.correo != "" && $scope.registro.correo !== undefined){
                if($scope.registro.contrasena != "" && $scope.registro.contrasena !== undefined){
                    $http.post('assets/lib/Registro.php', JSON.stringify($scope.registro), {headers : {'Content-Type' : 'application/json'}})
                    .then(function(response){
                        if(response.data.respuesta){
                            alert(response.data.mensaje);
                            window.location.href = 'login';
                        }else{
                            alert(response.data.mensaje);
                        }
                    });
                }else{
                    $scope.error("Ingresa una contraseña");
                }
            }else{
                $scope.error("Ingresa un correo válido");
            }
        }else{
            $scope.error("Ingresa un usuario");
        }
    }

}

registroApp.controller("registroControlador", ['$scope', '$http', registro]);