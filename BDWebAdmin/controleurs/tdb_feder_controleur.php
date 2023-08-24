<?php
  if (isset($_POST['idmembre']))
  {
      $utilisateur = trim($_POST['idmembre']);

    // manque dans la requete le niveau de l’instance (nationale ou internationale) et l’adresse de la fédération,
    $requete = " SELECT F.nomFédération, F.sigleFédération, A.numVoie, A.nomRue, A.codePostal, A.nomVille 
                 FROM Fédération F, Adresse A 
                 WHERE F.idAdresse = A.idAdresse"; 
    $resultatNomSigleFeder = executer_une_requete($requete);

    // le nombre de comités 
    $requete = "SELECT COUNT(idComité) FROM Comite"; 
    $resultatNbComite = executer_une_requete($requete); 

    // le nombre des membres de la fédération
    $requete = "SELECT COUNT(numLicence)
                FROM (
                    SELECT DISTINCT A.numLicence
                    FROM Adhérent A 
                    JOIN est_inscrit I ON A.numLicence = I.numLicence
                    JOIN Ecole_De_Danse E ON I.IdEcole = E.idEcole 
                    JOIN Fédération F ON E.idFédération = F.idFédération 
                 ) AS nb"; 
    $resultatNbAdherent = executer_une_requete($requete);

    // la liste des compétitions organisées par la fédération
    $requete = "SELECT libelléCompétition From Compétition"; 
    $resultatListeCompet = executer_une_requete($requete); 

    // le nombre d’adhérents ayant participé à une compétition
    $requete = "SELECT COUNT(Licence)
                  FROM (
                        SELECT DISTINCT G.numlicence1 AS Licence
                        FROM Groupe_De_Danse G, Adhérent A
                        WHERE A.numLicence = G.numLicence1
                        UNION
                        (SELECT DISTINCT G.numlicence2 AS Licence
                        FROM Groupe_De_Danse G, Adhérent A
                        WHERE A.numLicence = G.numLicence2)) A;";
    $resultatNbadherentCompet = executer_une_requete($requete); 

  }

?>