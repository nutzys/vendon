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
        //On post request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $questionId = $_POST['secret_question'];
            $num = $_POST['secret'];
            $questionId++;
            $num++; 
            $data = [
                'question' => $this->pageModel->getTest($testId),
                'test' => $this->pageModel->getTestById($testId),
                'answers' => $this->pageModel->getAnswers($questionId, $testId),
                'secret_num' => $questionId,
                'obj_num' => $num 
            ]; 
            $this->view('pages/test', $data);

        }
        $firstQuestionId = $this->pageModel->getTest($testId)[0]->question_id;
        $data = [
            'question' => $this->pageModel->getTest($testId),
            'test' => $this->pageModel->getTestById($testId),
            'answers' => $this->pageModel->getAnswers($firstQuestionId, $testId),
            'secret_num' => $firstQuestionId,
            'obj_num' => 0
        ]; 
        $this->view('pages/test', $data);
    }

    public function startSession($name){
        $_SESSION['name'] = $name;
    }

    //current test first question id
}