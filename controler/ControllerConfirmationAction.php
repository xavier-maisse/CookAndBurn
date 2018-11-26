<?php
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerConfirmationAction
 */
class ControllerConfirmationAction
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Si la cle secrete correspond au mail , alors le compte est validé.
     * Activation par mail
     */
    public function verif()
    {
    	if(empty($_POST['pseudo']) || empty($_POST['cleSecrete'])){
            echo 'Remplir les champs';
        }
        else{
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $key = htmlspecialchars($_POST['cleSecrete']);
            $aUser = new User($pseudo,"","", $key);
            $test = new UserModel();
            if($test->verifUserValid($aUser)== true){
                $test->confirmUser($aUser);
                echo 'ok';
            }
            else{
                echo 'Pas de cohérence';
            }
        }
    	
    }
}

?>

<?php //
//    if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key'])){
//        $pseudo = htmlspecialchars($_GET['pseudo']);
//        $key = htmlspecialchars($_GET['key']);
//        $requser = $bdd->prepare("SELECT * FROM user WHERE nom_utilisateur = ? AND confirmkey = ?");
//        $requser->execute(array($pseudo, $key));
//        $userexist = $requser->rowCount();
//        if($userexist == 1){
//            $user = $requser->fetch();
//            if($user['confirme'] == 0){
//                $updateuser = $bdd->prepare("UPDATE user SET confirme = 1 WHERE nom_utilisateur = ? AND confirmkey = ? ");
//                $updateuser->execute(array($pseudo, $key));
//                echo "Compte confirmé !";
//            }
//            else{
//                echo "Compte déjà confirmé !";
//            }
//        }
//        else{
//            echo "L'utilisateur n'existe pas !";
//        }
//    }
//?>