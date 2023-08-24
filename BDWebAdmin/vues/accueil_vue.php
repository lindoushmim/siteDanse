
<div class="acceuil">

	<div class="accueil_description">
		<h1> Bienvenue sur notre site </h1>
		<p> Notre application web est un outil de gestion pour les écoles de danse et des compétitions de danse, 
			organisées par des fédérations.
			Elle permet d'une part de gérer les écoles de danses. Ainsi, via notre site il est possible de 
			gérer les données qui concerne une école, de ses employés, de ses adhérents et ainsi que ses cours. 
			D'autre part, il est aussi possible de gérer les fédération dont ses données, ses comités, ses membres et ses compétitions. 
		</p>

	</div >

	<div class="panneau">
	<div class="statAcceuil">
		<h2>Voici quelques statistiques de notre base de données</h2>

			<p>Nombre de fédérations : <?php echo $nombreFédération[0]['instances_instance'][0]['nbFed']; ?></p>
			<p>Nombre de comités régionaux : <?php echo $nombreComitéReg[0]['instances_instance'][0]['nbCR']; ?></p>
			<p>Nombre de comités départementaux : <?php echo $nombreComitéDept[0]['instances_instance'][0]['nbCD']; ?></p>

			<div class = pouralignerbloc>
			<div class="bloc">
				<table>
				<thead>
					<tr><th>Code departemental</th><th>Nombre d'école</th></tr>
				</thead>
				<tbody>
					<?php foreach ($nombreEcoleParDept[0]['instances_instance'] as $row) { ?>
					<tr>
						<td><?= $row['codeDept'] ?></td>
						<td><?= $row['nbEcoles'] ?></td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
			</div>

			<div class="bloc">
				<p>Liste des comités régionaux (libellé) de la Fédération Française de Danse : 
				<u1>
					<?php foreach ($listeComité[0]['instances_instance'] as $row) { ?>
					<li><?= $row['libellé'] ?></li>
					<?php } ?>
				</u1>
				</p>
			</div>

			<div class="bloc">
				<p>Top 5 des écoles françaises ayant le plus grand nombre d'adhérents en 2022 : 
				<u1>
					<?php foreach ($top5[0]['instances_instance'] as $row) { ?>
					<li>L'<?= $row['nomEcole'] ?> dans la ville de <?= $row['nomVille'] ?> à <?= $row['nbAdhérent'] ?> adhérents.</li>
					<?php } ?>
				</u1>
				</p>
		</div>
		</div>

		


</div>
		





