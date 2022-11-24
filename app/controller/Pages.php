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
                //Load session, Pass test_id, insert user to db
                self::startSession($data['name'], $data['test_id']);
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
            //Get inputs
            $questionId = $_POST['secret_question'];
            $score = $_POST['score'];
            $num = $_POST['secret'];
            $answerId = $_POST['input'];

            
            //Check the answer
            if($answerId == $this->pageModel->getAnswer($questionId, $testId)[0]->answer_id){
                $score++;
            }

            //Update database with choices
            $this->pageModel->enter($_SESSION['name'], $questionId, $testId, $answerId, $score);

            //Check if the test has not ended
            if($num >= ($this->pageModel->getTestById($testId)->max_score - 1)){
                //Test done exit to score
                $_SESSION['score'] = $score;
                redirect('pages/score');
            }

            //Go on with test question
            $questionId++;
            $num++; 
            $data = [
                'question' => $this->pageModel->getTest($testId),
                'test' => $this->pageModel->getTestById($testId),
                'answers' => $this->pageModel->getAnswers($questionId, $testId),
                'secret_num' => $questionId,
                'score' => $score,
                'obj_num' => $num 
            ]; 
            $this->view('pages/test', $data);

        }

        //For first question
        $score = 0;
        $firstQuestionId = $this->pageModel->getTest($testId)[0]->question_id;
        $data = [
            'question' => $this->pageModel->getTest($testId),
            'test' => $this->pageModel->getTestById($testId),
            'answers' => $this->pageModel->getAnswers($firstQuestionId, $testId),
            'secret_num' => $firstQuestionId,
            'score' => $score,
            'obj_num' => 0
        ]; 
        $this->view('pages/test', $data);
    }


    //Start session with available score, user name
    public function startSession($name, $testid){
        $_SESSION['name'] = $name;
        $maxScore = $this->pageModel->getTestById($testid);
        $_SESSION['max_score'] = $maxScore->max_score;
    }


    //Load final score view
    public function score(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Logout option
            unset($_SESSION['name']);
            unset($_SESSION['max_score']);
            redirect('pages/index');
        }
        
        $this->view('pages/score');
    }
}