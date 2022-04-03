<?php
include './Controller.php';
include './../inc/Account.php';
include './../inc/DBconn.php';




class RegisterController extends Controller
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

            if (isset($body['register_form'])) {
                $email = trim($body['email']);
                $name = $body['name'];
                $password = $body['password'];
                $re_password = $body['re_password'];

                $conn = new DBConnection(NULL);

                $account = new Account($conn, null);
                if (!isset($email) || !isset($name) || !isset($password) || !isset($re_password)) {
                    header('Location: /signup');
                    exit();
                }

                if ($password !== $re_password) {
                    header('Location: /signup');
                    exit();
                }

                $res = $account->create($email, $password, $name);


                if (isset($res['err_msg'])) {
                    session_start();
                    $_SESSION['error'] = $res['err_msg'];
                    header('Location: /signup');
                    exit();
                }

                $_SESSION['id'] = $res['data']->id;
                header('Location: /storage');
                exit();
            }
            header('Location: /signup');

            exit();
        });
    }
}

new RegisterController();
