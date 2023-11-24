<?php

/**
 * Classe HomeController
 *
 */

namespace Mini\Controller;
use Mini\Model\Usuario;
class LoginController {
    public function index():void
    {
    if(array_key_exists('submit_post',$_POST)) {
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $password = filter_var($_POST["password"], FILTER_DEFAULT);
        $password =$_POST["password"];
        if (!$email || !$password) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seu email e senha para logar"
            ]);
            return;
        }
        $usuario = new Usuario();
        $user = $usuario->login($email, $password);
       // var_dump($password);
   
        $loginIstrue=strval($password)==strval($user->password);
        //password_verify($password, $user->password)
         if (!$user ||  ($loginIstrue==false)) {
           
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email ou senha invalido"
            ]);
            return;
        }
        $_SESSION['usuario'] = $usuario;
        $this->redirect( URL .'home/index');
        die('aqui');
     }
     require APP . 'view/login/index.php';
    }
    public function logOut(){
        session_start();
        session_destroy();
        $this->redirect( URL .'login/index');
        exit();
         return true;
    }

    public static function verificaLogin(){
    session_start();

    if (array_key_exists('usuario',$_SESSION)==false){
        LoginController::redirect( URL .'Login/index');
        exit();
        }
    }

    public static  function redirect($url){
        header('location: ' . $url);
   }
   
   public function ajaxResponse(string $param, array $values): string
    {
        return json_encode([$param => $values]);
    }
}