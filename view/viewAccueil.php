<?php

foreach($recette as $rec) :?>
<?php echo '<h1>'.$rec->getId().'</h1>' ?>
<h2> <?php echo 'Titre : '. $rec->getTitre() .'<br/>'.
		' Description : '. $rec->getDescription().'<br/>'.
		'Id : ' . $rec->getId(). '<br/>'.
		'Auteur : '. $rec->getAuteur() ?> </h2>

<?php endforeach; ?>

