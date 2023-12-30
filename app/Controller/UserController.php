<?php

namespace Mini\Controller;
use Mini\Controller\LoginController;
use Exception;
use Mini\Model\Funcionario;
use Mini\Libs\PHPMailer;
use Mini\Model\Usuario;
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

        //$phpmailer->SMTPDebug = 2;
        if(!$phpmailer->Send()){
        echo "Erro ao enviar Email:" . $phpmailer->ErrorInfo;
            return;
        }
        echo"Mensagem enviada com sucesso";
    }

    public function esqueceminhasenha()
    {
        if (isset($_POST["submit_esqueci_senha"])) {
                $usuario = new Usuario();
               $result = $usuario->findEmail($_POST["email"]);
               
               if($result){
                $chave = sha1(uniqid( mt_rand(), true));

                $usuario->addRecuperacaoSenha($result[0]->id,$chave);
                $assunto = "Recuperação de senha";
                $email = $_POST["email"];
                $username = $result[0]->nome;

                $link = "http://$_SERVER[HTTP_HOST]/user/alterarsenha/".$chave;
		        $mensagem = utf8_encode('Recuperação de password, Olá '.$result[0]->nome.', visite este link '.$link);
                $this->sendEmailteste($mensagem, $assunto, $email, $username);
               }
            
        }
        require APP . 'view/login/recuperarsenha.php';
    }

    public function alterarsenha($chave)
    {
        $usuario = new Usuario();
        $result =$usuario->findChaveRecuperacao($chave);
        if($result) {
            require APP . 'view/login/mudarsenha.php';
            return;
        }
        //$this->redirect('/'); 
    }
}