<?php

class Usuarios extends Model{


    public function getUsers(){
        $data = array();
        $sql = "SELECT * FROM usuario";
        $sql = $this->pdo->query($sql);
        if($sql->rowCount() > 0)
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);     
        return $data;
    }

    public function getQntUsers(){
        $sql = $this->pdo->query('SELECT id FROM usuario');
        return $sql->rowCount();
    }

    public function getUserId($id){
        $data = array();
        $sql = "SELECT usuario.*, grupo.nome as grupo_nome, grupo.permissoes as permissoes FROM usuario LEFT JOIN grupo ON usuario.grupo_id = grupo.id WHERE usuario.id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() == 1):
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        else:
            return false;
        endif;
    }

    public function deletaUsuario($id){
        $sql = "DELETE FROM recupera_senha WHERE usuario_id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        $sql = "DELETE FROM usuario WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        if($sql->execute()):
            return true;
        endif;
        
        return false;
    }

    public function validId($id){
        $sql = "SELECT id FROM usuario WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() == 1):
            return true;
        else:
            return false;
        endif;
    }

    public function createUser($data = array()){
        if (!array_key_exists('nome', $data) && !array_key_exists('email', $data) && !array_key_exists('senha', $data) && !array_key_exists('grupo', $data))
            return false;

        $sql = "INSERT INTO usuario (nome, email, senha, grupo_id) VALUES (:nome, :email, :senha, :grupo)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':nome', $data['nome']);
        $sql->bindValue(':email', $data['email']);
        $sql->bindValue(':senha', $data['senha']);
        $sql->bindValue(':grupo', $data['grupo']);
        
        if( $sql->execute() ):
            return true;
        else:
            return false;
        endif;
        

    }

    public function editUser($data = array()){
        if (!array_key_exists('nome', $data) || !array_key_exists('email', $data) || !array_key_exists('senha', $data) || !array_key_exists('grupo', $data) || !array_key_exists('id', $data))
            return false;

        $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha, grupo_id = :grupo WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $data['id']);
        $sql->bindValue(':nome', $data['nome']);
        $sql->bindValue(':email', $data['email']);
        $sql->bindValue(':senha', $data['senha']);
        $sql->bindValue(':grupo', $data['grupo']);
        
        if( $sql->execute() ):
            return true;
        else:
            return false;
        endif;
        


    }

    public function removeUser($id){
        if ( empty($id) )
            return false;

        $sql = "DELETE FROM usuario WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $id);

        if( $sql->execute() ):
            return true;
        else:
            return false;
        endif;
        
    }   
    public function verifyEmailEdit($data = array()){
        if (!array_key_exists('email', $data) || !array_key_exists('id', $data))
            return false;
        
        $sql = "SELECT id FROM usuario WHERE email = :email AND NOT id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $data['email']);
        $sql->bindValue(":id", $data['id']);
        $sql->execute();
        if ($sql->rowCount() > 0):
            return false;
        else:
            return true;
        endif;
    }
    public function verifyEmail($email){
        if ( empty($email) )
            return false;

        $sql = "SELECT id FROM usuario WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();
        if ($sql->rowCount() > 0):
            return false;
        else:
            return true;
        endif;
    }
    
    public function alteraSenha($data = array()){
        if (!array_key_exists('senha', $data) || !array_key_exists('id', $data))
            return false;
        $sql = "UPDATE usuario SET senha = :senha WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $data['id']);
        $sql->bindValue(':senha', $data['senha']);
        if($sql->execute()):
            return true;
        else:
            return false;
        endif;
    }

    public function getAuth($email){
        if ( empty($email) )
            return false;
        $sql = "SELECT usuario.*, grupo.permissoes as permissoes, grupo.nome as nome_grupo FROM usuario LEFT JOIN grupo ON usuario.grupo_id = grupo.id WHERE usuario.email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();
        if ( $sql->rowCount() == 1 ):
            return $sql->fetch();
        else:
            return false;
        endif;
    
    }
}


?>