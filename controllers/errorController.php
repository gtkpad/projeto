<?php

class errorController extends Controller{
    
    public function __construct(){
        $this->auth = new authController();
    }
    
    public function index(){

        $this->loadView('404');
    }
}

?>