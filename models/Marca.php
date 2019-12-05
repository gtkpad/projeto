<?php

class Marca extends Model{

    public function getMarcas(){
        $data = array();
        $sql = "SELECT * FROM marca";
        $sql = $this->pdo->query($sql);
        if($sql->rowCount() > 0)
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            
        return $data;
    }

    public function getMarcaId($id){
        $data = array();
        $sql = "SELECT * FROM marca WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() == 1)
            $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function create($data = array()){
        if (!array_key_exists('nome', $data))
            return false;
        $sql = "INSERT INTO marca (nome) VALUES (:nome)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':nome', $data['nome']);
     
        if( $sql->execute() ):
            return true;
        else:
            return false;
        endif;
        
    } 

    public function validId($id){
        $sql = "SELECT id FROM marca WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    }


    public function edit($data = array()){
        if (!array_key_exists('nome', $data) && !array_key_exists('id', $data))
            return false;
        $sql = "UPDATE marca SET nome = :nome WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $data['id']);
        $sql->bindValue(':nome', $data['nome']);

        if( $sql->execute() ):
            return true;
        else:
            return false;
        endif;
        


    }

    public function delete($id){
        if ( empty($id) )
            return false;

        $sql = "DELETE FROM marca WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $id);

        if( $sql->execute() ):
            return true;
        else:
            return false;
        endif;
        

    }   
}


?>