 

<div class="panneauDeBord"> 
 	<br>
	<br>
 	<h1 class="titreConnection"> CONNECTEZ-VOUS </h1>

	<div class="panneau_ecole"> <!-- Second bloc permettant l'affichage du détail d'une table -->

 		<h2>Ecole</h2>
		<h2>Selectionnez votre nom</h2>

		<form class="bloc_ecole" method="post" action="index.php?f=tdb_ecole">	

			<select name="nomUtilisateur" id="nomUtilisateur">

				<?php foreach($resultat[0]['instances_instance'] as $t) { ?>
					<option value="<?= $t['nomsFondateurs'] ?>"><?= $t['nomsFondateurs'] ?></option>
				<?php } ?>
			</select>

			<input type="submit" name="boutonConnexion" value="Connexion"/>
		</form>

	</div>


	<div class="panneau_feder"> <!-- Troisieme bloc permettant l'affichage du détail d'une fédération -->

		<h2>Fédération</h2>
		<h2>Selectionnez votre nom</h2>

		<form class="bloc_feder" method="post" action="index.php?f=tdb_feder">	

			<select name="idmembre" id="idAdherent">

			<?php foreach($resultatfeder1[0]['instances_instance'] as $t) { ?>
					<option><?= $t['nomAdhérent'] . ' ' . $t['prénomAdéhrent'] ?></option>
			<?php } ?>
			<?php foreach($resultatfeder2[0]['instances_instance'] as $tab) 
					{
						echo "<option>" . $tab['nomEmployé'] . ' ' . $tab['prénomEmployé'] . "</option>";
					}
			?>
			</select>

			<input type="submit" name="boutonConnexionFeder" value="Connexion"/>
		</form>

	</div>

</div>


