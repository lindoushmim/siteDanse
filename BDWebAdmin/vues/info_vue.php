
<div class="info">
    <h1>Info sur l'école :</h1>

    <?php   
    
        if (isset($resultat_Nom_Adresse[0]['instances_instance']))
            {
                $tab = $resultat_Nom_Adresse[0]['instances_instance'][0];           //un seul n-uplet

                if((isset($_POST["boutonModifInfoEcole"])) 
                && (!(isset($_POST["changementInfoEcole"]))))
                {
                    echo '<FORM action="#" method="post">
                            <input type="hidden" name="nomUtilisateur" value="' . $utilisateur . '">
                            <nobr> Nom de l\'école : </nobr> 
                            <input type="text" name="nomEcole" value="' . $tab['nomEcole'] . '">
                            <br>
                            <br>
                            <nobr> Adresse : </nobr>
                            <input type="text" name="numVoie" value="' . $tab['numVoie'] . '">
                            <nobr> </nobr>
                            <input type="text" name="nomRue" value="' . $tab['nomRue'] . '">
                            <nobr> , </nobr>
                            <input type="text" name="nomVille" value="' . $tab['nomVille'] . '">
                            <br>
                            <br>
                            <nobr> Nom du fondateur : </nobr>
                            <input type="text" name="nomsFondateurs" value="' . $utilisateur . '">
                            <br>
                            <br>
                            <input type="submit" name="changementInfoEcole" value="Valider les modifications">
                        </FORM>' ;
                    
                    echo '<br>';
                    echo '<br>';

                    echo '<FORM action="index.php?f=tdb_ecole&p=info" method="post">
                            <input type="hidden" name="nomUtilisateur" value="' . $utilisateur . '">
                            <input type="submit" name="boutonRetourModifInfo" value="Retour">
                          </FORM>';
                }
                else
                {

                    echo " <nobr> Nom de l'école : </nobr>" . $tab['nomEcole']  ;
                    echo '<br>';
                    echo '<br>';
                    
                    echo '<nobr> Adresse : ' . $tab['numVoie'] . ' ' . $tab['nomRue'] . '    , ' . $tab['nomVille'] . '</nobr>';
                    echo '<br>';
                    echo '<br>';
                     
                    echo '<nobr> Nom du fondateur : </nobr>' . $utilisateur ;
                    echo '<br>';
                    echo '<br>';
                    
                    echo '<FORM action="#" method="post">
                            <input type="hidden" name="nomUtilisateur" value="' . $utilisateur . '">
                            <input type="submit" name="boutonModifInfoEcole" value="Modifier">
                          </FORM>';
                    
                    echo '<br>';
                    echo '<br>';

                    echo '<FORM action="index.php?f=tdb_ecole" method="post">
                            <input type="hidden" name="nomUtilisateur" value="' . $utilisateur . '">
                            <input type="submit" name="boutonRetourInfo" value="Retour">
                          </FORM>';
                        
                }
            }
            else 
            {
                echo 'erreur : pas de "resultat_Nom_Adresse"';
            }


    ?>
    
    
</div>
