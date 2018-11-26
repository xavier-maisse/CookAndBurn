<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();
class ControllerUserTable
{
    private $_userModel;
    private $_view;
    private $_recetteModel;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->userTable();
    }

    public function userTable()
    {

        $this->_userModel = new UserModel();
        $this->_recetteModel = new RecetteModel();
        if(isset($_SESSION['pseudo']) AND $_SESSION['pseudo']=='adm'){
           $this->_view = new View('userTable'); 
        }
        else{
            header('Location:Error');
        }
        $this->_view->generate(array("uM" => $this->_userModel, "rM" => $this->_recetteModel));



    }
}