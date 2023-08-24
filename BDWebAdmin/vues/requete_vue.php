<div class="panneau">
    <div class="bloc_requete">
        <form method="post" action="#">
            <label>entrer la requete sql</label>
            <br>
            <textarea name="texte_requete"></textarea>
            <br>
            <input type="submit" name="boutonExecuter" value="Exécuter">
        </form>
        
        <div>
            <?php if( isset($resultat) ){
                
                //if( is_array($resultats[1]) ){ 
            ?>
            <p> Schema </p>
            <table class="table_resultat">
                    <thead>
                        <tr>
                        <?php
                            //var_dump($resultats);
                            foreach($resultat[1]['schema_schema'] as $att) {  // pour parcourir les attributs
                    
                                echo '<th>';
                                    echo $att['nom'];
                                echo '</th>';
                    
                            }
                        ?>	
                        </tr>	
                    </thead>
                    <tbody>

                    <?php
                        foreach($resultat[1]['instances_schema'] as $row) {  // pour parcourir les n-uplets
                    
                        echo '<tr>';
                        foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets
                    
                            echo '<td>'. $valeur . '</td>';
                        }
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
            
            <p> Instance </p>
            <table class="table_resultat">
                    <thead>
                        <tr>
                        <?php
                            //var_dump($resultats);
                            foreach($resultat[0]['schema_instance'] as $att) {  // pour parcourir les attributs
                    
                                echo '<th>';
                                    echo $att['nom'];
                                echo '</th>';
                    
                            }
                        ?>	
                        </tr>	
                    </thead>
                    <tbody>

                    <?php
                        foreach($resultat[0]['instances_instance'] as $row) {  // pour parcourir les n-uplets
                    
                        echo '<tr>';
                        foreach($row as $valeur) { // pour parcourir chaque valeur de n-uplets
                    
                            echo '<td>'. $valeur . '</td>';
                        }
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
            
            <?php }else{ ?>

                <p class="notification"><?= $message_requete  ?></p>	

            <?php }
        //}
        ?>
        </div>
    </div>
            </div>