<?php

class Page 
{
    public function __construct()
    {
        //Init database
        $this->db = new Database();
    }

    //Get test name
    public function getTestName(){
        $this->db->query('SELECT * FROM test');
        $rows = $this->db->all();
        return $rows;
    }

    //Get test by id
    public function getTestById($testid){
        $this->db->query('SELECT * FROM test WHERE test_id = :id');
        $this->db->bind(':id', $testid);
        $row = $this->db->single();
        return $row;
    }

    //Get test info
    public function getTest($testid){
        $this->db->query('SELECT t.test_id, t.name, q.test_id, q.question_id, q.text, q.answer_id FROM test AS t INNER JOIN questions AS q ON t.test_id = q.test_id WHERE t.test_id = :id AND q.test_id = :id ORDER BY question_id ASC');
        $this->db->bind(':id', $testid);
        $rows = $this->db->all();
        return $rows;
    }

    //Get all answers
    public function getAnswers($questionId, $testid){
        $this->db->query('SELECT name, question_id, answer_id FROM answers WHERE question_id = :question AND test_id = :id');
        $this->db->bind(':question', $questionId);
        $this->db->bind(':id', $testid);
        $rows = $this->db->all();
        return $rows;
    }

    //Get current answer
    public function getAnswer($questionId, $testid){
        $this->db->query('SELECT answer_id FROM questions WHERE question_id = :qid AND test_id = :tid');
        $this->db->bind(':qid', $questionId);
        $this->db->bind(':tid', $testid);
        $row = $this->db->all();
        return $row;
    }

    //Save entered data
    public function enter($user, $questionId, $testId, $answerId, $score){
        $this->db->query('INSERT INTO choices (user, question_id, test_id, answer_id, score) VALUES (:user, :qid, :tid, :aid, :score)');
        $this->db->bind(':qid', $questionId);
        $this->db->bind(':tid', $testId);
        $this->db->bind(':aid', $answerId);
        $this->db->bind(':score', $score);
        $this->db->bind(':user', $user);
        $this->db->execute();
    }


}