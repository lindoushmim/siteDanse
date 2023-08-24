<?php
  if (isset($_POST['nomUtilisateur']))
  {
      $utilisateur = trim($_POST['nomUtilisateur']);

      //le nom et l’adresse de l’école
      $requete = "SELECT ED.nomEcole, A.numVoie, A.nomRue, A.nomVille 
                  FROM Ecole_De_Danse ED, Adresse A 
                  WHERE ED.nomsFondateurs = '$utilisateur' 
                  AND ED.idAdresse = A.idAdresse";
      $resultat_Nom_Adresse = executer_une_requete($requete);

      //la liste des employés
      $requete = "SELECT DISTINCT E.*
                  FROM Employé E, delivre D, Ecole_De_Danse ED 
                  WHERE ED.nomsFondateurs = '$utilisateur' 
                  AND ED.idEcole = D.idEcole 
                  AND D.idEmployé = E.idEmployé"; 
      $resultat_Liste_Employe = executer_une_requete($requete);


  
      //le nombre d’adhérents pour l’année en cours
      $requete = "SELECT COUNT(A.numLicence)
                  FROM Adhérent A, Ecole_De_Danse ED, est_inscrit EI
                  WHERE ED.nomsFondateurs = '$utilisateur'
                  AND ED.idEcole = EI.idEcole
                  AND A.numLicence = EI.numLicence
                  AND A.dateIncsription = '2022'"; 
      $resultat_Nombre_Adherent = executer_une_requete($requete);

       


      //la liste des cours proposés dans l’école
      $requete = "SELECT C.libelléCours
                  FROM Ecole_De_Danse ED, delivre D, Cours C
                  WHERE ED.nomsFondateurs = '$utilisateur'
                  AND ED.idEcole = D.idEcole
                  AND D.code = C.code"; 
      $resultat_Cours = executer_une_requete($requete);


      //le nombre d’adhérents ayant participé à une compétition
      $requete = "SELECT COUNT(Licence)
                  FROM (
                        SELECT DISTINCT G.numlicence1 AS Licence
                        FROM Ecole_De_Danse ED, est_inscrit EI, Groupe_De_Danse G, Adhérent A
                        WHERE ED.nomsFondateurs = '$utilisateur'
                        AND ED.idEcole = EI.idEcole
                        AND EI.numLicence = A.numLicence
                        AND A.numLicence = G.numLicence1
                        UNION
                        (SELECT DISTINCT G.numlicence2 AS Licence
                        FROM Ecole_De_Danse ED, est_inscrit EI, Groupe_De_Danse G, Adhérent A
                        WHERE ED.nomsFondateurs = '$utilisateur'
                        AND ED.idEcole = EI.idEcole
                        AND EI.numLicence = A.numLicence
                        AND A.numLicence = G.numLicence2)) A;";

      $resultat_Nombre_Adherent_Competition = executer_une_requete($requete);

      
  }

?>