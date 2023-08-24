
<?php


	$requete = "SELECT nomsFondateurs FROM Ecole_De_Danse ORDER BY nomsFondateurs ASC";
	$res = mysqli_real_escape_string($connexion,trim($requete));
	$resultat = executer_une_requete($res);

	$requeteFeder1 = "SELECT numLicence, nomAdhérent, prénomAdéhrent 
					  FROM Adhérent 
					  ORDER BY nomAdhérent ASC";
	$resultatfeder1 = executer_une_requete($requeteFeder1);

	$requeteFeder2 = "SELECT idEmployé, nomEmployé, prénomEmployé
					  FROM Employé
					  ORDER BY nomEmployé ASC";

	$resultatfeder2 = executer_une_requete($requeteFeder2);

?>