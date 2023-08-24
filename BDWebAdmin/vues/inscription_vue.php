 
<div class="inscription"> 

    <?php 

        //SELECTION DU NOM DES ADHERENT D'UNE ÉCOLE 
   
        if (!(isset($_POST['nomAdherentEcole'])) && !(isset($_POST['ajouterAffectation'])) && !(isset($_POST['ajouterCoursAdherent'])) 
        && !(isset($_POST['modifCours'])) && !(isset($_POST['ajouterAffectation']))&&(!(isset($_POST['retourModifCours'])))
        || isset($_POST['retourListeAdhetent']) )
        {
            echo "<h1>Selectionner un adherent de l'ecole</h1>"; 
            echo '<br>'; 
            echo '<form action="#" method="post">
                    <input type="hidden" name="nomUtilisateur" value="' . $_POST['nomUtilisateur'] . '">
                    <select name="nomAdherentEcole">'; 
            foreach($resultatMembreEcole[0]['instances_instance'] as $row) 
            {
                echo '<option value="'.$row['numLicence'].'">'.$row['nomAdhérent'].' '.$row['prénomAdéhrent'].'</option>'; 
            }
            echo "<br>
                 <br>";
            echo '</select>
                  <input type="submit" name="choixNomAdherentEcole" value="valider">
                  </form>'; 
            echo '<br><br>'; 
        }

        // affichage de la liste des cours de l'adherent de cette école 
        if (isset($_POST['choixNomAdherentEcole']) && !(isset($_POST['ajouterAffectation'])) || isset($_POST['retourModifCours']))
        {
            echo "<h2> Voici la liste des cours suivis par ".$_POST['nomAdherentEcole']." </h2>"; 

            foreach ($resultatCours[0]['instances_instance'] as $cours)
            {
                echo "<nobr>cours : </nobr>" . $cours['libelléCours'] . "<br>";
                
                // Ajouter un bouton "Ajouter" pour chaque cours
                echo '<FORM action="#" method="post">
                            <input type="hidden" name="nomUtilisateur" value="' . $_POST['nomUtilisateur'] . '">
                            <input type="hidden" name="nomAdherentEcole" value="'.$_POST['nomAdherentEcole'].'">
                            <input type="hidden" name="idCours" value="'.$cours['code'].'">
                            <input type="submit" name="modifCours" value="Supprimer">
                        </FORM>'; 
            
                echo "<br>"; 
            }      
            echo "<br>"; 
            echo "<br>"; 
            echo '<form action="#" method="post">
                    <input type="hidden" name="nomUtilisateur" value="' . $_POST['nomUtilisateur'] . '">
                    <input type="hidden" name="nomAdherentEcole" value="'.$_POST['nomAdherentEcole'].'">
                    <input type="submit" name="ajouterAffectation" value="Ajouter une affectation de cours">
                 </form>'; 
        }

        if (isset($_POST['ajouterAffectation']))
        {
            echo "<h2> Ajouter un cours </h2>"; 
            echo "<p> Cours auxquels vous n'êtes pas encore inscrit :</p>"; 
        
            foreach ($resultatCoursPasInscrit[0]['instances_instance'] as $cours)
            {
                echo "<nobr>cours : </nobr>" . $cours['libelléCours'] . "<br>";
                
                // Ajouter un bouton "Ajouter" pour chaque cours
                echo '<FORM action="#" method="post">
                            <input type="hidden" name="nomUtilisateur" value="' . $_POST['nomUtilisateur'] . '">
                            <input type="hidden" name="nomAdherentEcole" value="'.$_POST['nomAdherentEcole'].'">
                            <input type="hidden" name="idCours" value="'.$cours['code'].'">
                            <input type="submit" name="ajouterCoursAdherent" value="Ajouter ce cours">
                        </FORM>'; 
                
                echo "<br>"; 
            }
        }

        if (isset($_POST['modifCours']))
        {
            echo "<br>"; 
            echo "<br>"; 
            echo "$messageSupp";
            echo "<br>"; 
            echo "<br>"; 
            echo '<form action="#" method="post">
                        <input type="hidden" name="nomUtilisateur" value="' . $_POST['nomUtilisateur'] . '">
                        <input type="hidden" name="nomAdherentEcole" value="'.$_POST['nomAdherentEcole'].'">
                        <input type="submit" name="retourModifCours" value="Retour">
                   </form>'; 
        }

        if (isset($_POST['ajouterCoursAdherent']))
        {
            echo "<br>"; 
            echo "<br>"; 
            echo "$messageAjout";
            echo "<br>"; 
            echo "<br>"; 
            echo '<form action="#" method="post">
                        <input type="hidden" name="nomUtilisateur" value="' . $_POST['nomUtilisateur'] . '">
                        <input type="hidden" name="nomAdherentEcole" value="'.$_POST['nomAdherentEcole'].'">
                        <input type="submit" name="retourModifCours" value="Retour">
                   </form>'; 
        }

    ?> 

</div>






			
	
