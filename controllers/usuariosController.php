<?php
/**
 * Controller responsável pelos usuários, 
 * para acessar esse controller o usuário deve estar autenticado e 
 * possuir permissões de administrador
 */
class usuariosController extends Controller {


    public function __construct(){
        $this->auth = new authController();
        if(! $this->auth->adminAuth() ):
            header("Location: ".BASE_URL."login");
            exit();
        endif;
    }
    public function index(){
        
        //$dados = array('nome' => 'Gabriel');
        $usuarios = new Usuarios;
        $data = $usuarios->getUsers();
    
        $this->loadTemplate('usuarios.index', ['usuarios' => $data]);
        

    }

    public function adicionar(){
        
        $grupos = new Grupo();
        $grupos = $grupos->getGrupos();
        $this->loadTemplate('usuarios.adicionar', ['grupos' => $grupos]);
    }

    public function criar(){
        if(!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) && strlen($_POST['senha']) >= 8 && !empty($_POST['grupo'])):
            $usuario = new Usuarios();
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = password_hash(addslashes($_POST['senha']), PASSWORD_DEFAULT);
            $grupo = addslashes($_POST['grupo']);
            
            if( $usuario->verifyEmail($email) ):
            
                $data = array(
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => $senha,
                    'grupo' => $grupo
                );
                if( $usuario->createUser($data) ):
                    echo "1";
                    exit();
                endif;
            else:
                echo "0";
                exit();         
            endif;
        else:
            header("Location: ".BASE_URL."usuarios");
        endif;

    }

    public function alterar($id){
        $usuario = new Usuarios();
        if ($usuario->validId($id)):
            if(!empty($_POST['nome']) && !empty($_POST['email']) ):
                
                $usuario = new Usuarios();
                $olduser = $usuario->getUserId($id);
                $senha = $olduser['senha'];
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $grupo = addslashes($_POST['grupo']);

                if(!empty($_POST['senha'])):
                    if(strlen($_POST['senha']) >= 8):
                        $senha = password_hash(addslashes($_POST['senha']), PASSWORD_DEFAULT);
                    else:
                        echo "0";
                        exit();
                    endif;
                endif;
                
                $data = array(
                    'id' => $id,
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => $senha,
                    'grupo' => $grupo
                );
                if ($usuario->verifyEmailEdit($data)):
                    if( $usuario->editUser($data)):
                        echo "1";
                        exit();
                    else:
                        echo "0";
                        exit();
                    endif;
                else:
                    echo "0";
                    exit();
                endif;
            else:
                header("Location: ".BASE_URL."usuarios");
            endif;

        else:
            header("Location: ".BASE_URL."usuarios");
        endif;
    }

    public function abrir($id){
        $usuarios = new Usuarios;
        if ($usuarios->validId($id)):
            $produtos = new Produtos;
            $usuario = $usuarios->getUserId($id);
            $usrprodutos = $produtos->getProdutosUsuario($id);
            $qntprodutos = $produtos->getQntProdutosUsuario($id);

            
            // echo $qntprodutos;
            // exit();
            if ($usuarios):
                $data = array(
                    'usuario' => $usuario,
                    'produtos' => $usrprodutos,
                    'qntprodutos' => $qntprodutos);
                $this->loadTemplate('usuarios.abrir', $data);
            else:
                header("Location: ".BASE_URL."usuarios");
            endif;
            
        else:
            header("Location: ".BASE_URL."usuarios");
        endif;
    }

    public function editar($id){
        $usuario = new Usuarios();
        if ($usuario->validId($id)):
                
            $usuarios = new Usuarios;
            $grupos = new Grupo();
            $grupos = $grupos->getGrupos();
            $usuario = $usuarios->getUserId($id);
            $data = array(
                'usuario' => $usuario,
                'grupos' => $grupos);
            $this->loadTemplate('usuarios.editar', $data);
        else:
            header("Location: ".BASE_URL."usuarios");
        endif;
    }

    public function deletar($id){
        $usuario = new Usuarios();
        if ($usuario->validId($id) && $id != $_SESSION['usuario']):
            if( $usuario->deletaUsuario($id) ):
                echo "1";
                exit();
            else:
                echo "0";
                exit();
            endif;
        endif;
        header("Location: ".BASE_URL."usuarios");
    }

}

?>