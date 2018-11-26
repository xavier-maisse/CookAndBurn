<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerContenuRecette
 */
class ControllerContenuRecette{
    private $_userModel;
    private $_burnModel;
    private $_recetteModel;
    private $_favorisModel;
    private $_view;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->ContenuRecette();
    }

    /**
     * On genere la vue recette
     * On met dans un tableau toutes les informations de la recette obtenu à partir de son nom
     */
    public function ContenuRecette()
    {

        $this->_userModel = new UserModel();
        $user = $this->_userModel->getByNom($_SESSION['pseudo']);

        $this->_burnModel = new BurnModel();
        $this->_recetteModel = new RecetteModel();
        // PB AVEC CODE COMMENTEE EN DESSOUS : AFFICHAGE DE LA DERNIERE RECETTE VU //
//        $marec = $this->_recetteModel ->getByTitre($_SESSION['recette']);
//        $mescom = $this->_recetteModel->getCommentaire($_SESSION['recette']);

        $this->_favorisModel = new FavorisModel();

        $this->_view = new View('ContenuRecette');
        $this->_view->generate(array("user"=>$user, "bM" => $this->_burnModel, "rM" => $this->_recetteModel
                                     ,"fM" => $this->_favorisModel));

    }
}