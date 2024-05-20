<?php

class AdminController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function isAllowed(){
        $isAllowed = $this->model->getAdminByUsernamePassword($_POST['username'],$_POST['password']);
        if($isAllowed){
            header("Location: /pokedex/admin/dashboard.php");
        }else{
            header("index.php");
        }
        exit();
    }

    public function listAdmins()
    {
        $admins = $this->model->getAdmins();
        include_once("login.php");
    }
}