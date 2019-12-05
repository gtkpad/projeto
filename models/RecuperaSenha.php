<?php

class recuperaSenha extends Model{

    public function getByHash($hash){
        $data = array();
        
        $sql = "SELECT * FROM recupera_senha WHERE hash = :hash";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue('hash', $hash);
        $sql->execute();
        if ($sql->rowCount() == 1):
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        else:
            return false;
        endif;
        
    }


    public function verifyLastDay($id){

        $sql = "SELECT * FROM recuperar_senha WHERE usuario_id = :id AND usado = 0 AND data_solicitacao >= NOW() - INTERVAL 1 DAY";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0):
            return true;
        else:
            return false;
        endif;
    }

    public function generateHash($data = array()){
        if (!array_key_exists('hash', $data) && !array_key_exists('usuario', $data))
            return false;
        $sql = "INSERT INTO recuperar_senha (hash, usuario_id, usado) VALUES (:hash, :usuario, 0)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue('hash', $data['hash']);
        $sql->bindValue('usuario', $data['usuario']);
        if ( $sql->execute() ):
            return true;
        endif;
        return false;
    }

    public function usedHash($id){
        $sql = "UPDATE recuperar_senha SET usado = 1 WHERE id = :id AND usado = 0";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        if ($sql->execute()):
            return true;
        else:
            return false;
        endif;
    }

    public function getHash($hash){
        if (empty($hash))
            return false;
        $sql = "SELECT * FROM recuperar_senha WHERE hash = :hash AND usado = 0";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":hash", $hash);
        $sql->execute();
        if($sql->rowCount() == 1):
            return $sql->fetch();
        else:
            return false;
        endif;
    }
}


?>