<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerPanel
 */
class ControllerPanel
{
    /**
     * @var
     */
    private $_userModel;
    /**
     * @var
     */
    private $_view;
    /**
     * @var
     */
    private $_recetteModel;

    /**
     * ControllerPanel constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->panel();
    }

    /**
     * Affichage du panel pour l'admin
     */
    public function panel()
    {

        $this->_userModel = new UserModel();
        $this->_recetteModel = new RecetteModel();
        if(isset($_SESSION['pseudo']) AND $_SESSION['pseudo']=='adm'){
           $this->_view = new View('Panel'); 
        }
        else{
            header('Location:Error');
        }
        
        $this->_view->generate(array("uM" => $this->_userModel, "rM" => $this->_recetteModel));





    }
}

