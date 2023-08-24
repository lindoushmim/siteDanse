<?php 

    $messageErreurCode = "";
    $messageErreurLibellé = "";

    $messageErreurCodeCompet = "";
    $messageErreurAnnee = "";
    

    function verif($tableau , $nouveauCodeCompétition , $nouveauLibelléCompétition )
    {
        //verifie que le code et le libellé de la compétition n'existe pas déjà dans la base de donnée
        $requeteVerification = "SELECT codeCompétition, libelléCompétition
                                FROM Compétition ;";
        
        $vérification = executer_une_requete($requeteVerification);

        $code = "";
        $messageErreurCode = "";
        $messageErreurLibellé = "";

        if ($tableau[0])
        {
            $nomCompet = $tableau[1];
            $requeteVerification2 = "SELECT codeCompétition
                                 FROM Compétition
                                 WHERE libelléCompétition = '$nomCompet'";

            $verification2 = executer_une_requete($requeteVerification2);      
            $code = $verification2[0]['instances_instance'][0]['codeCompétition'];
        }
        

        $possibleCode = true;
        $possibleLibellé = true;
        
       
        foreach($vérification[0]['instances_instance'] as $val) // si codeCompétition ou libelléCompétition proposés existe deja dans la base on ne fait pas la modif (à part si c'est le meme code ou le meme libellé qu'avant)
        {
            if ($val['codeCompétition'] == $nouveauCodeCompétition)
            {
                if ($tableau[0])
                {
                    if ($nouveauCodeCompétition != $code)
                    {
                        $possibleCode = false;
                    }
                }
                else 
                {
                    $possibleCode = false;
                }
                
            }
            if ($val['libelléCompétition'] == $nouveauLibelléCompétition)
            {
                if ($tableau[0])
                {
                    if ($nouveauLibelléCompétition != $nomCompet)
                    {
                        $possibleLibellé = false;
                    }
                }
                else
                {
                    $possibleLibellé = false;
                }
            }
        }
        
    
        if (! $possibleCode)
        {
            $messageErreurCode = "ERREUR : le code de la compétition que vous avez choisi ne convient pas (deja présent dans la base)";
        }
        if (! $possibleLibellé)
        {
            $messageErreurLibellé = "ERREUR : le libellé de la compétition que vous avez choisi ne convient pas (deja présent dans la base)";
        }

        return array(($possibleCode && $possibleLibellé),$code,$messageErreurCode,$messageErreurLibellé);
    }
    
    

    if (isset($_POST['changementInfoCompétition']))
    {
        $nomCompet = mysqli_real_escape_string($connexion , trim($_POST['nomCompet']));
        $nouveauCodeCompétition = mysqli_real_escape_string($connexion , trim($_POST['codeCompétition']));
        $nouveauLibelléCompétition = mysqli_real_escape_string($connexion , trim($_POST['libelléCompétition']));
        $nouveauNiveauCompétition = mysqli_real_escape_string($connexion , trim($_POST['niveauCompétition']));
        $nouveauIdFédération = mysqli_real_escape_string($connexion , trim($_POST['idFédération']));

        
        
        $tableau = array(true, $nomCompet);
        
        $possible = verif($tableau , $nouveauCodeCompétition , $nouveauLibelléCompétition);

        $code = $possible[1];
        $messageErreurCode = $possible[2];
        $messageErreurLibellé = $possible[3];


        if ($possible[0])
        {
            $requeteCle = "SET FOREIGN_KEY_CHECKS=0;";

            executer_une_requete($requeteCle);


            $requeteModification = "UPDATE participe P
                                    SET P.codeCompétition='$nouveauCodeCompétition'
                                    WHERE P.codeCompétition = '$code' ;";

            executer_une_requete($requeteModification);

            $requeteModification = "UPDATE Edition E
                                    SET E.codeCompétition='$nouveauCodeCompétition'
                                    WHERE E.codeCompétition = '$code' ;";

            executer_une_requete($requeteModification);

            $requeteModification = "UPDATE Compétition C
                                    SET C.codeCompétition='$nouveauCodeCompétition', C.libelléCompétition='$nouveauLibelléCompétition', C.niveauCompétition='$nouveauNiveauCompétition' 
                                    WHERE C.libelléCompétition = '$nomCompet'
                                    AND C.codeCompétition='$code';";
        
            executer_une_requete($requeteModification);


            $requeteCle = "SET FOREIGN_KEY_CHECKS=1;";

            executer_une_requete($requeteCle);

           
            $_POST['nomCompet'] = $_POST['libelléCompétition'];
            
        }

        
    }
   

    if (isset($_POST['creationCompet']))
    {
        $nomCodeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));
        $nomLibelléCompet = mysqli_real_escape_string($connexion , trim($_POST['libelléCompet']));
        $nomNiveauCompet = mysqli_real_escape_string($connexion , trim($_POST['niveauCompet']));
        $nomIdFédération = mysqli_real_escape_string($connexion , trim($_POST['idFédération']));

        $tableau = array(false); 

        


        $possible = verif( $tableau , $nomCodeCompet , $nomLibelléCompet);

        $messageErreurCode = $possible[2];
        $messageErreurLibellé = $possible[3];

        if ($possible[0])
        {
            $requete = "INSERT INTO Compétition (codeCompétition, libelléCompétition, niveauCompétition, idFédération)
                        VALUES ('$nomCodeCompet' , '$nomLibelléCompet' , '$nomNiveauCompet' , '$nomIdFédération');";

            executer_une_requete($requete);
        }

    }



    if((isset($_POST['modifEdition']))||(isset($_POST['changementInfoEdition'])))
    {
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));
        $annee = mysqli_real_escape_string($connexion , trim($_POST['annee']));

        $requete = "SELECT E.ville_organisatrice, E.idStructure
                    FROM Edition E
                    WHERE E.codeCompétition = '$codeCompet'
                    AND E.année = '$annee';";
                
        $infoEdition = executer_une_requete($requete);
    }



    if(isset($_POST['changementInfoEdition']))
    {
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));
        $annee = mysqli_real_escape_string($connexion , trim($_POST['annee']));

        $nouveauCodeCompet = mysqli_real_escape_string($connexion , trim($_POST['nouveauCodeCompet']));
        $nouvelleAnnee = mysqli_real_escape_string($connexion , trim($_POST['nouvelleAnnee']));
        $nouvelleVilleOrga = mysqli_real_escape_string($connexion , trim($_POST['villeOrga']));
        $nouveauIdStructure = mysqli_real_escape_string($connexion , trim($_POST['idStructure']));
        if ($nouveauIdStructure == "")
        {
            $nouveauIdStructure = "NULL";
        }

        $requeteVerificationCode = "SELECT codeCompétition
                                    FROM Compétition ;";
                            
        $verificationCode = executer_une_requete($requeteVerificationCode);

        $codeExiste = false;

        foreach($verificationCode[0]['instances_instance'] as $row)
        {
            if ($row['codeCompétition'] == $nouveauCodeCompet)
            {
                $codeExiste = true;
            }
        }

        if (!$codeExiste)
        {
            $messageErreurCodeCompet = "Erreur : le code de compétition choisi n'existe pas, veuillez d'abord créer cette compétition avant d'y instancier une édition";
        }
        else
        {
            $requeteVerification = "SELECT année
                                    FROM Edition 
                                    WHERE codeCompétition = '$nouveauCodeCompet';";

            $verificationAnnee = executer_une_requete($requeteVerification);


            
            $possibleAnnee = true;
            foreach($verificationAnnee[0]['instances_instance'] as $row)
            {
                if ($row['année'] == $nouvelleAnnee)
                {
                    if (!(($nouvelleAnnee == $annee)&&($nouveauCodeCompet == $codeCompet)))
                    {
                        $possibleAnnee = false;
                    }
                }
            }

            if ($possibleAnnee )
            {
                $requeteCle = "SET FOREIGN_KEY_CHECKS=0;";

                executer_une_requete($requeteCle);


                $requete = "UPDATE participe P
                            SET P.codeCompétition='$nouveauCodeCompet' , P.année='$nouvelleAnnee'
                            WHERE P.codeCompétition='$codeCompet' 
                            AND P.année='$annee';";
                    
                executer_une_requete($requete);

                $requete = "UPDATE Edition E
                            SET E.codeCompétition='$nouveauCodeCompet' , E.année='$nouvelleAnnee' , E.ville_organisatrice='$nouvelleVilleOrga' , E.idStructure=$nouveauIdStructure
                            WHERE E.codeCompétition='$codeCompet' 
                            AND E.année='$annee';";

                executer_une_requete($requete);


                $requeteCle = "SET FOREIGN_KEY_CHECKS=1;";

                executer_une_requete($requeteCle);
            }
            else
            {
                    $messageErreurAnnee = "ERREUR : l'année que vous avez choisi ne convient pas (deja présent dans la base)";
            }

        }
        
    }



    if(isset($_POST['creationEdition']))
    {
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));
        $annee = mysqli_real_escape_string($connexion , trim($_POST['Annee']));
        $villeOrga = mysqli_real_escape_string($connexion , trim($_POST['villeOrga']));
        $idStructure = mysqli_real_escape_string($connexion , trim($_POST['idStructure']));

        if ($idStructure == "")
        {
            $idStructure = "NULL";
        }

        $requeteVerification = "SELECT année
                                FROM Edition 
                                WHERE codeCompétition = '$codeCompet';";

        $verificationAnnee = executer_une_requete($requeteVerification);


        $possibleAnnee = true;
        foreach($verificationAnnee[0]['instances_instance'] as $row)
        {
            if ($row['année'] == $annee)
            {
                $possibleAnnee = false;
            }
        }
        
        if($possibleAnnee)
        {
            $requete = "INSERT INTO Edition (codeCompétition , année , ville_organisatrice , idStructure)
                        VALUES ('$codeCompet' , $annee , '$villeOrga' , $idStructure);";

            executer_une_requete($requete);
        }
        else
        {
            $messageErreurAnnee = "Erreur : il y a deja une édition de la compétition cette année là";
        }
    }



    if(isset($_POST['suppressionEdition']))
    {
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));
        $annee = mysqli_real_escape_string($connexion , trim($_POST['annee'])); 

        $requete = "DELETE FROM participe
                    WHERE codeCompétition = '$codeCompet'
                    AND année = $annee;";

        executer_une_requete($requete);
    
        $requete = "DELETE FROM Edition
                    WHERE codeCompétition = '$codeCompet'
                    AND année = $annee;";
                
        executer_une_requete($requete);
    }



    if(isset($_POST['suppressionCompet']))
    {
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));

        $requete = "DELETE FROM participe
                    WHERE codeCompétition = '$codeCompet';";

        executer_une_requete($requete);
    
        $requete = "DELETE FROM Edition
                    WHERE codeCompétition = '$codeCompet';";
                
        executer_une_requete($requete);

        $requete = "DELETE FROM Compétition
                    WHERE codeCompétition = '$codeCompet';";

        executer_une_requete($requete);

        unset($_POST['nomCompet']); // on supprime la compétition donc on enleve $_POST['nomCompet'] pour que la vue affiche la séléction de la compétition
    }



    if(isset($_POST['boutonModifRangFinal']))
    {
        $idGroupe = mysqli_real_escape_string($connexion , trim($_POST['idGroupe']));

        $requete = "SELECT A.nomAdhérent, A.prénomAdéhrent, A.numLicence
                    FROM Groupe_De_Danse D, Adhérent A
                    WHERE D.idGroupe = $idGroupe
                    AND D.numLicence1 = A.numLicence;";
                
        $nomDanseur1 = executer_une_requete($requete);

        $requete = "SELECT A.nomAdhérent, A.prénomAdéhrent, A.numLicence
                    FROM Groupe_De_Danse D, Adhérent A
                    WHERE D.idGroupe = $idGroupe
                    AND D.numLicence2 = A.numLicence;";
                
        $nomDanseur2 = executer_une_requete($requete);
    }



    if(isset($_POST['modifRangFinal']))
    {
        $annee = mysqli_real_escape_string($connexion , trim($_POST['annee']));
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));
        $idGroupe = mysqli_real_escape_string($connexion , trim($_POST['idGroupe']));
        $rangFinal = mysqli_real_escape_string($connexion , trim($_POST['rangFinal']));

        $requete = "UPDATE participe P
                    SET P.rang_final = $rangFinal
                    WHERE P.année = $annee
                    AND P.codeCompétition = '$codeCompet'
                    AND P.idGroupe = $idGroupe";

        executer_une_requete($requete);
    }



    if(isset($_POST['boutonAjoutGroupe']))
    {
        $annee = mysqli_real_escape_string($connexion , trim($_POST['annee']));
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));

        $requete = "SELECT G.idGroupe, G.numLicence1, G.numLicence2
                    FROM Groupe_De_Danse G
                    WHERE G.idGroupe NOT IN (SELECT P.idGroupe
                                             FROM participe P, Groupe_De_Danse G
                                             WHERE P.idGroupe = G.idGroupe
                                             AND P.année = $annee
                                             AND P.codeCompétition = '$codeCompet');";

        $listeGroupeAbsent = executer_une_requete($requete);
    }



    if(isset($_POST['ajoutGroupe']))
    {
        $annee = mysqli_real_escape_string($connexion , trim($_POST['annee']));
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));

        // on récupere l'id du groupe
        $chaine1 = $_POST['groupe'];
        $idGroupe = "";
        $i = 5;
        while(substr($chaine1,$i,1) != ' ') // tant que le caratere à la position i n'est pas un espace, on le concatene avec $idGroupe
        {
            $idGroupe = $idGroupe . substr($chaine1,$i,1);
            $i = $i + 1;
        }
        

        $requete = "INSERT INTO participe ( idGroupe , codeCompétition , année )
                    VALUES ($idGroupe , '$codeCompet' , $annee)";

        executer_une_requete($requete);
    }



    if((isset($_POST['gestionDanseurs']))||(isset($_POST['modifRangFinal']))||(isset($_POST['retourModifRangFinal']))||(isset($_POST['ajoutGroupe'])))
    {
        $annee = mysqli_real_escape_string($connexion , trim($_POST['annee']));
        $codeCompet = mysqli_real_escape_string($connexion , trim($_POST['codeCompet']));

        $requete = "SELECT P.idGroupe, G.numLicence1, G.numLicence2, P.rang_final
                    FROM participe P, Groupe_De_Danse G
                    WHERE P.idGroupe = G.idGroupe
                    AND P.année = $annee
                    AND P.codeCompétition = '$codeCompet';";

        $listeGroupePresent = executer_une_requete($requete);

        
    }



    if(isset($_POST['nomCompet']))
    {
        $nomCompet = mysqli_real_escape_string($connexion , trim($_POST['nomCompet']));
        
        $requete = "SELECT E.codeCompétition, E.année, E.ville_organisatrice, E.idStructure
                    FROM Edition E, Compétition C
                    WHERE C.codeCompétition = E.codeCompétition
                    AND C.libelléCompétition = '$nomCompet';";

        $listeEdition = executer_une_requete($requete);



        $requete = "SELECT *
                    FROM Compétition
                    WHERE libelléCompétition = '$nomCompet';";

        $infoCompet = executer_une_requete($requete);
    }


    $requete = "SELECT libelléCompétition
                FROM Compétition ;";

    $selectCompétition = executer_une_requete($requete);
?>