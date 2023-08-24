<!--
Pas de fonctionnalité pour l'accueil
-->

<?php 

	// partie sur les stats du projet 
	

	$requete1 = "SELECT COUNT(DISTINCT nomFédération) AS nbFed FROM Fédération"; 

	$nombreFédération = executer_une_requete($requete1);


	$requete2 = "SELECT COUNT(idComité) AS nbCR FROM Comite WHERE niveauComité = 'reg'";

	$nombreComitéReg = executer_une_requete($requete2);

	
	$requete3 = "SELECT COUNT(idComité) AS nbCD FROM Comite WHERE niveauComité = 'dept'"; 

	$nombreComitéDept = executer_une_requete($requete3);

	$requete4 = "SELECT LEFT(A.codePostal, 2) AS codeDept, COUNT(E.idEcole) AS nbEcoles
				FROM Ecole_De_Danse E
				JOIN Adresse A ON A.idAdresse = E.idAdresse
				WHERE A.codePostal NOT LIKE '97%'
				GROUP BY codeDept
				UNION
				SELECT LEFT(A.codePostal, 3) AS codeDept, COUNT(E.idEcole) AS nbEcoles
				FROM Ecole_De_Danse E
				JOIN Adresse A ON A.idAdresse = E.idAdresse
				WHERE A.codePostal LIKE '97%'
				GROUP BY codeDept";

	$nombreEcoleParDept = executer_une_requete($requete4);

	$requete5 = "SELECT C.nomComité AS libellé FROM Comite C INNER JOIN Fédération F ON C.idFédération = F.idFédération
				WHERE C.niveauComité = 'reg' AND F.nomFédération = 'Fédération Française de Danse'ORDER BY C.nomComité DESC"; 
	
	$listeComité = executer_une_requete($requete5);

	$requete6 = "SELECT E.nomEcole, A.nomVille, COUNT(DISTINCT AD.numLicence) AS nbAdhérent
				FROM Ecole_De_Danse E, Adresse A, est_inscrit EI, Adhérent AD
				WHERE E.idAdresse = A.idAdresse
				AND E.idEcole = EI.idEcole
				AND EI.numLicence = AD.numLicence
				AND AD.dateIncsription = 2022
				GROUP BY E.nomEcole
				ORDER BY nbAdhérent 
				DESC LIMIT 5;";

	$top5 = executer_une_requete($requete6);
?>






