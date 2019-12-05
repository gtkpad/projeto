<?php
/**
 * Controller responsável pelos produtos, para acessar o usuário deverá estar autenticado
 * para funcionar o cadastro de novos produtos é necessário dar permissão de escrita no diretório do sistema
 * pois o sistema move as imagens enviadas para o diretório assets
 */
class produtoController extends Controller{


    public function __construct(){
        $this->auth = new authController();
        if(! $this->auth->userAuth() ):
            header("Location: ".BASE_URL."login");
            exit();
        endif;
    }
    public function index(){
        $produtos = new Produtos();
        $produtos = $produtos->get();
        $data = array('produtos' => $produtos);
        $this->loadTemplate('produtos.index', $data);
    }
 
    public function editar($id){
        $this->adminRedirect();
        if( !empty($_POST['nome']) && !empty($_POST['categoria']) && !empty($_POST['marca']) && !empty($_POST['descricao'])):
            $imagem = $_FILES['imagem'];
            $produto = new Produtos();
            $dbproduto = $produto->getID($id);
            $nomedaimagem = $dbproduto['imagem'];
            $nome = addslashes($_POST['nome']);
            $categoria = addslashes($_POST['categoria']);
            $usuario = $_SESSION['usuario'];
            $descricao = addslashes($_POST['descricao']);
            $marca = addslashes($_POST['marca']);

            //para funcionar o upload de imagem o usuario do apache deve possuir permissão de escrita
            if (!empty($_FILES['imagem'])):
                $tmpnomedaimagem = $this->recebeImagem($imagem);
                if ($tmpnomedaimagem != false):
                    unlink('assets/images/produtos/'.$nomedaimagem);
                    $nomedaimagem = $tmpnomedaimagem;
                else:
                    header("Location: ".BASE_URL."usuario/abrir/".$id);
                endif;
            endif;


            $data = array(
                'id' => $id,
                'nome' => $nome,
                'categoria' => $categoria,
                'usuario' => $usuario,
                'marca' => $marca,
                'imagem' => $nomedaimagem,
                'descricao' => $descricao
            );
            $produto->edit($data);
            header('Location: '.BASE_URL."produto/abrir/".$id);
            exit();
        else:
            $produto = new Produtos();
            $categorias = new Categoria();
            $marcas = new Marca();
            $marcas = $marcas->getMarcas();
            $categorias = $categorias->get();
            $dbproduto = $produto->getID($id);
            $data = array(
                'produto' => $dbproduto,
                'marcas' => $marcas,
                'categorias' => $categorias
            );
            $this->loadTemplate('produtos.editar', $data);
        endif;        

    }

    public function abrir($id){
        $produto = new Produtos();
        if( $produto->validId($id)):
            $produto = $produto->getID($id);

           $data = array(
                'produto' => $produto
            );
            $this->loadTemplate('produtos.abrir', $data);
        else:
            header("Location: ".BASE_URL."produto");
        endif;
    }

    public function deletar($id){
        $this->adminRedirect();
        $produto = new Produtos();
        if($produto->validId($id)):
            $dbproduto = $produto->getID($id);
            if($produto->deletar($id)):        
                unlink('assets/images/produtos/'.$dbproduto['imagem']);
                echo 1;
            else:
                echo 0;
            endif;
        else:
            header("Location: ".BASE_URL."produto");
        endif;
    }

    public function adicionar(){
        $this->adminRedirect();
        if( !empty($_POST['nome']) && !empty($_POST['categoria']) && !empty($_POST['marca']) && !empty($_FILES['imagem']['tmp_name']) && ! empty($_POST['descricao'])):
            $imagem = $_FILES['imagem'];
            
            $produto = new Produtos();

            //para funcionar o upload de imagem o usuario do apache deve possuir permissão de escrita
            $nomedaimagem = $this->recebeImagem($imagem);

            if($nomedaimagem != false):

                $nome = addslashes($_POST['nome']);
                $categoria = addslashes($_POST['categoria']);
                $usuario = $_SESSION['usuario'];
                $descricao = addslashes($_POST['descricao']);
                $marca = addslashes($_POST['marca']);
                  
                $data = array(
                    'nome' => $nome,
                    'categoria' => $categoria,
                    'usuario' => $usuario,
                    'marca' => $marca,
                    'imagem' => $nomedaimagem,
                    'descricao' => $descricao
                    );
                    $produto->create($data);
                    header('Location: '.BASE_URL."produto");
                    exit();
            else:
                header("Location: ".BASE_URL."produto/adicionar");
            endif;
            
        else:
            $categorias = new Categoria();
            $marcas = new Marca();
            $marcas = $marcas->getMarcas();
            $categorias = $categorias->get();
            $data = array(
                'marcas' => $marcas,
                'categorias' => $categorias
            );
            $this->loadTemplate('produtos.adicionar', $data);
        endif;
    }
}

?>