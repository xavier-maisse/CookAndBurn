<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerCreatedRec
 */
class ControllerCreatedRec
{
    private $_recetteModel;
    private $_userModel;
    private $_view;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->CreatedRec();
    }

    /**
     * On génére la vue CreateRec qui permet de créer une recette
     */
    public function CreatedRec()
    {

        $rM = $this->_recetteModel = new RecetteModel();
        $uM = $this->_userModel =  new UserModel();

        $user = $uM->getByNom($_SESSION['pseudo']);

        $createdRec = $rM->getCreatedRecByUser($user);
        $this->_view = new View('CreatedRec');

        $this->_view->generate(array("createdRec" => $createdRec, "user" => $user));

    }
}