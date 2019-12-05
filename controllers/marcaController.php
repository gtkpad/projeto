<?php
/**
 * Controller responsável pelas marcas, para acessar o usuário deverá estar autenticado
 */
class marcaController extends Controller{
    
    public function __construct(){
        $this->auth = new authController();
        if(! $this->auth->userAuth() ):
            header("Location: ".BASE_URL."login");
            exit();
        endif;
    }

    public function index(){

        $marcas = new Marca();
        $dbmarcas = $marcas->getMarcas();
        $data = array(
            'marcas' => $dbmarcas
        );

        $this->loadTemplate('marcas.index', $data);
    }

    public function adicionar(){
        $this->adminRedirect();
        if (!empty($_POST['nome'])):
            $marca = new Marca();
            $nome = addslashes($_POST['nome']);
            $data = array(
                'nome' => $nome
            );
            $marca->create($data);
            header("Location: ".BASE_URL."marca");
        endif;
        $this->loadTemplate('marcas.adicionar');
    }

    public function abrir($id){
        $marca = new Marca();
        if ($marca->validId($id)):
            $produtos = new Produtos();
            $dbmarca = $marca->getMarcaId($id);
            $dbprodutos = $produtos->getProdutosMarcaID($id);
            $data = array(
                'marca' => $dbmarca,
                'produtos' => $dbprodutos['produtos'],
                'qntprodutos' =>$dbprodutos['qnt']
            );
            $this->loadTemplate('marcas.abrir', $data);
        else:
            header("Location: ".BASE_URL."marca");
        endif;
    }

    public function editar($id){
        $this->adminRedirect();
        $marca = new Marca();
        if ($marca->validId($id)):
            if(!empty($_POST['nome'])):
                $nome = addslashes($_POST['nome']);
            

                $data = array(
                    'id' => $id,
                    'nome' => $nome
                );
                $marca->edit($data);
               
            endif;
        else:
            header("Location: ".BASE_URL."categoria");
        endif;
        header("Location: ".BASE_URL."marca/abrir/".$id);
    }

    public function deletar($id){
        $this->adminRedirect();
        $marca = new Marca();
        if ($marca->validId($id)):
            if( $marca->delete($id) ):
                echo 1;
            else:
                echo 0;            
            endif;
        endif;
        
    }
}

?>