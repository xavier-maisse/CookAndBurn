<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');

/**
 * Class ControllerSignUp
 * controller créer lorsque nous avions développer un système d'inscription, fonctionnalité à été supprimée
 */
class ControllerSignUp
{
    private $_userModel;
    private $_view;
    public function __construct()
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->inscription();
    }

    public function inscription()
    {

        $this->_userModel = new UserModel();
        $this->_view = new View('SignUp');
        $this->_view->generate(array($this->_userModel));

    }
}

