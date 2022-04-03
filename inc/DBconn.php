<?php

class DBConnection extends PDO
{
    private $filename = 'sqlite:/Users/bloodyrich/Desktop/BTECH/WEBTECH/EXAMS/database.sqlite';
    
    public $db = null;
    public function __construct($filename)
    {

        if (isset($filename)) {
            $this->filename = 'sqlite:' . $filename;
        }
        try {
            
            parent::__construct($this->filename);
            // $db = new PDO($this->filename);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            // $this->db = $db;
            print_r("connected");
        } catch (PDOException $e) {
            echo $e->getMessage();
            $db = NULL;
            return null;
        }
        
       
    }
}

