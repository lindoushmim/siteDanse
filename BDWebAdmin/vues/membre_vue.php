
<div class="pageMembre">

    <div class="membre"> 
         
        <?php 

            if (!(isset($_POST["boutonAfficherMembre"])) && !(isset($_POST["boutonAjouterNouveauMenbre"])) 
            && !(isset($_POST["retourModifInfoAdherent"])) && !(isset($_POST["boutonAfficherEmploye"]))
            && !(isset($_POST["boutonAjouterNouveauEmployé"])) 
            && !(isset($_POST["boutonModifInfoEmployé"])) && !(isset($_POST["boutonModifInfoMembre"]))
            && !(isset($_POST['retourModifMembre'])) && !(isset($_POST['validerNouveauMembre']))
            && !(isset($_POST['retourModifEmployé'])) && !(isset($_POST['validerNouveauEmployé'])))
             
            {
                echo '<h2> Sur cette page vous avez acces à tous les membre </h2>'; 
                    
                //echo '<br>';
                echo '<br>';

                // affiche les employé
                echo '<form class="bloc_feder" method="post" action="index.php?f=tdb_feder&p=membre">';	
                echo '<h3>Voici tous les employés</h3>'; 
                echo '<select name="idEmploye" id="idEmploye">';
                    foreach($resultatEmploye[0]['instances_instance'] as $emp) 
                    {
                        echo '<option value="' . $emp['idEmployé'] . '">' . $emp['nomEmployé'] . ' ' . $emp['prénomEmployé'] . '</option>';
                    }
                echo '</select>';
                echo '<input type="submit" name="boutonAfficherEmploye" value="Afficher"/>';
    
                echo '<br>';
                echo '<br>';
                
                // affiche les adherents 
                echo '<h3> Voici tous les adherents </h3>';
                
                    echo '<select name="idAdherent" id="idAdherent">';
                    foreach($resultatfeder[0]['instances_instance'] as $t) 
                    {
                        echo '<option value="' . $t['numLicence'] . '">' . $t['nomAdhérent'] . ' ' . $t['prénomAdéhrent'] . '</option>';
                    }
                    echo '</select>';

                    echo '<br>';
                    echo '<br>';

                    echo '<input type="submit" name="boutonAfficherMembre" value="Afficher"/>';

                    echo '<br>';
                    echo '<br>';          
                    echo '<br>';
                    echo '<br>';
                    
                    // partie pour pouvoir ajouter un nouveau memebre et nouveau adheent 
                    echo '<h2>Vous avez la possibilité d\'ajouter un membre</h2>';

                    echo '<br>';
                    echo '<br>';

                    echo '<input type="submit" name="boutonAjouterNouveauMenbre" value="Ajouter membre"/>';

                    echo '<br>';
                    echo '<br>';
                    echo '<br>';

                    echo '<input type="submit" name="boutonAjouterNouveauEmployé" value="Ajouter employé"/>';
                echo '</form>';

                echo '<br>';
                echo '<br>';
                echo '<br>';
                
            }
        ?> 
    </div>

      
    <!--  section pour afficher les infos du membre -->
    <div class="infoMembre">

        <?php   
            if (isset($resultatMembre[0]['instances_instance'])) 
            {
                $tab = $resultatMembre[0]['instances_instance'][0];         

                if ((isset($_POST["boutonAfficherMembre"]))||(isset($_POST['validerNouveauMembre']))||(isset($_POST['retourModifMembre'])))
                {
                    echo "<h2>Info sur le membre :</h2>"; 
                    echo " <nobr> Nom de l'adhérent : </nobr>" . $tab['nomAdhérent'];

                    echo '<br>';
                    echo '<br>';

                    echo " <nobr> Prénom de l'adhérent : </nobr>" . $tab['prénomAdéhrent'];

                    echo '<br>';
                    echo '<br>';

                    echo '<form action="#" method="post">';
                        echo '<input type="hidden" name="idAdherent" value="' . $idAdherent . '">';
                        echo '<input type="submit" name="boutonModifInfoMembre" value="Modifier">';
                    echo '</form>';

                    echo '<br>';
                    echo '<br>';

                    echo '<FORM action="#" method="post">
                            <input type="submit" name="retourAffichageMembre" value="Retour">
                          </FORM>';
                }
            }
        ?>

    </div>

    <!--  section pour modifier les infos du membre -->
    <div class="modifierInfoMembre">

        <?php  
            if ((isset($_POST["boutonModifInfoMembre"])))
            {
                if(isset($_POST['idAdherent'])) 
                {
                    $idAdherent = $_POST['idAdherent'];

                    echo '<form action="#" method="post">';
                        echo '<input type="hidden" name="idAdherent" value="' . $idAdherent . '">';
                        echo 'Nouveau prénom de l\'adhérent : <input type="text" name="nouveauPrenom"><br>';
                        echo 'Nouveau nom de l\'adhérent : <input type="text" name="nouveauNom"><br>';
                        echo '<input type="submit" name="validerNouveauMembre" value="Valider">';
                    echo '</form>';

                    echo '<br>';
                    echo '<br>';

                    echo '<FORM action="#" method="post">
                            <input type="hidden" name="idAdherent" value="' . $idAdherent . '">
                            <input type="submit" name="retourModifMembre" value="Retour">
                          </FORM>';
                } 
                else 
                {
                    echo 'Erreur : ID d\'adhérent non défini.';
                }
            }
        ?>

   



    <!--  section pour ajouter un adherent  -->
    <div class="ajoutMembre">

        <?php
            if (isset($_POST["boutonAjouterNouveauMenbre"]))
            {
                echo '<h2>Ajouter un nouveau membre</h2>'; 

                echo '<form action="#" method="post">

                        <h3> Ses infos sont : </h3>

                        <label for="nomAdherent">Nom de l\'adhérent :</label> 
                        <input type="text" id="nouveauNomAdherent" name="nomAdherent" >

                        <br>

                        <label for="prenomAdherent">Prénom de l\'adhérent :</label> 
                        <input type="text" id="nouveauPrenomAdherent" name="prenomAdherent">

                        <br>

                        <label for="numLicence">Nouveau numéro de Licence de l\'adhérent :</label> 
                        <input type="text" id="nouveauNumLicence" name="numLicence">

                        <br>
                        <br>

                        <h3> son adresse est </h3>

                        <label for="numVoie">Numero de la voie de l\'adresse de l\'adhérent:</label>
                        <input type="text" id="nouvelleAdresse" name="numVoie">

                        <br>

                        <label for="numRue">Nom de la rue de l\'adresse de l\'adhérent:</label> 
                        <input type="text" id="nouveauRue" name="numRue">

                        <br>

                        <label for="nomVille">Nom de la ville de l\'adresse de l\'adhérent:</label> 
                        <input type="text" id="nouveauVille" name="nomVille">

                        <br>
                        <br>
                        
                        <input type="submit" name="boutonValiderAjouterMembre" value="Valider">
                    </form>'; 

                echo '<br>';

                echo '<FORM action="#" method="post">
                        <input type="submit" name="retourAjoutMembre" value="Retour">
                      </FORM>';
            } 
        ?>

    </div>

          
    <!--  section pour afficher les infos de l'employé -->
    <div class="infoEmployer">

        <?php   
            if (isset($resultatInfoEmploye[0]['instances_instance'])) 
            {
                $tabemp = $resultatInfoEmploye[0]['instances_instance'][0];         

                if ((isset($_POST["boutonAfficherEmploye"]))||(isset($_POST['retourModifEmployé']))||(isset($_POST['validerNouveauEmploye'])))
                {
                    echo "<h2>Info sur l'employé :</h2>"; 
                    echo " <nobr> Nom de l'employé: </nobr>" . $tabemp['nomEmployé'];

                    echo '<br>';
                    echo '<br>';

                    echo " <nobr> Prénom de l'employé : </nobr>" . $tabemp['prénomEmployé'];

                    echo '<br>';
                    echo '<br>';

                    echo '<form action="#" method="post">';
                        echo '<input type="hidden" name="idEmploye" value="' . $idEmploye . '">';
                        echo '<input type="submit" name="boutonModifInfoEmployé" value="Modifier">';
                    echo '</form>';

                    echo '<br>';
                    echo '<br>';

                    echo '<FORM action="#" method="post">
                            <input type="submit" name="retourAffichageEmployé" value="Retour">
                          </FORM>';
                }
            }
        ?>

    </div>

    <!--  section pour modifier les infos de l employé -->
    <div class="modifierInfoEmploye">

        <?php  

            if (isset($_POST["boutonModifInfoEmployé"])) 
            {
                if(isset($_POST['idEmploye'])) 
                {
                    $idEmploye = $_POST['idEmploye'];

                    echo '<form action="#" method="post">';
                            echo '<input type="hidden" name="idEmploye" value="' . $idEmploye . '">';
                            echo 'Nouveau prénom de l\'employé : <input type="text" name="nouveauPrenomEmp"><br>';
                            echo 'Nouveau nom de l\'employé: <input type="text" name="nouveauNomEmp"><br>';
                            echo '<input type="submit" name="validerNouveauEmploye" value="Valider">';
                    echo '</form>';

                    echo '<br>';
                    echo '<br>';

                    echo '<FORM action="#" method="post">
                            <input type="hidden" name="idEmploye" value="' . $idEmploye . '">
                            <input type="submit" name="retourModifEmployé" value="Retour">
                          </FORM>';
                } 
                else 
                {
                    echo 'Erreur : ID d\'employé non défini.';
                }
            }

        ?>
    </div>

    <!--  section pour ajouter un employé  -->
    <div class="ajoutEmploye">

        <?php
            if (isset($_POST["boutonAjouterNouveauEmployé"]))
            {
                echo '<h2>Ajouter un nouveau employé</h2>'; 

                echo '<form action="#" method="post">

                        <h3> Ses infos sont : </h3>

                        <label for="nomEmploye">Nom du nouveau employé :</label> 
                        <input type="text" id="nouveauNomEmployé" name="nomEmploye" >

                        <br>

                        <label for="prenomEmploye">Prénom du nouveau employé :</label> 
                        <input type="text" id="nouveauPrenomEmploye" name="prenomEmploye">

                        <br>
                        <br>

                        <input type="submit" name="boutonValiderAjouterEmploye" value="Valider">
                    </form>'; 

                echo '<br>';

                echo '<FORM action="#" method="post">
                        <input type="submit" name="retourAjoutEmployé" value="Retour">
                      </FORM>';
            } 
        ?>

    </div>




</div>

