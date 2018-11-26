<?php
session_start();
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerMettreFavorisAction
 */
class ControllerMettreFavorisAction
{
private $_favorisModel;
public function __construct()
{
    $this->tfavoris();
}

    /**
     * Permet d'ajouter une recette au favoris
     */
public function tfavoris()
{

    if(isset($_SESSION['pseudo']))
    {

        $recMod = new RecetteModel();
        $rec = $recMod->getByTitre($_SESSION['recette']);

        $userMod = new UserModel();
        $user = $userMod->getByNom($_SESSION['pseudo']);


        $this->_favorisModel = new FavorisModel();

        if(!$this->_favorisModel->verifAlreadyFav($user,$rec))
        {
            $fav = new Favoris($rec->getId(), $user->getId() ,$rec->getTitre(),$user->getNameUser(), $rec->getImage());
            $this->_favorisModel->insertFavoris($fav);
        }
        else
        {
            foreach ($this->_favorisModel->getFavorisForUser() as $fav)
            {
                if($fav->getIdRec() == $rec->getId())
                {

                    $this->_favorisModel->deleteFav($fav);
                    break;
                }
            }
        }

    }
    else
    {
        $_SESSION['erreur'] = "Veuillez vous connecter";
        header("location:".$_SERVER['HTTP_REFERER']);

    }
    header("location:".$_SERVER['HTTP_REFERER']);



}


//if(empty($_POST['oldMail']) || empty($_POST['newMail']) || empty($_POST['newMail2']))
//{
//echo "Vous n'avez pas rempli tous les champs.";
//}
//else{
//$mail1 = htmlspecialchars($_POST['oldMail']);
//$mail2 = htmlspecialchars($_POST['newMail']);
//$mail3 = htmlspecialchars($_POST['newMail2']);
//
//$test = new UserModel();
//if(!filter_var($mail2, FILTER_VALIDATE_EMAIL) || !filter_var($mail1, FILTER_VALIDATE_EMAIL))
//{
//echo "Ce n'est pas une adresse mail valide";
//}
//else if($mail2 == $mail3)
//{
//$test->mailChange($_SESSION['pseudo'],$mail1,$mail2);
//
//}
//else
//{
//echo "votre nouveau mail ne correspond pas";
//}
//
//}
//
//}
}

?>