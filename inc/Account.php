
<?php



class Account
{

    public $id = null;
    private $conn = null;
    private $tblname = "accounts";
    public $data = null;

    public function __construct($conn, int $id = null) {
        $this->conn = $conn;
        if (isset($id)) {
            $this->id = $id;
            $this->data = $this->getId($this->id);
        }
    }

    public function create($email, $password, $name){
        $err_msg = null;
        $data = null;

        if (!isset($email) || !isset($password) || !isset($name)) {
            $err_msg = "empty name or email or password";
            return array('err_msg' => $err_msg, 'data' => $data);
        }

        $prepareStmt = $this->conn->prepare("SELECT * FROM `$this->tblname` WHERE `email`=? ");
        $prepareStmt->execute([$email]);

        $row = $prepareStmt->fetchAll();

        if (count($row) > 0) {
            $err_msg = "Sorry account with this email address already exists";
            return array('err_msg' => $err_msg, 'data' => $data);
        }

        $hash_pwd  = password_hash($password, PASSWORD_DEFAULT);
        $today = date("Y-m-d H:i:s");

        try {
            $prepareStmt = $this->conn->prepare("INSERT INTO  `$this->tblname`(`name`,`email`,`password`,`created_at`) VALUES(?,?,?,?) ");
            $response = $prepareStmt->execute([$name, $email, $hash_pwd, $today]);
            return $response;
        } catch (Exception $e) {
            print_r($e->getMessage());
            $err_msg = "Something happend trying to persist the user.";
            return array('err_msg' => $err_msg, 'data' => $data);
        }
    }

    public function getId(int $id = null){
        if (isset($id)) {
            $this->id = $id;
        }
        $prepareStmt = $this->conn->prepare("SELECT * FROM `$this->tblname` WHERE `id`=? ");
        $response = $prepareStmt->execute([$this->id]);
        return $response;
    }

    public function deleteId($id = null){
        if (isset($id)) {
            $this->id = $id;
        }
        $prepareStmt = $this->conn->prepare("DELETE FROM `$this->tblname` WHERE `id`=? ");
        $response = $prepareStmt->execute([$this->id]);
        return $response;
    }

    public function authLogin(string $email, string $password){
        $err_msg = null;
        $data = null;
        if (!isset($email) || !isset($password)) {
            $err_msg = "empty email or password";
            return array('err_msg' => $err_msg, 'data' => $data);
        }

        $prepareStmt = $this->conn->prepare("SELECT * FROM `$this->tblname` WHERE `email`=? ");
        $prepareStmt->execute([$email]);

        $row = $prepareStmt->fetchAll();
       

        if (count($row) > 1 or count($row) < 1) {
            $err_msg = "Something happend check email or password might be wrong";
            return array('err_msg' => $err_msg, 'data' => $data);
        }


        if (password_verify($password, $row[0]->password)) {
            $err_msg = null;
            // $_SESSION['account_id'] = $row->id;
            return array('err_msg' => $err_msg, 'data' => $row[0]);
        }


        $err_msg = "Invalid email or password try agian.";
        return array('err_msg' => $err_msg, 'data' => $data);
    }


    public function files($id = null){
        $tblname = 'files';
        $err_msg = null;
        $data = null;
        if (isset($id)) {
            $this->id = $id;
        }
        if (!isset($this->id)) {
            $err_msg = "Can't get files of a null account";
            return array('err_msg' => $err_msg, 'data' => $data);
        }

        $prepareStmt = $this->conn->prepare("SELECT * FROM `$tblname` WHERE `account_id`=? ");
        $prepareStmt->execute([$this->id]);
        $data = $prepareStmt->fetchAll();
        return array('err_msg' => $err_msg, 'data' => $data);
    }
}


// $conn = new DBConnection(NULL);
// $acc = new Account($conn, null);
// $res  = $acc->create('peetest@outlook.com', '123456', 'theCreator');
// $lg = $acc->authLogin('peetest@outlook.com','123456');
// $files = $acc->files($lg['data']->id);
// // print_r($res);
// print_r($lg);
// print_r($files);
