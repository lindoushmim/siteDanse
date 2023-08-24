
<div class = "vip">

    <h2 class=descriptionVIP>Vous souhaitez organiser une édition de compétition particulière, vous etes sur la bonne page ! </h2> 



    <?php

        echo '<div class = "choixFedeVIP">'; 
        if(! isset($_POST['nomFédération']))
        {
            echo '<h2>Choix de la Fédération</h2>';
            echo '<br>';
            echo '<FORM action="#" method="post">
                    <select name="nomFédération">' ;
            foreach($nomFédé[0]['instances_instance'] as $row)
            {
                echo '<option>' . $row['nomFédération'] . '</option>';
            }
            echo '</select>
                <input type="submit" name="choixFédération" value="valider">
                </FORM>';

            //echo '<img src="img/vip.png" alt="image compétition VIP" class="imageVip" />';
        }
        echo '</div>'; 


        if (isset($_POST['nomFédération']) && ! isset($_POST['limitationForm']))
        {
            echo "<p>L'objectif de cette page est de vous aider à générer automatiquement une édition VIP<p>";
            echo "<p>Pour mieux répondre à votre besoin, vous allez devoir spécifier plusieurs paramètre : <p>";
            echo "<br>";
            

            echo "<FORM action='#' method='post'>";
            echo "<input type='hidden' name='nomFédération' value='$nomF'";

            echo "<p>Quelle place doit avoir au minimum atteint les danseurs invités ?</p>";
            echo "<select name='rangMinimum'>";
            echo "<option>Pas de limitation</option>";
            for($i = 1; $i <= $rangMax[0]['instances_instance'][0]['MAX(P.rang_final)']; $i++)
            {
                echo "<option>" . $i . "</option>";
            }
            echo "</select>";

            echo "<p>Quel doit être le nombre minimum d'adhérent des écoles dont les danseurs invités proviennent ?</p>";
            echo "<select name='adhérentMinimum'>";
            echo "<option>Pas de limitation</option>";
            for($i = 1; $i <= $nbAdhérentMax[0]['instances_instance'][0]['MAX(nbParEcole)']; $i++)
            {
                echo "<option>" . $i . "</option>";
            }
            echo "</select>";

            
            echo "<br>";

            echo "<input type='submit' name='limitationForm' value='Valider' >";

            echo "</FORM>";
        }
        if (isset($_POST['nomFédération']) && isset($_POST['limitationForm']))
        {
            
            echo "<p>Voici la liste des danseurs séléctionnés</p>";
            echo "<table>
                    <thead>
                        <tr>";
                            foreach($danseursChoisis[0]['schema_instance'] as $row) {  
                    
                                echo '<th>';
                                    echo $row['nom'];
                                echo '</th>';
                    
                            }
                        
            echo       "</tr>	
                    </thead>
                    <tbody>";
                        foreach($danseursChoisis[0]['instances_instance'] as $row) {  // pour parcourir les n-uplets
                    
                        echo '<tr>';
                        foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets
                    
                            echo '<td>'. $valeur . '</td>';
                        }
                        echo '</tr>';
                    }
                
            echo	"</tbody>
                </table>";
            
            
        }

        
    ?>

</div>