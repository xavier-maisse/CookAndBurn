<?php
    session_start();
    $this->_t = "Inscription";
    ?>
<head>
    <title>reCAPTCHA demo: Simple page</title>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<!-- permet de fermer la banner -->
</div>
</div>
</div>
</div>
    <div class="contact-form">
                <h3>Inscription</h3>
        <center><form action="SignUpAction" method="post" id="contact-form">
            <p>
                <input type="text" name="name" placeholder ="Nom utilisateur" id="name"/>
            </p>

            <p>
                <input type="password" name="password" placeholder="Mot de passe" />
            </p>

            <p>
                <input type="password" name="password2" placeholder="Mot de passe à nouveau " id="firstname"/>
            </p>

            <p>
                <input type="text" name="mail" placeholder="Adresse mail" id="password"/>
            </p>
            <p>
                <input type="text" name="mail2" placeholder="Adresse mail confirmation" />
            </p>

                <div class="g-recaptcha" data-sitekey="6Lcy3XMUAAAAAMSAq1uH6-gZe-XlPU-4Zmr8lEfH"></div>
                <?php if(isset($_SESSION['erreur'])){
                echo '<p><span class="label label-danger">'.$_SESSION['erreur'].'</span>';
                unset($_SESSION['erreur']);
            } ?>
            <?php if(isset($_SESSION['reussi'])){
                echo '<p><span class="label label-success">'.$_SESSION['reussi'].'</span>';
                unset($_SESSION['reussi']);
            } ?>
            <p>
                <input type="submit" name="action" value="S'inscrire"/>
            </p>

            <br/>


        </form></center>
    </div>