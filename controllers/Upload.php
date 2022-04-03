<?php
include './Controller.php';
include './../inc/Account.php';
include './../inc/File.php';
include './../inc/DBconn.php';




class UploadController extends Controller
{

    public function __construct()
    {
        session_start();
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

            if (isset($body['privacy'])) {
                $privacy = $body['privacy'];
                $files = $_FILES['file_data'];

                print_r($files);
                echo "<br/>";
                print_r($privacy);

                if (!isset($privacy)) {
                    header('Location: /upload');
                    exit();
                }
                $conn = new DBConnection(null);
                $file = new File($conn, null);
                $res = $file->create($files, $privacy);

                if ($res['err_msg']) {
                    header('Location: /upload');
                    $_SESSION['err_msg'] = $res['err_msg'];
                    exit();
                }

                $_SESSION['success_msg'] = 1;

                header('Location: /storage');
            }

            // header('Location: /upload');

            exit();
        });
    }
}

new UploadController();
