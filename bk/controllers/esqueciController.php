<?php
/**
 * Controller responsável pelo sistema de recuperação de senha, 
 * onde gera a hash md5 que será utilizada para a validação
 * do link que será enviado por email para o usuario,
 * serão aceitas hashes ainda não utilizadas no periodo de 24h
 * após a solicitação
 */
class esqueciController extends Controller{

    public function __construct(){
        $this->auth = new authController();
    }
    

    public function index(){
        $this->loadView('esqueci.esqueci');
    }

    public function solicitar(){
        $send = false;
        if(!empty($_POST['email'])):
            $email = addslashes($_POST['email']);
            $usuario = new Usuarios();
            $dbusuario = $usuario->getAuth($email);
            $recupera = new RecuperaSenha();
            if( ! $recupera->verifyLastDay($dbusuario['id']) ):
                
                $hash = md5(rand(0,99).$dbusuario['email'].time());
                $data = array(
                    'hash' => $hash,
                    'usuario' => $dbusuario['id']
                );
                if ( $recupera->generateHash($data) ):

                    $headers = "MIME-Version: 1.1\r\n";
                    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
                    $headers .= "From: ".EMAIL_RECUPERA."\r\n"; 
                    $headers .= "Return-Path: ".EMAIL_RECUPERA."\r\n"; 
                    $headers .= "X-Mailer: PHP/" . phpversion()."\r\n";
                    $texto = "Solicitação de recuperação de senha\r\n\r\n\r\nPara recuperar a sua senha acesse:".BASE_URL."esqueci/recuperar/".$hash;
                    $send = mail($email, "Recuperação de Senha", $texto, $headers);
                endif;
            endif;
            if($send):
                echo 1;
            else:   
                echo 0;
            endif;
        else:
            header("Location: ".BASE_URL."login");
        endif;    
        
    }

    public function recuperar($hash){
        if (!empty($hash)):
            $recupera = new RecuperaSenha();
            $dbrecupera = $recupera->getHash($hash);
            if( !empty($dbrecupera) && $dbrecupera != false ):
                
                $datasolicitacao = $dbrecupera['data_solicitacao'];
                $datalimite = strtotime($datasolicitacao.' +1 day');
                if (time() < $datalimite):
                    if(!empty($_POST['senha'])):
                        $usuario = new Usuarios();
                        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                        $data = array(
                            'senha' => $senha,
                            'id' => $dbrecupera['usuario_id']
                        );
                        if($usuario->alteraSenha($data)):
                            $recupera->usedHash($dbrecupera['id']);
                            echo 1;
                            exit();
                        else:
                            echo 0;
                            exit();
                        endif;
                    endif;
                    $this->loadView('esqueci.recuperar', array('hash' => $hash));
                    exit();
                else:
                    $recupera->usedHash($dbrecupera['id']);
                endif;
            endif;
        endif;

        $this->loadView('esqueci.invalido');
    }

}


?>