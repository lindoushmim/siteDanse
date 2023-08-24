

<?php

      if (isset($_POST['changementInfoEcole']))
      {
            $utilisateur = mysqli_real_escape_string($connexion , trim($_POST['nomUtilisateur'])) ;
            $nouveauNomEcole = mysqli_real_escape_string($connexion , trim($_POST['nomEcole']));
            $nouveauNumVoie = mysqli_real_escape_string($connexion , trim($_POST['numVoie']));
            $nouveauNomRue = mysqli_real_escape_string($connexion , trim($_POST['nomRue']));
            $nouveauNomVille = mysqli_real_escape_string($connexion , trim($_POST['nomVille']));
            $nouveauNomsFondateurs = mysqli_real_escape_string($connexion , trim($_POST['nomsFondateurs']));
           
            $requeteModification = "UPDATE Adresse A, Ecole_De_Danse E
                                    SET A.numVoie=$nouveauNumVoie, A.nomRue='$nouveauNomRue', A.nomVille='$nouveauNomVille' 
                                    WHERE A.idAdresse = E.idAdresse
                                    AND E.nomsFondateurs = '$utilisateur';";
           
            executer_une_requete($requeteModification);
            

            $requeteModification = "UPDATE Ecole_De_Danse E
                                    SET E.nomsFondateurs='$nouveauNomsFondateurs', E.nomEcole='$nouveauNomEcole'
                                    WHERE E.nomsFondateurs='$utilisateur';";
                        
            executer_une_requete($requeteModification);

            $_POST['nomUtilisateur'] = $nouveauNomsFondateurs;   // necessaire car si on change le nom du fondateur, le prochain if va utiliser l'ancien nom pour afficher les infos     
      }

      if (isset($_POST['nomUtilisateur']))
      {
            $utilisateur = trim($_POST['nomUtilisateur']);

            //le nom et l’adresse de l’école
            $requete = "SELECT ED.nomEcole, A.numVoie, A.nomRue, A.nomVille 
            FROM Ecole_De_Danse ED, Adresse A 
            WHERE ED.nomsFondateurs = '$utilisateur' 
            AND ED.idAdresse = A.idAdresse";

            $resultat_Nom_Adresse = executer_une_requete($requete);
      }


?>
 