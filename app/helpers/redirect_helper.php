<?php

function redirect($filename){
    header('Location: '. URLROOT . '/' . $filename);
}