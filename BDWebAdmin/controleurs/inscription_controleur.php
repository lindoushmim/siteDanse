
<?php

$numLicenceAdherent = '';
$utilisateur = '';

    if (isset($_POST['nomUtilisateur']))
    {
        $utilisateur = trim($_POST['nomUtilisateur']);

        $requeteInscriptionConnexion = "SELECT DISTINCT A.numLicence, A.nomAdhérent, A.prénomAdéhrent 
                                            FROM Adhérent AS A
                                            JOIN est_inscrit AS I ON I.numLicence=A.numLicence
                                            JOIN Ecole_De_Danse AS E ON E.idEcole = I.idEcole
                                            WHERE E.nomsFondateurs = '$utilisateur'
                                            ORDER BY A.nomAdhérent ASC
                                            "; 
        $resultatMembreEcole = executer_une_requete($requeteInscriptionConnexion);
    }

    if ((isset($_POST['choixNomAdherentEcole'])) ||((isset($_POST['retourModifCours']))))
    {
        $numLicenceAdherent = $_POST['nomAdherentEcole'];

        $requetteCours = "SELECT code, libelléCours,categorieAge c FROM Cours 
                            WHERE code IN (SELECT C.code 
                                            FROM Cours AS C 
                                            JOIN suit AS I ON I.code = C.code  
                                            JOIN Adhérent AS A ON A.numLicence = I.numLicence
                                            WHERE A.numLicence = '$numLicenceAdherent' )";                 
        $resultatCours = executer_une_requete($requetteCours);  
    }

    // pour faire afficher les cours auxquelle l'adherent n'est pas encore inscrit 
    if (isset($_POST['ajouterAffectation']))
    {
        $numLicenceAdherent = $_POST['nomAdherentEcole'];

        $requetteCoursPasInscrit = "SELECT code, libelléCours, categorieAge
                                    FROM Cours
                                    WHERE code NOT IN (
                                            SELECT C.code 
                                            FROM Cours AS C 
                                            JOIN suit AS I ON I.code = C.code  
                                            JOIN Adhérent AS A ON A.numLicence = I.numLicence
                                            WHERE A.numLicence = '$numLicenceAdherent')"; 
        $resultatCoursPasInscrit = executer_une_requete($requetteCoursPasInscrit);
    }

    $messageAjout = "";

    // si on a ajouté un cours à un adherent 
    if (isset($_POST['ajouterCoursAdherent'])) 
    {
        $numLicence = $_POST['nomAdherentEcole'];
        $codeCours = $_POST['idCours'];
        $requete = "INSERT INTO suit (numLicence, code) VALUES ('$numLicence', '$codeCours')";
        $resultat = executer_une_requete($requete);
    
        if ($resultat) 
        {
            $messageAjout = "Cours ajouté !";
        } else {

            $messageAjout = "Erreur lors de l'ajout du cours.";
        }
    }

    $messageSupp = "";

    if (isset($_POST['modifCours'])) 
    {
        $idCours = $_POST['idCours'];
        $numLicence = $_POST['nomAdherentEcole'];

        $requetteSupp = "DELETE FROM suit WHERE `code` = $idCours AND `numLicence` = $numLicence;"; 
        $resultatSupp = executer_une_requete($requetteSupp); 

        if ($resultatSupp) 
        {
            $messageSupp = "Cours supprimer !"; 
        } 
        else 
        {
            $messageSupp = "Erreur lors de la suppresion du cours.";
        }
    }



?>