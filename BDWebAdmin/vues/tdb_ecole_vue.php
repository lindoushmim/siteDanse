<div class="panneau">
   <div class="tableEcoleDanse">

        <div class="infoTabEcole">
            <h1 class="titreTabEcole">TABLEAU DE BORD ÉCOLE</h1>
            <?php
                //print_r(array_keys($resultat_Nom_Adresse[0]['instances_instance'][0])); //pour voir toutes les clés
                if (isset($resultat_Nom_Adresse[0]['instances_instance']))
                {
                    $tab = $resultat_Nom_Adresse[0]['instances_instance'][0];           //un seul n-uplet
                    echo " <p> Nom de l'école : " . $tab['nomEcole'] . "</p>";
                    echo '<br>';
                    
                    echo '<p> Adresse : ' . $tab['numVoie'] . ' ' . $tab['nomRue'] . '    (' . $tab['nomVille'] . ') </p>';
                    echo '<br>';
                }
                else 
                {
                    echo 'erreur : pas de "resultat_Nom_Adresse"';
                }


                if (isset($resultat_Liste_Employe[0]['instances_instance']))
                {
                    $tab = $resultat_Liste_Employe[0]['instances_instance'];
                    echo "Liste des Employés : ";
                    foreach ($tab as $rows)
                    {
                        echo "<p>" . $rows['prénomEmployé'] . " " . $rows['nomEmployé'] . "</p>";
                    }
                    echo "<br>";
                }
                else 
                {
                    echo 'erreur : pas de "resultat_Liste_Employe"';
                }

                if (isset($resultat_Nombre_Adherent[0]['instances_instance']))
                {
                    $tab = $resultat_Nombre_Adherent[0]['instances_instance'][0];
                    echo "<p> Nombre d'adhérent cette année (2022): " . $tab['COUNT(A.numLicence)'] . "</p>" ;
                    echo "<br>";
                }
                else 
                {
                    echo 'erreur : pas de "resultat_Nombre_Adherent"';
                }

                if (isset($resultat_Cours[0]['instances_instance']))
                {
                    $tab = $resultat_Cours[0]['instances_instance'];
                    echo "Liste des cours proposés : ";
                    foreach ($tab as $rows)
                    {
                        echo "<p>" . $rows['libelléCours'] . "</p>";
                    }
                    echo "<br>";
                }
                else 
                {
                    echo 'erreur : pas de "resultat_Cours"';
                }

                if (isset($resultat_Nombre_Adherent_Competition[0]['instances_instance']))
                {
                    $tab = $resultat_Nombre_Adherent_Competition[0]['instances_instance'][0];
                    echo "<p> Nombre d'adhérent ayant participé à une compétition : " . $tab['COUNT(Licence)'] . "</p>";
                    echo "<br>";
                }
                else 
                {
                    echo 'erreur : pas de "resultat_Nombre_Adherent_Competition"';
                }
            ?>

        </div>

        <div class="redirectionTabEcole">
            <h2 class="titreRedirection"> Redirection vers d'autre page </h2> <?php // Grace à ça on récupere l'information du nom de l'utilisateur qui est utile pour la suite (et on a plus besoin de lui redemander) ?>
            <FORM action="index.php?f=tdb_ecole&p=info" method="post">
                <input type="hidden" name="nomUtilisateur" value="<?php echo $utilisateur ?>">
                <input type="submit" name="boutonInfoEcole" value="Gestion des informations de l'ecole">
            </FORM>
            <FORM action="index.php?f=tdb_ecole&p=employe" method="post">
                <input type="hidden" name="nomUtilisateur" value="<?php echo $utilisateur ?>">
                <input type="submit" name="boutonInfoEcole" value="Gestion des employés">
            </FORM>
            <FORM action="index.php?f=tdb_ecole&p=adherent" method="post">
                <input type="hidden" name="nomUtilisateur" value="<?php echo $utilisateur ?>">
                <input type="submit" name="boutonInfoEcole" value="Gestion des adhérents">
            </FORM>
            <FORM action="index.php?f=tdb_ecole&p=cours" method="post">
                <input type="hidden" name="nomUtilisateur" value="<?php echo $utilisateur ?>">
                <input type="submit" name="boutonInfoEcole" value="Gestion des cours">
            </FORM>
            <FORM action="index.php?f=tdb_ecole&p=inscription" method="post">
                <input type="hidden" name="nomUtilisateur" value="<?php echo $utilisateur ?>">
                <input type="submit" name="boutonInfoEcole" value="Gestion des inscriptions">
            </FORM>
        </div>

    </div>
</div>