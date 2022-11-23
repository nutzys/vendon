<?php

class Pages extends Controller 
{
    public function __construct()
    {
        $this->pageModel = $this->model('Page');
    }

    //Index page
    public function index(){

        //Data with tests for select
        $data = [
            'name' => '',
            'name_error' => '',
            'test' => $this->pageModel->getTestName()
        ];

        //If submited
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Get inputs, test names
            $data = [
                'name' => $_POST['name'],
                'test_id' => $_POST['test'],
                'test' => $this->pageModel->getTestName(),
                'name_error' => ''
            ];

            //Error check
            if(empty($data['name'])){
                $data['name_error'] = 'Vārds nav ievadīts!';
            }

            //
            if(empty($data['name_error'])){
                //Load session, Pass test_id
                self::startSession($data['name']);
                redirect('pages/test/'. $data['test_id']);
                
            }else{
                //Load with errors
                $this->view('pages/index', $data);
            }
        }

        $this->view('pages/index', $data);
    }

    //Load test view
    public function test($testId){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $num = $_POST['secret'];
            $num++;
            $data = [
                'question' => $this->pageModel->getTest($testId),
                'test' => $this->pageModel->getTestById($testId),
                'obj_num' => $num
            ]; 
            $this->view('pages/test', $data);

        }
        $data = [
            'question' => $this->pageModel->getTest($testId),
            'test' => $this->pageModel->getTestById($testId),
            'obj_num' => 0
        ]; 
        $this->view('pages/test', $data);

    }

    public function startSession($name){
        $_SESSION['name'] = $name;
    }

    //first object text, second obj text
}