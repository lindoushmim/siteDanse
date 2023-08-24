

<? php 

    // partie pour récuperer les données 

    $user = 'nom_utilisateur'; 
    $mdp = 'mot_de_passe'; 
    $machine = 'localhost'; 
    $bd = 'une_bd'; 

    $connexion = mysqli_connect($machine, $user, $mdp, $bd); // se connecte là où est stocké la base de donnée 

    if (mysqli_connect_errno())
        printf("Échec de la connexion : %s", mysqli_connect_errno())


    // pour le nombre de federation 

    $req = "SELECT COUNT(DISTINCT fede_nom) FROM Fédération;";
    $resultat = mysqli_query($connexion,$req); 

    if ($resultat==FALSE)
    {
        echo"<p>Erreur : Requete non exécutée !</p>"; 
        exit(); 
    }
    else 
    {
        $nb_fede = $resultat; 
    }

    // permet l'affichage du nombre de fédération 

    <p> Nombre de fédérations : echo $resultat; </p>



?> 