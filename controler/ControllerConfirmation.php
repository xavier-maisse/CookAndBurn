<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');

/**
 * Class ControllerConfirmation
 */
class ControllerConfirmation
{
    private $_userModel;
    private $_view;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->confirmation();
    }

    /**
     * Génére la vue de comfirmation par mail
     */
    public function confirmation()
    {

        $this->_userModel = new UserModel();
        $this->_view = new View('Confirmation');
        $this->_view->generate(array($this->_userModel));

    }
}


/*<?php 
	if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key'])){
		$pseudo = htmlspecialchars($_GET['pseudo']);
		$key = htmlspecialchars($_GET['key']);
		$requser = $bdd->prepare("SELECT * FROM user WHERE nom_utilisateur = ? AND confirmkey = ?");
		$requser->execute(array($pseudo, $key));
		$userexist = $requser->rowCount();
		if($userexist == 1){
			$user = $requser->fetch();
			if($user['confirme'] == 0){
				$updateuser = $bdd->prepare("UPDATE user SET confirme = 1 WHERE nom_utilisateur = ? AND confirmkey = ? ");
				$updateuser->execute(array($pseudo, $key));
				echo "Compte confirmé !";
			}
			else{
				echo "Compte déjà confirmé !";
			}
		}
		else{
			echo "L'utilisateur n'existe pas !";
		}
	}
?>*/