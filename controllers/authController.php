<?php
/**
 * Controller responsável pela autenticação de usuários e verificação de permissões
 */
class authController extends Controller {

    public function adminAuth(){
        
        if ($_SESSION['auth'] == true):
            $usuario = new Usuarios();
            $usuario = $usuario->getUserId($_SESSION['usuario']);
            $permissoes = explode(';', $usuario['permissoes']);
            if(in_array('sistema', $permissoes) && in_array('usuarios', $permissoes)):
                return true;
                exit();
            endif;
        endif;

        return false;
        exit();
    }


    public function userAuth(){
        if ($_SESSION['auth'] == true):
            $usuario = new Usuarios();
            $usuario = $usuario->getUserId($_SESSION['usuario']);
            $permissoes = explode(';', $usuario['permissoes']);
            if(in_array('sistema', $permissoes)):
                return true;
            endif;
        endif;
        return false;
        exit();
    }

    public function isLoggedIn(){
        if ($_SESSION['auth'] == true):
            header("Location: ".BASE_URL);
        else:
            return false;
        endif;
    }

    public function authLogin($email, $pass){
        if ( !empty($email) && !empty($pass) ):
            $user = new Usuarios();
            $user = $user->getAuth($email);
            if ( $user != false ):
                if ( password_verify($pass, $user['senha']) ):
                    $_SESSION['auth'] = true;
                    $_SESSION['usuario'] = $user['id'];
                    $_SESSION['nome_usuario'] = $user['nome'];
                    $_SESSION['permissoes'] = explode(';', $user['permissoes']);
                    return true;
                endif;
            endif;
        endif;
        return false;
    }

}

?>