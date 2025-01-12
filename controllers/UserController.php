<?php
require_once 'models/User.php';
require_once 'config/Database.php';

class UserController {
    private $user;
    private $db;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
    }

    public function index() {
        $result = $this->user->read();
        require_once 'views/users/index.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->name = $_POST['name'];
            $this->user->email = $_POST['email'];
            
            if ($this->user->create()) {
                header("Location: index.php?action=index");
            }
        }
        require_once 'views/users/login.php';
    }

   

    public function register($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->id = $id;
            $this->user->name = $_POST['name'];
            $this->user->email = $_POST['email'];
            
            if ($this->user->update()) {
                header("Location: index.php?action=index");
            }
        }
    }


    public function logout

 
}