<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerChangeMdp
 */
class ControllerChangeMdp
{
    private $_userModel;
    private $_view;

    /**
     * ControllerChangeMdp constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->ChangeMdp();
    }

    /**
     * On recupere toutes les informations de l'utilisateur
     */
    public function ChangeMdp()
    {

        $this->_userModel = new UserModel();
        $user = $this->_userModel->getByNom($_SESSION['pseudo']);
        $this->_view = new View('ChangeMdp');
        $this->_view->generate(array("user" => $user));

    }
}