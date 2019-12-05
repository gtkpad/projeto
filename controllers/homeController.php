<?php
/**
 * Controller responsável pelo dashboard do sistema
 */
class homeController extends Controller {
   
    public function __construct(){
        $this->auth = new authController();
        if(! $this->auth->userAuth() ):
            header("Location: ".BASE_URL."login");
            exit();
        endif;
    }


    public function index(){
        
        $usuarios = new Usuarios();
        $produtos = new Produtos();
        $qntusuarios = $usuarios->getQntUsers();
        $qntprodutos = $produtos->getQntProdutos();

        $data = array(
            'qntusuarios' => $qntusuarios,
            'qntprodutos' => $qntprodutos
        );
        

        $this->loadTemplate('dashboard.index', $data);
        

    }


}

?>