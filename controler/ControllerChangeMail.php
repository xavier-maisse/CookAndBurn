<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerChangeMail
 * Génére la vue pour changer de mail et fait passer par un tableau les informations de l'utilisateur
 */
class ControllerChangeMail
{
    private $_userModel;
    private $_view;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->ChangeMail();
    }

    /**
     * On récupere toutes les informations de l'utilisateur à partir de son nom
     */
    public function ChangeMail()
    {

        $this->_userModel = new UserModel();
        $user = $this->_userModel->getByNom($_SESSION['pseudo']);
        $this->_view = new View('ChangeMail');
        $this->_view->generate(array("user" => $user));

    }
}