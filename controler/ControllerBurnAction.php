<?php
session_start();

/**
 * Class ControllerBurnAction
 *
 */
class ControllerBurnAction
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
     * ControllerBurnAction constructor.
     * Initialisation des variables
     * appel de la fonction addOrRemoveBurn()
     */

    function __construct()
    {
        $this->_rModel = new RecetteModel();
        $this->_bModel = new BurnModel();
        $this->_uModel = new UserModel();
        $this->addOrRemoveBurn();

    }

    /**
     * Fonction addOrRemoveBurn()
     *  Permet de d'ajouter ou d'enlever un burn selon la valeur de retour de la fonction verifAlreadyBurn()
     */

    function addOrRemoveBurn()
    {

        if(isset($_SESSION['pseudo']))
        {
            $rec = $this->_rModel->getByTitre($_SESSION['recette']);


            $user = $this->_uModel->getByNom($_SESSION['pseudo']);

            if(!$this->_bModel->verifAlreadyBurn($user,$rec))
            {
                $this->_rModel->addOneBurn($rec);
                $this->_bModel->insertBurn(new Burn( $user->getId(),$rec->getId()));
            }
            else
            {
                $this->_rModel->RemoveOneBurn($rec);
                $this->_bModel->deleteBurn(new Burn( $user->getId(),$rec->getId()));
            }

        }
        else
        {
            $_SESSION['erreur'] = "Veuillez vous connecter";
            header("location:".$_SERVER['HTTP_REFERER']);
        }
        header("location:".$_SERVER['HTTP_REFERER']);


    }
}
