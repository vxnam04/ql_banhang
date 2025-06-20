<?php
require_once '../models/UserModel.php';

class UserController {
    private $model;
     public function __construct() {
        $this->model = new UserModel();
    }
    public function getuser(){
        $user = $this->model->getAllUsers();
        include "../views/admin/user/user.php";
    }
    public function redichome(){
         include "../views/authorized/pages/home.php";
    }
}
