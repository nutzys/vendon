<?php

class Controller
{

    //Make model
    public function model($model){
        require_once '../app/model/' . $model . '.php';
        return new $model();
    }

    //Show view
    public function view($view, $data = []){
        if(file_exists('../app/view/'. $view . '.php')){
            require_once '../app/view/' . $view . '.php';
        }else{
            die('File doesnt exist');
        }
    }
}