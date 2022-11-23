<?php

class Pages extends Controller 
{
    public function __construct()
    {
        $this->pageModel = $this->model('Page');
    }
    public function index(){
        $data = [
            'name' => '',
            'name_error' => '',
            'test' => $this->pageModel->getTest()
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'name' => $_POST['name'],
                'test_id' => $_POST['test'],
                'name_error' => ''
            ];
            if(empty($data['name'])){
                $data['name_error'] = 'Vārds nav ievadīts!';
            }

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
        //Pass test info / questions
        $data = [
            'test' => $this->pageModel->getTestById($testId),
            'questions' => $this->pageModel->getQuestion($testId)
        ];
        $this->view('pages/test', $data);
    }

    public function startSession($name){
        $_SESSION['name'] = $name;
    }
}