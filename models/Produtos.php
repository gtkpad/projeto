<?php

class Produtos extends Model{

    public function get(){
        $data = array();
        $sql = "SELECT produto.*, categoria.nome as categoria, marca.nome as marca, usuario.nome as usuario FROM produto
                LEFT JOIN categoria ON produto.categoria_id = categoria.id
                LEFT JOIN usuario ON produto.usuario_id = usuario.id
                LEFT JOIN marca ON produto.marca_id = marca.id";
        $sql = $this->pdo->query($sql);

        if ($sql->rowCount() > 0)
            $data = $sql->fetchAll(); 
        return $data;
    }

    public function getQntProdutos(){
        $sql = $this->pdo->query('SELECT id FROM produto');
        return $sql->rowCount();
    }


    public function getID($id){
        $data = array();
        $sql = "SELECT produto.*, categoria.nome as categoria, marca.nome as marca, usuario.nome as usuario FROM produto
                LEFT JOIN categoria ON produto.categoria_id = categoria.id
                LEFT JOIN usuario ON produto.usuario_id = usuario.id
                LEFT JOIN marca ON produto.marca_id = marca.id
                WHERE produto.id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() == 1)
            $data = $sql->fetch(); 
        return $data;
    }

    public function validId($id){
        $sql = "SELECT id FROM produto WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    }
    
    public function getQntProdutosUsuario($id){
        $data = array();
        $sql = "SELECT id FROM produto WHERE usuario_id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        
        return $sql->rowCount();

    }

    
    public function getProdutosMarcaID($id){
        $data = array();
        $sql = "SELECT produto.*, categoria.nome as categoria, marca.nome as marca FROM produto
                LEFT JOIN categoria ON produto.categoria_id = categoria.id
                LEFT JOIN marca ON produto.marca_id = marca.id
                WHERE marca_id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0):
            $data = array(
                'produtos' => $sql->fetchAll(),
                'qnt' => $sql->rowCount()
            );
        else:
            $data = array(
                'produtos' => array(),
                'qnt' => $sql->rowCount()
            );
        endif; 
        return $data;
    }


    public function getProdutosCategoriaID($id){
        $data = array();
        $sql = "SELECT produto.*, categoria.nome as categoria, marca.nome as marca FROM produto
                LEFT JOIN categoria ON produto.categoria_id = categoria.id
                LEFT JOIN marca ON produto.marca_id = marca.id
                WHERE categoria_id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0):
            $data = array(
                'produtos' => $sql->fetchAll(),
                'qnt' => $sql->rowCount()
            );
        else:
            $data = array(
                'produtos' => array(),
                'qnt' => $sql->rowCount()
            );
        endif; 
        return $data;
    }

    public function getProdutosUsuario($id){
        $data = array();
        $sql = "SELECT produto.*, categoria.nome as categoria, marca.nome as marca FROM produto
                LEFT JOIN categoria ON produto.categoria_id = categoria.id
                LEFT JOIN marca ON produto.marca_id = marca.id
                WHERE usuario_id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0):
            $data = $sql->fetchAll();
        endif;

        return $data;

    }

    public function create($data = array()){
        if (!array_key_exists('nome', $data) || !array_key_exists('categoria', $data) || !array_key_exists('marca', $data) || !array_key_exists('usuario', $data) || !array_key_exists('imagem', $data)  || !array_key_exists('descricao', $data))
            return false;

        $sql = "INSERT INTO produto (nome, descricao, imagem, usuario_id, categoria_id, marca_id) VALUES (:nome, :descricao, :imagem, :usuario, :categoria, :marca)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':nome', $data['nome']);
        $sql->bindValue(':descricao', $data['descricao']);
        $sql->bindValue(':imagem', $data['imagem']);
        $sql->bindValue(':usuario', $data['usuario']);
        $sql->bindValue(':categoria', $data['categoria']);
        $sql->bindValue(':marca', $data['marca']);
        if( $sql->execute() ):  
            return true;
        else:
            return false;
        endif;
        

    }

    public function deletar($id){
        if(!empty($id)):
            $sql = "DELETE FROM produto WHERE id = :id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            if($sql->execute()):
                return true;
            else:
                return false;
            endif;
        endif;
    }

    public function edit($data = array()){
        if (!array_key_exists('nome', $data) || !array_key_exists('categoria', $data) || !array_key_exists('marca', $data) ||!array_key_exists('usuario', $data) || !array_key_exists('imagem', $data)  || !array_key_exists('descricao', $data) || !array_key_exists('id', $data))
            return false;

        $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, imagem = :imagem, usuario_id = :usuario, categoria_id = :categoria, marca_id = :marca WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $data['id']);
        $sql->bindValue(':nome', $data['nome']);
        $sql->bindValue(':descricao', $data['descricao']);
        $sql->bindValue(':imagem', $data['imagem']);
        $sql->bindValue(':usuario', $data['usuario']);
        $sql->bindValue(':categoria', $data['categoria']);
        $sql->bindValue(':marca', $data['marca']);
        if( $sql->execute() ):  
            return true;
        else:
            return false;
        endif;
        

    }



}


?>