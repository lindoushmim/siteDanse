<?php

    // pour afficher les aherents 
	


    // pour afficher les infos du membre
    if ((isset($_POST['boutonAfficherMembre']))||(isset($_POST['retourModifMembre']))||(isset($_POST['validerNouveauMembre'])))
    {
        if (isset($_POST['idAdherent'])) 
        {
            $idAdherent = trim($_POST['idAdherent']);
            $requeteMembre = "SELECT numLicence, nomAdhérent, prénomAdéhrent FROM Adhérent  WHERE numLicence = '$idAdherent'";
            $resultatMembre = executer_une_requete($requeteMembre);
        }
    }


    // pour valider la modification du changement des infos de l'adherent 
    $messageModiInfo = ''; 
    if (isset($_POST['validerNouveauAdherent']))
    {
          $utilisateur = mysqli_real_escape_string($connexion , trim($_POST['idAdherent'])) ;
          $nouveauNom = mysqli_real_escape_string($connexion , trim($_POST['nouveauNom']));
          $nouveauPrenom = mysqli_real_escape_string($connexion , trim($_POST['nouveauPrenom']));
         
          $requeteModificationAdherent = "UPDATE Adhérent 
                                  SET nomAdhérent='$nouveauNom', prénomAdéhrent='$nouveauPrenom' 
                                  WHERE numLicence='$utilisateur';";
          $resModifInfo = executer_une_requete($requeteModificationAdherent);   
          
          if ($resModifInfo) 
          {
              $messageModiInfo = "Info modifié !"; 
          } 
          else 
          {
              $messageModiInfo = "Erreur lors de la modification d'info.";
          }

    }

    // pour ajouter un membre 
    if (isset($_POST['boutonValiderAjouterMembre'])) 
    {
        $numLicence = trim($_POST['numLicence']);
        $nomAdherent = trim($_POST['nomAdherent']);
        $prenomAdherent = trim($_POST['prenomAdherent']);

        $numVoie = trim($_POST['numVoie']);
        $numRue = trim($_POST['numRue']);
        $nomVille = trim($_POST['nomVille']);

        $requeteAjoutAdresse = "INSERT INTO Adresse (numVoie, nomRue, nomVille)
                                VALUES ('$numVoie', '$numRue', '$nomVille')";
        executer_une_requete($requeteAjoutAdresse);

        $idNouvelleAdresse = mysqli_insert_id($connexion); // récupère l'ID de l'adresse ajoutée

        $requeteAjout = "INSERT INTO Adhérent (numLicence, nomAdhérent, prénomAdéhrent, idAdresse) 
                         VALUES ('$numLicence', '$nomAdherent', '$prenomAdherent', '$idNouvelleAdresse')";
        executer_une_requete($requeteAjout);    
    }



    
    

    // pour valider la modification du changement des infos de l'employé 
    $messageModifEmp = ''; 
    if (isset($_POST['validerNouveauEmploye']))
    {
        $employe = mysqli_real_escape_string($connexion , trim($_POST['idEmploye'])) ;
        $nouveauNom = mysqli_real_escape_string($connexion , trim($_POST['nouveauNomEmp']));
        $nouveauPrenom = mysqli_real_escape_string($connexion , trim($_POST['nouveauPrenomEmp']));
             
        $requeteModificationEmp = "UPDATE Employé 
                                      SET nomEmployé='$nouveauNom', prénomEmployé='$nouveauPrenom' 
                                      WHERE idEmployé='$employe';";
        $resModifInfoEmp = executer_une_requete($requeteModificationEmp);   
              

        if ($resModifInfoEmp) 
        {
            $messageModifEmp = "Info modifié !"; 
        } 
        else 
        {
            $messageModifEmp = "Erreur lors de la modification d'info.";
        }
    }

    // pour afficher les infos de l employé
    if ((isset($_POST['boutonAfficherEmploye']))||(isset($_POST['retourModifEmployé']))||(isset($_POST['validerNouveauEmploye'])))
    {
        if (isset($_POST['idEmploye'])) 
        {
            $idEmploye = trim($_POST['idEmploye']);
            $requeteInfoEmploye = "SELECT idEmployé, nomEmployé, prénomEmployé FROM Employé WHERE idEmployé = '$idEmploye'";
            $resultatInfoEmploye = executer_une_requete($requeteInfoEmploye);
        }
    }

    // pour ajouter un employé
    if (isset($_POST['boutonValiderAjouterEmploye'])) 
    {
        $nomAdherent = trim($_POST['nomEmploye']);
        $prenomAdherent = trim($_POST['prenomEmploye']);
    
        $requeteAjout = "INSERT INTO Employé (nomEmployé, prénomEmployé) 
                         VALUES ('$nomAdherent', '$prenomAdherent')";
        executer_une_requete($requeteAjout);    
    }
    // pour afficher les adhérents
    $requeteFeder = "SELECT numLicence, nomAdhérent, prénomAdéhrent FROM Adhérent ORDER BY nomAdhérent ASC";
	$resFeder = mysqli_real_escape_string($connexion,trim($requeteFeder));
	$resultatfeder = executer_une_requete($resFeder); 


    // pour afficher les employés 
    $requeteEmploye = "SELECT  idEmployé, nomEmployé, prénomEmployé FROM Employé ORDER BY nomEmployé ASC";
	$resEmploye = mysqli_real_escape_string($connexion,trim($requeteEmploye));
	$resultatEmploye = executer_une_requete($resEmploye); 


?>
