<?php
require_once '../app/config/config.php';
require_once '../app/helpers/session_helper.php';
require_once '../app/helpers/redirect_helper.php';


spl_autoload_register(function($classname){
    require_once '../app/libraries/' . $classname . '.php';
});