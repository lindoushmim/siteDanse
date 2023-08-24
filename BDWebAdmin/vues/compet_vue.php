<div class="info">

    <?php
        
        //SELECTION DE LA COMPETITION
        if((! isset($_POST['nomCompet']))&&(!isset($_POST['modifEdition']))&&(!isset($_POST['ajoutCompet']))
            &&(!isset($_POST['changementInfoEdition']))&&(($messageErreurCode== "")&&($messageErreurLibellé== "")))
        {
            echo "<h1>Selectionner une Compétition</h1>";

            echo '<br>';
            echo '<FORM action="#" method="post">
                    <select name="nomCompet">' ; 
            foreach($selectCompétition[0]['instances_instance'] as $row)
            {
                echo '<option>' . $row['libelléCompétition'] . '</option>';
            }
            echo '</select>
                <input type="submit" name="choixCompet" value="valider">
                </FORM>';
            echo '<br>
                  <br>';

            echo '<FORM action="#" method="post">
                     <input type="submit" name="ajoutCompet" value="Ajouter une compétition">
                  </FORM>';

                  // nomCompet
                  // choixCompet => valider 
                  // ajoutCompet => ajouter 

                  //modifEdition
                  //modifCompet
                  //retourListeEdition
        }



        //AFFICHAGE DU NOM ET DE LA LISTE DES EDITIONS DE LA COMPETITION SELECTIONNEE
        if(((isset($_POST['nomCompet']))&&(!isset($_POST['modifEdition']))&&(! isset($_POST['modifCompet']))
            &&(!isset($_POST['changementInfoEdition']))&&(!isset($_POST['ajoutEdition']))&&(!isset($_POST['creationEdition']))
            &&(!isset($_POST['confirmationSuppressionEdition']))&&(!isset($_POST['confirmationSuppressionCompet']))
            &&(!isset($_POST['gestionDanseurs']))&&(!isset($_POST['boutonModifRangFinal']))&&(!isset($_POST['modifRangFinal']))&&(!isset($_POST['retourModifRangFinal']))
            &&(!isset($_POST['boutonAjoutGroupe']))&&(!isset($_POST['ajoutGroupe']))
            &&($messageErreurCode== "")&&($messageErreurLibellé==""))
            ||((isset($_POST['changementInfoEdition']))&&($messageErreurCodeCompet=="")&&($messageErreurAnnee==""))
            ||((isset($_POST['creationEdition'])&&($messageErreurAnnee==""))))
        {
            echo "<h2>Compétition séléctionnée : " . $_POST['nomCompet'] . " </h2>";

            echo "<p>Voici la liste des éditions de la compétition séléctionnée</p>";
            echo "<table>
                    <thead>
                        <tr>";
                            foreach($listeEdition[0]['schema_instance'] as $row) {  //affichage des attributs
                    
                                echo '<th>';
                                    echo $row['nom'];
                                echo '</th>';
                    
                            }
                        
            echo       "</tr>	
                    </thead>
                    <tbody>";
                        foreach($listeEdition[0]['instances_instance'] as $row) // affichage des n-uplets
                        {  
                            echo '<tr>';
                            foreach($row as $valeur) 
                            { 
                        
                                echo '<td>'. $valeur . '</td>';
                            }
                            
                            // bouton modifier
                            echo '<td><FORM action="#" method="post"> 
                                        <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                                        <input type="hidden" name="codeCompet" value="' . $row['codeCompétition'] . '">
                                        <input type="hidden" name="annee" value="' . $row['année'] . '">
                                        <input type="submit" name="modifEdition" value="modifier">
                                      </FORM></td>';

                            // bouton gestion des danseurs
                            echo '<td><FORM action"#" method="post">
                                        <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                                        <input type="hidden" name="codeCompet" value="' . $row['codeCompétition'] . '">
                                        <input type="hidden" name="annee" value="' . $row['année'] . '">
                                        <input type="submit" name="gestionDanseurs" value="gestion des danseurs">
                                      </FORM></td>';
                            
                            // bouton supprimer
                            echo '<td><FORM action="#" method="post">
                                        <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                                        <input type="hidden" name="codeCompet" value="' . $row['codeCompétition'] . '">
                                        <input type="hidden" name="annee" value="' . $row['année'] . '">
                                        <input type="hidden" name="villeOrga" value="' . $row['ville_organisatrice'] . '">
                                        <input type="hidden" name="idStructure" value="' . $row['idStructure'] . '">
                                        <input type="submit" name="confirmationSuppressionEdition" value="supprimer">
                                      </FORM></td>';

                            echo '</tr>';
                        }
                        echo '<tr><td></td><td>';

                        // bouton ajouter une édition
                        echo '<FORM action="#" method="post">
                                <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                                <input type="submit" name="ajoutEdition" value="Ajouter une Edition">
                              </FORM>';
                        echo '</td></tr>';
            
                
            echo	"</tbody>
                </table>";

            echo '<br>
                  <br>';

            // bouton modifier les informations de la compétition
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="submit" name="modifCompet" value="Modifer les informations de la compétition">
                  </FORM>';

            echo '<br>';

            // bouton supprimer cette compétition
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="submit" name="confirmationSuppressionCompet" value="Supprimer cette Compétition">
                  </FORM>';
            
            echo '<br>';
            
            // bouton retour
            echo '<FORM action="#" method="post">
                    <input type="submit" name="retourListeEdition" value="retour">
                  </FORM>';

            
        }



        //MODIFICATION D'UNE COMPETITION
        if ((isset($_POST['modifCompet'])) || ((($messageErreurCode!= "")||($messageErreurLibellé!= ""))&&(isset($_POST['changementInfoCompétition']))))
        {
            $tab = $infoCompet[0]['instances_instance'][0];

            // formulaire de modification d'une compétition
            echo '<FORM action="#" method="post">
                        <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                        <nobr> Code de la Compétition : </nobr> 
                        <input type="text" name="codeCompétition" value="' . $tab['codeCompétition'] . '">
                        <br>
                        ' 
                        . $messageErreurCode . 
                        '
                        <br>
                        <br>
                        <nobr> Libellé de la Compétition : </nobr>
                        
                        <input type="text" name="libelléCompétition" value="' . $tab['libelléCompétition'] . '">
                        '
                        . $messageErreurLibellé . 
                        '
                        <br>
                        <br>
                        <nobr> Niveau de la Compétition : </nobr>  
                        <select name="niveauCompétition">
                            <option';
                            if ($tab['niveauCompétition'] == "National")
                            {
                                echo ' selected ';
                            }
            echo            '>National</option>
                            <option';
                            if ($tab['niveauCompétition'] == "Régional")
                            {
                                echo ' selected ';
                            }
            echo            '>Régional</option>
                            <option';
                            if ($tab['niveauCompétition'] == "Départemental")
                            {
                                echo ' selected ';
                            }
            echo            '>Départemental</option>
                        </select>
                        <br>
                        <br>
                        <nobr> ID de la Fédération : </nobr>
                        <input type="text" name="idFédération" value="' . $tab['idFédération'] . '">
                        <br>
                        <br>
                        <input type="submit" name="changementInfoCompétition" value="Valider les modifications">
                    </FORM>' ;
            
            echo '<br>';

            //bouton retour
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="submit" name="boutonRetourModifCompet" value="retour">
                  </FORM>';
        }



        //AJOUT D'UNE COMPETITION
        if ((isset($_POST['ajoutCompet']))|| ((($messageErreurCode!= "")||($messageErreurLibellé!= ""))&&(isset($_POST['creationCompet']))))
        {
            // formulaire d'ajout de compétition
            echo '<FORM action="#" method="post">
                    <nobr>Code de la Compétition</nobr>
                    <input type="text" name="codeCompet">
                    <br>
                    ' . $messageErreurCode . '
                    <br>
                    <br>
                    <nobr>Libellé de la Compétition</nobr>
                    <input type="text" name="libelléCompet">
                    <br>
                    ' . $messageErreurLibellé . '
                    <br>
                    <br>
                    <nobr>Niveau de la Compétition</nobr>
                    <select name="niveauCompet">
                        <option>National</option>
                        <option>Régional</option>
                        <option>Départemental</option>
                    </select>
                    <br>
                    <br>
                    <nobr>ID de la Fédération<nobr>
                    <input type="number" name="idFédération" min="1" value="1">
                    <br>
                    <br>
                    <br>
                    <br>
                    <input type="submit" name="creationCompet" value="Créer cette Compétition">
                  </FORM>';
            

            // bouton annuler
            echo '<br>
                  <br>
                  <br>
                  <FORM action="#" method="post">
                    <input type="submit" name="retourCréationCompet" value="Annuler">
                  </FORM>';
        }



        //MODIFICATION D'UNE EDITION
        if((isset($_POST['modifEdition']))|| ((($messageErreurCodeCompet!= "")||($messageErreurAnnee!= ""))&&(isset($_POST['changementInfoEdition']))))
        {
            //formulaire de modification d'une édition
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                    <input type="hidden" name="annee" value="' . $_POST['annee'] . '">
                    <nobr>Code de la Compétition</nobr>
                    <input type="text" name="nouveauCodeCompet" value="' . $_POST['codeCompet'] . '">
                    <br>
                    ' . $messageErreurCodeCompet . '
                    <br>
                    <br>
                    <nobr>Année de l\'édition</nobr>
                    <input type="number" name="nouvelleAnnee" value="' . $_POST['annee'] . '">
                    <br>
                    ' . $messageErreurAnnee . '
                    <br>
                    <br>
                    <nobr>Ville organisatrice</nobr>
                    <input type="text" name="villeOrga" value="' . $infoEdition[0]['instances_instance'][0]['ville_organisatrice'] . '">
                    <br>
                    <br>
                    <nobr>ID de la Structure<nobr>
                    <input type="number" name="idStructure" min="1" value="' . $infoEdition[0]['instances_instance'][0]['idStructure'] . '">
                    <br>
                    <br>
                    <br>
                    <br>
                    <input type="submit" name="changementInfoEdition" value="Valider les modifications">
                  </FORM>';
            echo '<br>';
            echo '<br>';
            
            // bouton retour
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="submit" name="retourModifEdition" value="Retour">
                  </FORM>';
        }



        // AJOUT D'UNE EDITION
        if((isset($_POST['ajoutEdition']))||((isset($_POST['creationEdition'])&&($messageErreurAnnee!=""))))
        {
            echo '<br>';

            //formulaire d'ajout d'une édition
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="hidden" name="codeCompet" value="' . $infoCompet[0]['instances_instance'][0]['codeCompétition'] . '">
                    <nobr>Code de la Compétition : ' . $infoCompet[0]['instances_instance'][0]['codeCompétition'] . '</nobr>
                    <br>
                    <br>
                    <br>
                    <br>
                    <nobr>Année de l\'édition</nobr>
                    <input type="number" name="Annee">
                    <br>
                    ' . $messageErreurAnnee . '
                    <br>
                    <br>
                    <nobr>Ville organisatrice</nobr>
                    <input type="text" name="villeOrga">
                    <br>
                    <br>
                    <br>
                    <nobr>ID de la Structure<nobr>
                    <input type="number" name="idStructure" min="1">
                    <br>
                    <br>
                    <br>
                    <br>
                    <input type="submit" name="creationEdition" value="Créer cette Edition">
                  </FORM>';

            echo '<br>';
            echo '<br>';

            // bouton retour
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="submit" name="retourCreationEditino" value="Retour">
                  </FORM>';
        }



        // SUPPRESSION D'UNE EDITION
        if(isset($_POST['confirmationSuppressionEdition']))
        {
            // rappel de l'édition que l'utilisateur compte supprimer
            echo "<h2>Vous êtes sur le point de supprimer l'édition suivante : </h2>";
            echo '<p>Code de la compétition : ' . $_POST['codeCompet'] . '</p>
                  
                  <p>Année : ' . $_POST['annee'] . '</p>
                 
                  <p>Ville organisatrice : ' . $_POST['villeOrga'] . '</p>
                  
                  <p>ID de la structure sportive : ' . $_POST['idStructure'] . '</p>';

            echo '<br>';

            echo '<p> Cela entrainera également la suppression des données en rapport avec cette édition : <br>
                      quels groupes ont participés à cette édition, quel a été leur numéro de passage 
                      et quel a été leur rang </p>';

            echo '<h2> Etes-vous sûr de vouloir supprimer cette édition ? </h2>';
            
            // bouton supprimer cette édition   et    bouton annuler
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                    <input type="hidden" name="annee" value="' . $_POST['annee'] . '">
                    <input type="submit" name="suppressionEdition" value="Supprimer cette Edition">
                    <input type="submit" name="annulationSuppressionEdition" value="Annuler">
                  </FORM>';
        }



        // SUPPRESSION D'UNE COMPETITION
        if(isset($_POST['confirmationSuppressionCompet']))
        {
            //rappel de la compétition que l'utilisateur compte supprimer
            echo "<h2>Vous êtes sur le point de supprimer l'édition suivante : </h2>";
            echo '<p>Code de la compétition : ' . $infoCompet[0]['instances_instance'][0]['codeCompétition'] . '</p>
                  
                  <p>Libellé de la compétition : ' . $infoCompet[0]['instances_instance'][0]['libelléCompétition'] . '</p>
            
                  <p>Niveau de la compétition : ' . $infoCompet[0]['instances_instance'][0]['niveauCompétition'] . '</p>
                
                  <p>ID de la fédération : ' . $infoCompet[0]['instances_instance'][0]['idFédération'] . '</p>';

            echo '<p> Cela entrainera également la suppression de toutes les éditions de cette compétition, ainsi que les données en rapport avec ces éditions : <br>
                      quels groupes ont participés à ces éditions, quel a été leur numéro de passage 
                      et quel a été leur rang </p>';
                    
            echo '<h2> Etes-vous sûr de vouloir supprimer cette compétition ? </h2>';

            // bouton supprimer cette compétition       et       bouton annuler
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="hidden" name="codeCompet" value="' . $infoCompet[0]['instances_instance'][0]['codeCompétition'] . '">
                    <input type="submit" name="suppressionCompet" value="Supprimer cette Compétition">
                    <input type="submit" name="annulationSuppressionCompet" value="Annuler">
                  </FORM>';
        }


        
        // GESTION DES DANSEURS (pour amener les fonctionnalités "— inscrire un couple ou un groupe de danseurs à une édition de compétition" 
        //                                                    et "— affecter un rang à un couple ou un groupe de danseurs lors d’une édition")
        if((isset($_POST['gestionDanseurs']))||(isset($_POST['modifRangFinal']))||(isset($_POST['retourModifRangFinal']))||(isset($_POST['ajoutGroupe']))||(isset($_POST['retourAjoutGroupe'])))
        {
            echo "<h2>Vous êtes sur la page de gestion des danseurs de l'édition " . $_POST['annee'] . " de la compétition " . $_POST['codeCompet'] . "</h2>";
            echo '<p> Voici la liste des groupes de danse participant à l\'édition : </p>';


            echo "<table>
                    <thead>
                        <tr>";
                            foreach($listeGroupePresent[0]['schema_instance'] as $row) {  //affichage des attributs
                    
                                echo '<th>';
                                    echo $row['nom'];
                                echo '</th>';
                    
                            }
                        
            echo       "</tr>	
                    </thead>
                    <tbody>";

                    foreach($listeGroupePresent[0]['instances_instance'] as $row) // affichage des n-uplets
                    {  
                        echo '<tr>';
                        foreach($row as $valeur) 
                        { 
                    
                            echo '<td>'. $valeur . '</td>';
                        }
                        //bouton modifier le rang final
                        echo '<td><FORM action="#" method="post">
                                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                                    <input type="hidden" name="idGroupe" value="' . $row['idGroupe'] . '">
                                    <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                                    <input type="hidden" name="annee" value="' . $_POST['annee'] . '">
                                    <input type="submit" name="boutonModifRangFinal" value="Modifier le Rang Final">
                                  </FORM>';
                        
                        echo '</tr>';
                    }
                                            // bouton ajouter un groupe
            echo '<tr> <td></td><td></td>   <td><FORM action="#" method="post">
                                                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                                                    <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                                                    <input type="hidden" name="annee" value="' . $_POST['annee'] . '"> 
                                                    <input type="submit" name="boutonAjoutGroupe" value="Ajouter un groupe">
                                                </FORM>';
                    
            echo	"</tbody>
                </table>";

            echo '<br>
                  <br>';
            
            //bouton retour
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="submit" name="retourGestionDanseurs" value="Retour">
                  </FORM>';
        }



        // MODIFICATION DU RANG FINAL D'UN GROUPE DANS UNE EDITION
        if(isset($_POST['boutonModifRangFinal']))
        {
            $danseur1 = $nomDanseur1[0]['instances_instance'][0];
            $danseur2 = $nomDanseur2[0]['instances_instance'][0];
            //rappel du groupe de danse et de l'édition
            echo '<p>Veuillez entrer le rang final du groupe de danse (' . $_POST['idGroupe'] . ') constitué de 
                    ' . $danseur1['prénomAdéhrent'] . ' ' . $danseur1['nomAdhérent'] . '  ( ' . $danseur1['numLicence'] . ' ) 
                    et de ' . $danseur2['prénomAdéhrent'] . ' ' . $danseur2['nomAdhérent'] . '  ( ' . $danseur2['numLicence'] . ' )';
            echo "<p>Lors de l'édition " . $_POST['annee'] . " de la compétition " . $_POST['codeCompet'] . "</p>";
            echo '<br>';

            //formulaire pour remplir le rang final d'un groupe de danse
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                    <input type="hidden" name="annee" value="' . $_POST['annee'] . '">
                    <input type="hidden" name="idGroupe" value="' . $_POST['idGroupe'] . '">  
                    <input type="number" name="rangFinal">
                    <input type="submit" name="modifRangFinal" value="valider">
                  </FORM>';

            echo '<br>';

            //bouton retour
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                    <input type="hidden" name="annee" value="' . $_POST['annee'] . '"> 
                    <input type="submit" name="retourModifRangFinal" value="retour">
                  </FORM>';
        }



        // AJOUT D'UN GROUPE DANS UNE EDITION 
        if (isset($_POST['boutonAjoutGroupe']))
        {
            echo '<h2>Veuillez choisir le groupe de danse que vous souhaitez ajouter dans l\'édition '. $_POST['annee'] . ' de la compétition ' . $_POST['codeCompet'] . '</p>';

            //formulaire pour choisir le groupe à ajouter dans l'édition
            echo '<br><FORM action="#" method="post">
                        <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                        <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                        <input type="hidden" name="annee" value="' . $_POST['annee'] . '">
                        <select name="groupe">';
                        foreach($listeGroupeAbsent[0]['instances_instance'] as $row)
                        {
                            echo '<option>ID : ' . $row['idGroupe'] . '  , numéro de licence des Adéhents :  ' . $row['numLicence1'] . '  et  ' . $row['numLicence2'] . '</option>';
                        }
            echo       '</select>
                        <input type="submit" name="ajoutGroupe" value="valider">
                     </FORM>';

            echo '<br>';

            //bouton retour
            echo '<FORM action="#" method="post">
                    <input type="hidden" name="nomCompet" value="' . $_POST['nomCompet'] . '">
                    <input type="hidden" name="codeCompet" value="' . $_POST['codeCompet'] . '">
                    <input type="hidden" name="annee" value="' . $_POST['annee'] . '"> 
                    <input type="submit" name="retourModifRangFinal" value="retour">
                  </FORM>';
        }
    ?>
    
</div>