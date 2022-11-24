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
    public function getTestById($id){
        $this->db->query('SELECT * FROM test WHERE test_id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    //Get test info
    public function getTest($id){
        $this->db->query('SELECT t.test_id, t.name, q.test_id, q.question_id, q.text, q.answer_id FROM test AS t INNER JOIN questions AS q ON t.test_id = q.test_id WHERE t.test_id = :id AND q.test_id = :id ORDER BY question_id ASC');
        $this->db->bind(':id', $id);
        $rows = $this->db->all();
        return $rows;
    }

    public function getAnswers($questionId, $id){
        $this->db->query('SELECT name, question_id FROM answers WHERE question_id = :question AND test_id = :id');
        $this->db->bind(':question', $questionId);
        $this->db->bind(':id', $id);
        $rows = $this->db->all();
        return $rows;
    }

}