<?php

/**
 * Classe possui métodos para auxiliar os controllers
 */

class Controller{


    public function __contruct(){
        $this->auth = new authController();
    }

    public function loadView($viewName, $data = array()){
        
        extract($data);
        $viewName = str_replace('.', '/', $viewName);
        require 'views/'.$viewName.'.php';


    }

    public function adminRedirect(){
        if (! $this->auth->adminAuth()):
            header("Location: ".BASE_URL);
            exit();
        endif;
    }

    public function loadTemplate($viewName, $viewData = array()){
        require 'views/template.php';
    }   

    public function loadViewInTemplate($viewName, $viewData = array()){

        extract($viewData);
        $viewName = str_replace('.', '/', $viewName);
        require 'views/'.$viewName.'.php';
    }

    public function recebeImagem($imagem = array()){
        if(isset($imagem['tmp_name']) && !empty($imagem['tmp_name'])):
            $tipo = $imagem['type'];
            if(in_array($tipo, array('image/jpeg', 'image/png'))):
                $nomedaimagem = md5(time().rand(0,999).time()).".jpg";
                
                move_uploaded_file($imagem['tmp_name'], 'assets/images/produtos/'.$nomedaimagem);
                list($width_origin, $height_origin) = getimagesize('assets/images/produtos/'.$nomedaimagem);
                    $ratio = $width_origin/$height_origin;
                    $width = 500;
                    $height = 500;
                    if($width/$height > $ratio):
                        $width = $height*$ratio;
                    else:
                        $height = $width/$ratio;
                    endif;
                    $img = imagecreatetruecolor($width, $height);
                    if($tipo == 'image/jpeg'):
                        $origi = imagecreatefromjpeg('assets/images/produtos/'.$nomedaimagem);
                    elseif ($tipo == 'image/png'):
                        $origi = imagecreatefrompng('assets/images/produtos/'.$nomedaimagem);
                    endif;


                    imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_origin, $height_origin);
                    imagejpeg($img, 'assets/images/produtos/'.$nomedaimagem, 80);
                    return $nomedaimagem;
            endif;
        endif;
        return false;
    }
}



?>