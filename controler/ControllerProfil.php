<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerProfil
 */
class ControllerProfil
{
    /**
     * @var UserModel
     */
    private $_userModel;
    /**
     * @var View
     */
    private $_view;

    /**
     * ControllerProfil constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->profil();
    }

    /**
     * Fonction profil
     * initialisation de userModel
     * Generation de la vue
     */
    public function profil()
    {

        $this->_userModel = new UserModel();
        $user = $this->_userModel->getByNom($_SESSION['pseudo']);
        $this->_view = new View('Profil');
        $this->_view->generate(array("user" => $user));

    }
}

