<?php
session_start();
require 'config.php';

/* carrega automáticamente os arquivos das classes usadas nos controllers, models e core */
spl_autoload_register(function($class){

    if( file_exists('controllers/'.$class.'.php') ):
        require 'controllers/'.$class.'.php';
    elseif( file_exists('models/'.$class.'.php') ):
        require 'models/'.$class.'.php';
    elseif( file_exists('core/'.$class.'.php') ):
        require 'core/'.$class.'.php';
    endif;

});

$core = new Core();
$core->run();
?>