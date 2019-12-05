<?php
/**
 * Controller responsável pelas categorias, para acessar esse controller o usuário deve esstar autenticado
 * 
 */
class categoriaController extends Controller{

    public function __construct(){
        $this->auth = new authController();
        if(! $this->auth->userAuth() ):
            header("Location: ".BASE_URL."login");
            exit();
        endif;
    }

    public function adicionar(){
        $this->adminRedirect();
        if ($_POST['nome']):
            $categoria = new Categoria();

            $nome = addslashes($_POST['nome']);
            $data = array('nome' => $nome);

            $categoria->create($data);
            header("Location: ".BASE_URL."categoria");
            

        endif;
        $this->loadTemplate('categorias.adicionar');
    }

    public function deletar($id){
        $this->adminRedirect();
        $categoria = new Categoria();
        if ($categoria->validId($id)):
            if( $categoria->delete($id) ):
                echo 1;
            else:
                echo 0;            
            endif;
        endif;
         
    }

    public function editar($id){
        $this->adminRedirect();
        $categoria = new Categoria();
        if ($categoria->validId($id)):
            if(!empty($_POST['nome'])):
                $nome = addslashes($_POST['nome']);
            

                $data = array(
                    'id' => $id,
                    'nome' => $nome
                );
                $categoria->edit($data);
               
            endif;
        else:
            header("Location: ".BASE_URL."categoria");
        endif;
        header("Location: ".BASE_URL."categoria/abrir/".$id);
    }

    public function abrir($id){

        $categoria = new Categoria();
        if ( $categoria->validId($id ) ):
            $produtos = new Produtos();
            $dbcategoria = $categoria->getCategoriaId($id);
            $dbprodutos = $produtos->getProdutosCategoriaID($id);
            $data = array(
                'categoria' => $dbcategoria,
                'produtos' => $dbprodutos['produtos'],
                'qntprodutos' => $dbprodutos['qnt']
            );
            $this->loadTemplate('categorias.abrir', $data);
        else:
            header("Location: ".BASE_URL."categoria");
        endif;
    }

    public function index(){

        $categorias = new Categoria();
        $dbcategorias = $categorias->get();
        $data = array(
            'categorias' => $dbcategorias
        );
    
        $this->loadTemplate('categorias.index', $data);
    }

    



}


?>