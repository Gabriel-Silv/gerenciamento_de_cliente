<?php

namespace Mini\Controller;
use Mini\Controller\LoginController;
use Exception;
use Mini\Model\Funcionario;
use Mini\Libs\PHPMailer;

//require_once('../app/libs/PHPMailer/src/PHPMailer.php');
class UserController
{

    public function sendEmail()
    {
        
        $mail = new PHPMailer(); // instancia a classe PHPMailer
        
        $mail->IsSMTP();

        //configuração do gmail
        $mail->Port = '465'; //porta usada pelo gmail.
        $mail->Host = 'smtp.gmail.com'; 
        $mail->IsHTML(true); 
        $mail->Mailer = 'smtp'; 
        $mail->SMTPSecure = 'ssl';

        //configuração do usuário do gmail
        $mail->SMTPAuth = true; 
        $mail->Username = 'seuemail@gmail.com'; // usuario gmail. 
        $mail->Password = 'suasenhadogmail'; // senha do email.

        $mail->SingleTo = true; 

        // configuração do email a ver enviado.
        $mail->From = "Mensagem de email, pode vim por uma variavel."; 
        $mail->FromName = "Nome do remetente."; 

        $mail->addAddress("destinatario@hotmail.com"); // email do destinatario.

        $mail->Subject = "Aqui vai o assunto do email, pode vim atraves de variavel."; 
        $mail->Body = "Aqui vai a mensagem, que tambem pode vim por variavel.";

        if(!$mail->Send())
            echo "Erro ao enviar Email:" . $mail->ErrorInfo;
    }

    public function sendEmailteste($mensagem, $assunto, $email, $username)
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'a814cfbfc6a2e1';
        $phpmailer->Password = '8c98652459c991';

        $phpmailer->From = "gmswbb.2silva@gmail.com"; 
        $phpmailer->FromName = "Nome do remetente."; 

        $phpmailer->addAddress($email); // email do destinatario.

        $phpmailer->Subject = $assunto; 
        $phpmailer->Body = $mensagem;

        $phpmailer->SMTPDebug = 2;
        if(!$phpmailer->Send()){
        echo "Erro ao enviar Email:" . $phpmailer->ErrorInfo;
            return;
        }
        echo"Mensagem enviada com sucesso";
    }

    public function esqueceminhasenha()
    {
        if (isset($_POST["submit_esqueci_senha"])) {
            $user= userModel();
               $result = $user->findEmail($_POST["email"]);
               
               if($result){
                $chave = sha1(uniqid( mt_rand(), true));

                $user->addRecuperacaoSenha($result['id'],$chave);
                $assunto = "Recuperação de senha";
                $email = $_POST["email"];
                $username = $result["nome"];

                $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/alterarsenha".$chave;
		        $mensagem='Recuperação de password, Olá '.$result['nome'].', visite este link '.$link;
                $this->sendEmailteste($mensagem, $assunto, $email, $username);
               }
            
        }
        require APP . 'view/login/recuperarsenha.php';
    }

    public function alterarsenha($chave)
    {
        $result = userModel::findChaveRecuperacao($chave);
        if($result) {
            require APP . 'view/login/mudarsenha.php';
        }
        $this->redirect('/');  
    }
}