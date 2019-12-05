<?php

class Grupo extends Model{

    public function getGrupos(){
        $data = array();
        $sql = "SELECT * FROM grupo";
        $sql = $this->pdo->query($sql);
        if ($sql->rowCount() > 0):
            $data = $sql->fetchAll();
        endif;

        return $data;
    }

}

?>