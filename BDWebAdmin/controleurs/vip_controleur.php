<?php

    $requete = "SELECT nomFédération FROM Fédération ;";

    $nomFédé = executer_une_requete($requete);

    if (isset($_POST['nomFédération']))
    {
        $nomF = $_POST['nomFédération'];
        $requete = "SELECT MAX(P.rang_final)
                    FROM participe P, Edition E, Compétition C, Fédération F
                    WHERE C.idFédération = F.idFédération
                    AND F.nomFédération = '$nomF'
                    AND C.codeCompétition = E.codeCompétition
                    AND P.codeCompétition = E.codeCompétition
                    AND E.année = P.année;";
        $rangMax = executer_une_requete($requete);

        $requete = "SELECT MAX(nbParEcole)
                    FROM
                        (SELECT COUNT(A.numLicence) AS nbParEcole
                        FROM Adhérent A, Ecole_De_Danse ED, est_inscrit EI, Fédération F
                        WHERE F.nomFédération = '$nomF'
                        AND ED.idFédération = F.idFédération
                        AND ED.idEcole = EI.idEcole
                        AND A.numLicence = EI.numLicence
                        GROUP BY ED.idEcole) AS T";
                        
        $nbAdhérentMax = executer_une_requete($requete);

        if (isset($_POST['limitationForm']))
        {
            if ($_POST['adhérentMinimum'] == 'Pas de limitation')
            {
                $_POST['adhérentMinimum'] = 0;
            }
            if ($_POST['rangMinimum'] == 'Pas de limitation')
            {
                $_POST['rangMinimum'] = $rangMax[0]['instances_instance'][0]['MAX(P.rang_final)'];
            }

            $adhMin = $_POST['adhérentMinimum'];
            $rgMin = $_POST['rangMinimum'];

            $requete = "SELECT DISTINCT(A.numLicence), A.nomAdhérent, A.prénomAdéhrent
                        FROM Adhérent A, Ecole_De_Danse ED, Fédération F, est_inscrit EI
                        WHERE F.nomFédération = '$nomF'
                        AND ED.idFédération = F.idFédération
                        AND ED.idEcole = EI.idEcole
                        AND A.numLicence = EI.numLicence
                        AND ED.idEcole IN (SELECT ED2.idEcole
                                           FROM Adhérent A2, Ecole_De_Danse ED2, Fédération F2, est_inscrit EI2
                                           WHERE F2.nomFédération = '$nomF'
                                           AND ED2.idFédération = F2.idFédération
                                           AND ED2.idEcole = EI2.idEcole
                                           AND A2.numLicence = EI2.numLicence
                                           GROUP BY ED2.idEcole
                                           HAVING COUNT(A2.numLicence) >= $adhMin)
                        AND A.numLicence IN (SELECT G.numLicence1
                                             FROM Groupe_De_Danse G, participe P, Fédération F3, Edition E, Compétition C
                                             WHERE G.idGroupe = P.idGroupe
                                             AND P.rang_final <= $rgMin
                                             AND F3.nomFédération = '$nomF'
                                             AND C.codeCompétition = E.codeCompétition
                                             AND P.codeCompétition = E.codeCompétition
                                             AND E.année = P.année
                                             AND C.idFédération = F.idFédération
                                             UNION
                                             SELECT G2.numLicence2
                                             FROM Groupe_De_Danse G2, participe P2, Fédération F4, Edition E2, Compétition C2
                                             WHERE G2.idGroupe = P2.idGroupe
                                             AND P2.rang_final <= $rgMin
                                             AND F4.nomFédération = '$nomF'
                                             AND C2.codeCompétition = E2.codeCompétition
                                             AND P2.codeCompétition = E2.codeCompétition
                                             AND E2.année = P2.année
                                             AND C2.idFédération = F4.idFédération);";

            $danseursChoisis = executer_une_requete($requete);
        }
    }
?>