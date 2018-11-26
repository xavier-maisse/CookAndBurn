<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerMdpOublie
 */
class ControllerMdpOublie
{
    private $_userModel;
    private $_view;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->mdpOublie();
    }

    /**
     * Genere la vue pour le mot de passe oublié
     */
    public function mdpOublie()
    {

        $this->_userModel = new UserModel();
        $user = $this->_userModel->getByNom($_SESSION['pseudo']);
        $this->_view = new View('mdpOublie');
        $this->_view->generate(array("user" => $user));

    }
}