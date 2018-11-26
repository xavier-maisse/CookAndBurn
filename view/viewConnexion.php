<?php
session_start();
    $this->_t = "Connexion";
    ?>

</div>
</div>
</div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="contact-form">
                <h3>Connexion</h3>
        <center><form action="ConnexionAction" method="post">
            <p>
                <input type="text" name="name" placeholder ="Nom utilisateur" id="name"/>
            </p>

            <p>
                <input type="password" name="password" placeholder="Mot de passe" id="firstname"/>
            </p>
            <p>
                <a href="mdpOublie">Mot de passe oublié ?</a>
            </p>
            </p>

                <div class="g-recaptcha" data-sitekey="6Lcy3XMUAAAAAMSAq1uH6-gZe-XlPU-4Zmr8lEfH"></div>

            <p>
            <?php if(isset($_SESSION['erreur'])){
                echo '<p><span class="label label-danger">'.$_SESSION['erreur'].'</span>';
                unset($_SESSION['erreur']);
            } ?>

            <p>
                <input type="submit" name="action" value="Me connecter"/>
            </p>
</form></center></div>