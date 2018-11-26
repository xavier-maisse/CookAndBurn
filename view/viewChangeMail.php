

<?php
include("viewProfil.php");
?>


<?php
    if(isset($_SESSION['pseudo']))
    {?>
        <center>
        <div class="contact-form">
            <form action="ChangeMailAction" method="post" id="contact-form">

                <p>
                    <input type="text" name="oldMail" placeholder="Votre ancien mail"/>
                </p>
                <p>
                    <input type="text" name="newMail" placeholder="Votre nouveau mail"/>
                </p>
                <p>
                    <input type="text" name="newMail2" placeholder="Confirmer votre nouveau mail"/>
                </p>
                <p>
                    <input type="submit" name="action" value="Valider"/>
                </p>
            </form>
        </div>
        </center>

<?php
    }?>


