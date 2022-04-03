<?php
include './Controller.php';
include './../inc/Account.php';
include './../inc/DBconn.php';




class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->method == 'POST') {
            $this->___POST();
        } elseif ($this->method == 'GET') {
            $this->___GET();
        } else {
            echo 'This method is not supported';
            exit();
        }
    }


    public function ___GET()
    {
        $this->get(function ($request) {
            header('Location: /login');
            exit();
        });
    }

    public function ___POST()
    {



        $this->post(function ($body) {

            if (isset($body['login_form'])) {
                $email = trim($body['email']);
                $password = $body['password'];
                $conn = new DBConnection(NULL);

                $account = new Account($conn, null);
                $res = $account->authLogin($email, $password);



                if (isset($res['err_msg'])) {
                    session_start();
                    $_SESSION['error'] = $res['err_msg'];
                    header('Location: /login');
                    exit();
                }

                $_SESSION['id'] = $res['data']->id;
                header('Location: /storage');
                exit();
            }
            header('Location: /login');

            exit();
        });
    }
}

new AuthController();
