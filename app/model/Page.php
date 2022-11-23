<?php

class Page 
{
    public function __construct()
    {
        //Init database
        $this->db = new Database();
    }

    public function getTest(){
        $this->db->query('SELECT * FROM test');
        $rows = $this->db->all();
        return $rows;
    }

    public function getTestById($id){
        $this->db->query('SELECT * FROM test WHERE test_id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getQuestion($testId){
        //Most confusing query i've ever wrote 
        $this->db->query('SELECT t.test_id, t.name, q.test_id, q.question_id, q.text, q.answer_id FROM test AS t INNER JOIN questions AS q ON t.test_id = q.test_id WHERE t.test_id = :id AND q.test_id = :id ORDER BY question_id ASC');
        $this->db->bind(':id', $testId);
        $rows = $this->db->all();
        return $rows;
    }
}