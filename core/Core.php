<?php

/** Classe responsável por instanciar as classes dos controller recebendo o controller,
 *  método e parametros por get na variavel url utilizando o padrão mvc, caso não seja enviado nenhum 
 * controller será definido home como padrão */

class Core {

public function run(){
    
    $url = '/';
    $params = array();

    if ( isset($_GET['url']) )
        $url .= $_GET['url'];

    if ( !empty($url) && $url != '/' ):
        $url = explode('/', $url);
        array_shift($url);

        $currentController = $url[0].'Controller';
        array_shift($url);

        if( isset($url[0]) && !empty($url[0]) ):
            $currentAction = $url[0];
            array_shift($url);
        else:
            $currentAction = 'index';
        endif;

        if ( count($url) > 0 ): 
            $params = $url;
        endif;
        
    
    else:
        $currentController = 'homeController';
        $currentAction = 'index';
    endif;

    if (!file_exists('controllers/'.$currentController.'.php') || !method_exists($currentController, $currentAction) || $currentController == 'authController'):
        $currentController = 'errorController';
        $currentAction = 'index';
    endif;
    
    $controller = new $currentController();
    call_user_func_array(array($controller, $currentAction), $params);
}


}


?>