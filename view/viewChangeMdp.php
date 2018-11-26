<?php
include("viewProfil.php");
?>


<?php
if(isset($_SESSION['pseudo']))
{?>
    <center>
        <div class="contact-form">
            <form action="ChangeMdpAction" method="post" id="contact-form">

                <p>
                    <input type="password" name="oldMdp" placeholder="Votre ancien mot de passe"/>
                </p>
                <p>
                    <input type="password" name="newMdp" placeholder="Votre nouveau mot de passe"/>
                </p>
                <p>
                    <input type="password" name="confirmMdp" placeholder="Votre nouveau mot de passe"/>
                </p>
                <p>
                    <input type="submit" name="action" value="Valider"/>
                </p>
            </form>
        </div>
    </center>

    <?php
}?>
