<?php

class File
{

    public $uid = null;
    private $conn = null;
    private $tblname = "files";
    public $data = null;
    private  $base_path = '/Users/bloodyrich/Desktop/BTECH/WEBTECH/EXAMS/store/';


    public function __construct($conn, int $uid = null)
    {
        session_start();
        $this->conn = $conn;
        if (isset($uid)) {
            $this->uid = $uid;
            $this->data = $this->getUid($this->uid);
        }
    }

    public function getUid( $id = null)
    {
        if (isset($id)) {
            $this->id = $id;
        }
        $prepareStmt = $this->conn->prepare("SELECT * FROM `$this->tblname` WHERE `uid`=? ");
        $prepareStmt->execute([$this->id]);
        return $prepareStmt->fetch();
    }

    public function create($file, $privacy)
    {

        $name = $file["name"];
        $size = $file["size"];
        $ext = end(explode(".", $name));

        $today = date("Y-m-d H:i:s");
        $uid = uniqid();


        try {




            if (move_uploaded_file($file['tmp_name'], $this->base_path . $uid . '.' . $ext)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }



            $prepareStmt = $this->conn->prepare("INSERT INTO `$this->tblname`(`id`,`account_id`,`name`,`ext`,`uid`,`size`,`privacy`,`created_at`) VALUES (NULL,?,?,?,?,?,?,?);");
            $response = $prepareStmt->execute([$_SESSION['id'], $name, $ext, $uid, $size, $privacy, $today]);
            return array('err_msg' => null, 'data' => $response);
        } catch (Exception $e) {
            print_r($e->getMessage());
            $err_msg = "Something happend trying to persist the user.";
            return array('err_msg' => $err_msg, 'data' => null);
        }
    }
}
