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

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->name = $_POST['name'];
            $this->user->email = $_POST['email'];
            
            if ($this->user->create()) {
                header("Location: index.php?action=index");
            }
        }
        require_once 'views/users/create.php';
    }

    public function edit($id) {
        $this->user->id = $id;
        $stmt = $this->user->readOne();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        require_once 'views/users/edit.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->id = $id;
            $this->user->name = $_POST['name'];
            $this->user->email = $_POST['email'];
            
            if ($this->user->update()) {
                header("Location: index.php?action=index");
            }
        }
    }

    public function delete($id) {
        $this->user->id = $id;
        if ($this->user->delete()) {
            header("Location: index.php?action=index");
        }
    }
}