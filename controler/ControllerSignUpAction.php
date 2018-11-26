
<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerSignUpAction
 * controller créer lorsque nous avions développer un système d'inscription, fonctionnalité à été supprimée
 */
class ControllerSignUpAction
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    public function verif()
    {
        if(empty($_POST['name']) || empty($_POST['password']) || empty($_POST['mail'] || empty($_POST['password2'])))
        {
            $_SESSION['erreur'] = 'Il faut tout remplir !';
          header('Location:SignUp');
        }
        else
        {
            $longueurKey = 15;
            $key = "";
            for($i=1; $i <$longueurKey;++$i){
                $key .= mt_rand(0,9);
            }

            //require_once ('./model/reCaptcha/autoload.php');
            $recaptcha = new \ReCaptcha\ReCaptcha('6Lcy3XMUAAAAADkAvu0vbHEM8GURkxLbYOGCoWnh');

            $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
            $nameUser = htmlspecialchars($_POST['name']);
            $firstNameUser = sha1($_POST['password']);
            $firstNameUser2 = sha1($_POST['password2']);
            $mailUser = htmlspecialchars($_POST['mail']);
            $mailUser2 = htmlspecialchars($_POST['mail2']);
            $aUser = new User($nameUser,$firstNameUser, $mailUser, $key);
            $pseudolength = strlen($nameUser);
            $test = new UserModel();
            if($pseudolength <= 255){
                if($firstNameUser == $firstNameUser2){
                    if($mailUser == $mailUser2){
                        if(filter_var($mailUser, FILTER_VALIDATE_EMAIL)){
                            if($test->verifUser($aUser) == false){ //Vérifie si le pseudo est utilisé
                                if($test->verifUserEmail($aUser) == false){
                                    if ($resp->isSuccess() === true)
                                    {
                                        try
                                        {
                                            $to      = $mailUser;
                                            $subject = 'Validation de l inscription';
                                            $message = '
                                            <html>
                                                <body>
                                                    <div align="center">
                                                        <a href="http://cookandburn-gxaj.alwaysdata.net/Confirmation?$pseudo='.urlencode($nameUser).'$key='.$key.'">Clique pour confirmer ton compte !<a/>
                                                        <p> Votre pseudo : </p>
                                                        ' . urlencode($nameUser) . ' 
                                                        <p> Votre clé secréte : </p>
                                                        '. $key . ' 
                                                    </di>
                                                </body>
                                            </html>';
                                            $headers = "From: \"Cook And Burn\"<cookandBurn@domaine.com>\n";
                                            $headers .= "Reply-To: no-reply@domaine.com\n";
                                            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                                            mail($to, $subject, $message, $headers);
                                            $test->insertUser($aUser);
                                        }
                                        catch(PDOException $e)
                                        {
                                            die('Error : ' . $e->getMessage());
                                        }
                                        //Inscription reussit
                                        $_SESSION['reussi'] = 'Valider votre email !';
                                        header('Location:SignUp');
                                    }
                                    else{

                                        $_SESSION['erreur'] = 'Valider le captcha !';
                                        header('Location:SignUp');
                                    }
                                }
                                else{
                                    $_SESSION['erreur'] = 'Email deja utilisé !';
                                    header('Location:SignUp');
                                }
                                
                            }
                            else{
                                $_SESSION['erreur'] = 'Pseudo déjà utilisé !';
                                header('Location:SignUp');
                            }          
                        }
                        else{
                            $_SESSION['erreur'] = 'Adresse email non valide !';
                            header('Location:SignUp');
                        }   
                    }
                    else{
                        $_SESSION['erreur'] = 'Les adresses mails ne correspondent pas !';
                        header('Location:SignUp');
                    }
                }
                else{
                    $_SESSION['erreur'] = 'Vos mots de passes ne correspondent pas !';
                    header('Location:SignUp');
                }      
            }
            else{
                $_SESSION['erreur'] = 'Le pseudo ne doit pas dépasser 255 caractéres !';
            header('Location:SignUp');
            }
                
       
        }
    }
}




?>