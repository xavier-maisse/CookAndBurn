<?php
session_start();
    $this->_t = "Mot de passe oublié";
    ?>

</div>
</div>
</div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="contact-form">
                <h3>Mot de passe oublié</h3>
        <center><form action="MotDePasseOublie" method="post">
            <p>
                <input type="text" name="mail" placeholder ="Email utilisateur" id="mail"/>
            </p>

            </p>

                <div class="g-recaptcha" data-sitekey="6Lcy3XMUAAAAAMSAq1uH6-gZe-XlPU-4Zmr8lEfH"></div>

            <p>
            <?php if(isset($_SESSION['erreur'])){
                echo '<p><span class="label label-danger">'.$_SESSION['erreur'].'</span>';
                unset($_SESSION['erreur']);
            } ?>
            <?php if(isset($_SESSION['reussi'])){
                echo '<p><span class="label label-success">'.$_SESSION['reussi'].'</span>';
                unset($_SESSION['reussi']);
            } ?>
            <p>
                <input type="submit" name="action" value="Changer mon mot de passe"/>
            </p>
</form></center></div>