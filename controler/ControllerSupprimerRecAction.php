<?php
session_start();

/**
 * Class ControllerSupprimerRecAction
 */
class ControllerSupprimerRecAction
{

    /**
     * @var RecetteModel
     */
    private $_rModel;
    /**
     * @var BurnModel
     */
    private $_bModel;
    /**
     * @var UserModel
     */
    private $_uModel;

    /**
     * ControllerSupprimerRecAction constructor.
     */
    function __construct()
    {
        $this->_rModel = new RecetteModel();
        $this->_bModel = new BurnModel();
        $this->_uModel = new UserModel();
        $this->suppRec();

    }

    /**
     * fonction suppRec
     * permet de supprimer la recette lorsque que l'on appuie sur le bouton supprimer
     */
    function suppRec()
    {
        $rec = $this->_rModel->getByTitre($_SESSION['recette']);

        $this->_rModel->deleteCommentaire($_SESSION['recette']);

        $this->_rModel->deleteRecette($rec);
        //suppression de l'image dans le dossier
        unlink("./files/".$rec->getImage());
        header("location:index");

    }
}
