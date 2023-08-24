<div class="tabFeder">
    <div class="infoTabFeder">

        <h1 class="titreTabFeder">TABLEAU DE BORD FÉDÉRATION</h1>
        
        
        <?php

            if (isset($resultatNomSigleFeder[0]['instances_instance']))
            {
                $tab = $resultatNomSigleFeder[0]['instances_instance'][0];           //un seul n-uplet
                echo " <p> Nom de la federation : " . $tab['nomFédération'] . "</p>";
                echo "<p> Son sigle est : ".$tab['sigleFédération']."</p>"; 
                echo '<br>';
                echo '<p> Adresse : ' . $tab['numVoie'] . ' ' . $tab['nomRue'] . ', ' .$tab['codePostal'].  '    (' . $tab['nomVille'] . ') </p>';
                echo '<br>';
            }
            else 
            {
                echo 'erreur : pas de resultat';
            }

            if (isset($resultatNbComite[0]['instances_instance']))
            {
                $tab = $resultatNbComite[0]['instances_instance'][0];
                echo"<p> Nombre de comité de la fédération : ".$tab['COUNT(idComité)']."</p>"; 
                echo "<br>";
            }
            else 
            {
                echo 'erreur : pas de resultat'; 
            }

            if (isset($resultatNbAdherent[0]['instances_instance']))
            {
                $tab = $resultatNbAdherent[0]['instances_instance'][0]; 
                echo"<p>Nombre d'adhérent de la fédération : ".$tab['COUNT(numLicence)']."</p>"; 
                echo "<br>"; 
            }
            else 
            {
                echo 'erreur : pas de resultat'; 
            }

            if (isset($resultatListeCompet[0]['instances_instance']))
            {
                echo "<p> Liste des compétitions organisées par la fédération :</p>";
                echo "<ul>";
                    foreach($resultatListeCompet[0]['instances_instance'] as $tab) 
                    {
                        echo "<li>".$tab['libelléCompétition']."</li>"; 
                    }
                echo "</ul>";
                echo "<br>"; 
            }
            else 
            {
                echo 'erreur : pas de resultat'; 
            }

            if (isset($resultatNbadherentCompet[0]['instances_instance']))
            {
                $tab = $resultatNbadherentCompet[0]['instances_instance'][0]; 
                echo"<p> nombre d’adhérents ayant participé à une compétition : ".$tab['COUNT(Licence)']."</p>"; 
            }
            else 
            {
                echo 'erreur : pas de resultat'; 
            }
        
        ?>

    </div>

    <div class="redirectionTabFeder">
        <h2 class="titreRedirection"> Redirection vers d'autre page </h2>
        <a href="index.php?f=tdb_feder&p=fedef">Gestion des informations de la fédération</a>
        <br>
        <a href="index.php?f=tdb_feder&p=comite">Gestion des informations des comités</a>
        <br>
        <a href="index.php?f=tdb_feder&p=membre">Gestion des membres de la fédération</a>
        <br>
        <a href="index.php?f=tdb_feder&p=compet">Gestion des compétitions</a>
    </div>


</div>

