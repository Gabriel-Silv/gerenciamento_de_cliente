<?php

/**
 * Classe HomeController
 *
 */

namespace Mini\Controller;

class LoginController {
    public function login($request){
        $email = filter_var($request["email"], FILTER_VALIDATE_EMAIL);
        $passwd = filter_var($request["passwd"], FILTER_DEFAULT);
        if (!$email || !$passwd) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seu email e senha para logar"
            ]);
            return;
        }
        $usuario = new Usuario();
        $user = $usuario->login($email, $passwd);
        if (!$user || !password_verify($passwd, $user->passwd)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email ou senha invalido"
            ]);
            return;
        }
        $_SESSION['usuario'] = $usuario;
        $this->redirect( URL .'home/index');
    }
    public function logOut(){
        session_start();
        session_destroy();
        $this->redirect( URL .'login/index');
        exit();
         return true;
    }

    function verificaLogin(){
        session_start();
        if(!$_SESSION['usuario']) {
              $this->redirect( URL .'login/index');
              exit();
        }
    }

    public function redirect($url){
        header('location: ' . $url);
   }
}