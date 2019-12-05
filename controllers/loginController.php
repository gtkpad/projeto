<?php
/**
 * Controller responsável pelo sistema de login, o login do sistema é feito
 * via ajax, a função logar retorna 1 se o usuário foi autenticado
 */
class loginController extends Controller {

    public function __construct(){
        $this->auth = new authController(); 
        $this->auth->isLoggedIn();

    }

    public function index(){ 

        $this->loadView('login.login');
  
    }


    public function logar(){
        if (!empty($_POST['email']) && !empty($_POST['senha'])):
            $this->auth = new authController();
            $email = addslashes($_POST['email']);
            $pass = addslashes($_POST['senha']);
            if( $this->auth->authLogin($email, $pass) ):
                echo "1";
                exit();
            else:
                echo "0";
                exit();
            endif;
        else:
            header("Location: ".BASE_URL)."login";
            exit();
        endif;
    }

    public function logout(){
        session_destroy();
        header("Location: ".BASE_URL."login");
   }

}

?>