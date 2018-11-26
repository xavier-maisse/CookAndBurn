<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerMotDePasseOublie
 */
class ControllerMotDePasseOublie
{
    /**
     * ControllerMotDePasseOublie constructor.
     */
    public function __construct()
    {
        $this->verif();
    }

    /**
     * fonction verif
     * verification du mail, envoie du mail
     */
    public function verif()
    {
        if(empty($_POST['mail']))
        {
            $_SESSION['erreur'] = 'Entrer une adresse mail !';
            header('Location:mdpOublie');
        }
        else
        {
            $recaptcha = new \ReCaptcha\ReCaptcha('6Lcy3XMUAAAAADkAvu0vbHEM8GURkxLbYOGCoWnh');

            $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
            if ($resp->isSuccess() === true)
            {
                $test = new UserModel();
                $mail = htmlspecialchars($_POST['mail']);
                //Verif qui le mail existe dans la bdd
                if($test->validMail($mail) == true)
                {
                    $NewmMdp = md5(mt_rand());
                    $test->newMdp($mail,$NewmMdp);
                                            $to      = $mail;
                                            $subject = 'Changement mot de passe';
                                            $message = '
                                            <html>
                                                <body>
                                                    <div align="center">
                                                        
                                                        <p> Votre nouveau mot de passe : </p>
                                                        ' . $NewmMdp . ' 
                                                        <p> Vous pouvez le changer à partir de votre profil :) </p>
                                                       
                                                    </di>
                                                </body>
                                            </html>';
                                            $headers = "From: \"Cook And Burn\"<cookandBurn@domaine.com>\n";
                                            $headers .= "Reply-To: no-reply@domaine.com\n";
                                            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                                            mail($to, $subject, $message, $headers);

                    $_SESSION['reussi'] = 'Nouveau mot de passe envoyé par mail!';
                    header('Location:mdpOublie');
                }
                else
                {
                    $_SESSION['erreur'] = 'Aucun utilisateur avec ce mail !';
                    header('Location:mdpOublie');
                }
                
            }
            else
            {
                $_SESSION['erreur'] = 'Captcha erreur !';
                header('Location:mdpOublie');
            }
            
        }
    }
}

?>

