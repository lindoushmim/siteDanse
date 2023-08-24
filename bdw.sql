-- SUPRESSION DES TABLES --

DROP TABLE IF EXISTS influence;

DROP TABLE IF EXISTS utilise;

DROP TABLE IF EXISTS forme;

DROP TABLE IF EXISTS participe;

DROP TABLE IF EXISTS organise;

DROP TABLE IF EXISTS est_rattaché;

DROP TABLE IF EXISTS a_participé;

DROP TABLE IF EXISTS est_inscrit;

DROP TABLE IF EXISTS suit;

DROP TABLE IF EXISTS delivre;

DROP TABLE IF EXISTS travaille;

DROP TABLE IF EXISTS Vestiaire;

DROP TABLE IF EXISTS Espace_De_Danse;

DROP TABLE IF EXISTS Salle;

DROP TABLE IF EXISTS Ecole_De_Danse;

DROP TABLE IF EXISTS Danse;

DROP TABLE IF EXISTS Edition;

DROP TABLE IF EXISTS Groupe_De_Danse;

DROP TABLE IF EXISTS Structure_Sportive;

DROP TABLE IF EXISTS Compétition;

DROP TABLE IF EXISTS ComiteDepartemental;

DROP TABLE IF EXISTS ComiteRegional;

DROP TABLE IF EXISTS Comite;

DROP TABLE IF EXISTS Fédération;

DROP TABLE IF EXISTS Séance;

DROP TABLE IF EXISTS Adhérent;

DROP TABLE IF EXISTS Cours_Eveil_A_La_Danse;

DROP TABLE IF EXISTS Cours_De_Danse;

DROP TABLE IF EXISTS Cours_De_Zumba;

DROP TABLE IF EXISTS Cours;

DROP TABLE IF EXISTS Période;

DROP TABLE IF EXISTS Employé;

DROP TABLE IF EXISTS Adresse;




-- CREATION DES TABLES -- 

CREATE TABLE Adresse
(
   idAdresse INT AUTO_INCREMENT, 
   numVoie INT,
   nomRue VARCHAR(50),
   complementRue VARCHAR(50),
   numCodex INT,
   boitePostal VARCHAR(50),
   codePostal VARCHAR(100),
   nomVille VARCHAR(50),
   nomPays VARCHAR(50),
   PRIMARY KEY(idAdresse)
);

CREATE TABLE Employé
(
   idEmployé INT AUTO_INCREMENT,
   nomEmployé VARCHAR(50),
   prénomEmployé VARCHAR(50),
   PRIMARY KEY(idEmployé)
);

CREATE TABLE Période
(
   année VARCHAR(50),
   PRIMARY KEY(année)
);

CREATE TABLE Cours
(
   code INT AUTO_INCREMENT,
   libelléCours VARCHAR(50),
   categorieAge VARCHAR(50),
   PRIMARY KEY(code)
);

CREATE TABLE Cours_De_Zumba
(
   code INT AUTO_INCREMENT,
   ambiance VARCHAR(50),
   PRIMARY KEY(code),
   FOREIGN KEY(code) REFERENCES Cours(code)
);

CREATE TABLE Cours_De_Danse
(
   code INT AUTO_INCREMENT,
   catégorie VARCHAR(50),
   PRIMARY KEY(code),
   FOREIGN KEY(code) REFERENCES Cours(code)
);

CREATE TABLE Cours_Eveil_A_La_Danse
(
   code INT AUTO_INCREMENT,
   PRIMARY KEY(code),
   FOREIGN KEY(code) REFERENCES Cours(code)
);

CREATE TABLE Adhérent
(
   numLicence INT,
   nomAdhérent VARCHAR(50),
   prénomAdéhrent VARCHAR(50),
   dateNaissance VARCHAR(50),
   dateIncsription VARCHAR(80), 
   idAdresse INT NOT NULL,
   PRIMARY KEY(numLicence),
   FOREIGN KEY(idAdresse) REFERENCES Adresse(idAdresse)
);

CREATE TABLE Séance
(
   code INT,
   numSéance INT,
   jour VARCHAR(50),
   créneauHoraire VARCHAR(50),
   PRIMARY KEY(code, numSéance),
   FOREIGN KEY(code) REFERENCES Cours(code)
);

CREATE TABLE Fédération
(
   idFédération INT AUTO_INCREMENT,
	nomFédération VARCHAR(50),
	sigleFédération VARCHAR(50),
	présidentFédération VARCHAR(50),
	idAdresse INT NOT NULL, 
	PRIMARY KEY(idFédération), 
	FOREIGN KEY(idAdresse) REFERENCES Adresse(idAdresse)
);

CREATE TABLE Comite
(
   idComité INT AUTO_INCREMENT, 
   nomComité VARCHAR(100), 
   niveauComité VARCHAR(50), 
   idFédération INT ,
   idComité_1 INT ,
   PRIMARY KEY(idComité), 
   FOREIGN KEY(idFédération) REFERENCES Fédération(idFédération),
   FOREIGN KEY(idComité_1) REFERENCES Comite(idComité)
);


CREATE TABLE Compétition
(
   codeCompétition VARCHAR(50),
   libelléCompétition VARCHAR(50),
   niveauCompétition VARCHAR(50),
   idFédération INT NOT NULL,
   PRIMARY KEY(codeCompétition),
   FOREIGN KEY(idFédération) REFERENCES Fédération(idFédération)
);

CREATE TABLE Structure_Sportive
(
   idStructure INT AUTO_INCREMENT,
   nomStructure VARCHAR(50),
   typeStructure VARCHAR(50),
   idAdresse INT NOT NULL,
   PRIMARY KEY(idStructure),
   FOREIGN KEY(idAdresse) REFERENCES Adresse(idAdresse)
);

CREATE TABLE Groupe_De_Danse
(
   idGroupe INT AUTO_INCREMENT,
   nomGroupe VARCHAR(50),
   genreGroupe VARCHAR(50),
   numLicence1 INT,
   numLicence2 INT,
   PRIMARY KEY(idGroupe),
   FOREIGN KEY(numLicence1) REFERENCES Adhérent(numLicence),
   FOREIGN KEY(numLicence2) REFERENCES Adhérent(numLicence)
);

CREATE TABLE Edition
(
   codeCompétition VARCHAR(50),
   année INT,
   ville_organisatrice VARCHAR(50),
   idStructure INT NULL,
   PRIMARY KEY(codeCompétition, année),
   FOREIGN KEY(codeCompétition) REFERENCES Compétition(codeCompétition),
   FOREIGN KEY(idStructure) REFERENCES Structure_Sportive(idStructure)
);

CREATE TABLE Danse
(
   type_dance VARCHAR(50),
   PRIMARY KEY(type_dance)
);

CREATE TABLE Ecole_De_Danse
(
   idEcole INT AUTO_INCREMENT,
   nomEcole VARCHAR(50),
   nomsFondateurs VARCHAR(50),
   idAdresse INT NOT NULL,
   idFédération INT,
   PRIMARY KEY(idEcole),
   FOREIGN KEY(idAdresse) REFERENCES Adresse(idAdresse),
   FOREIGN KEY(idFédération) REFERENCES Fédération(idFédération)
);

CREATE TABLE Salle
(
   idEcole INT,
   numSalle INT,
   nomSalle VARCHAR(50),
   superficieSalle VARCHAR(50),
   PRIMARY KEY(idEcole, numSalle),
   FOREIGN KEY(idEcole) REFERENCES Ecole_De_Danse(idEcole)
);

CREATE TABLE Espace_De_Danse
(
   idEcole INT,
   numSalle INT,
   typeAeration VARCHAR(50),
   typeChauffage VARCHAR(50),
   PRIMARY KEY(idEcole, numSalle),
   FOREIGN KEY(idEcole, numSalle) REFERENCES Salle(idEcole, numSalle)
);

CREATE TABLE Vestiaire
(
   idEcole INT,
   numSalle INT,
   mixte VARCHAR(50),
   douches VARCHAR(50),
   PRIMARY KEY(idEcole, numSalle),
   FOREIGN KEY(idEcole, numSalle) REFERENCES Salle(idEcole, numSalle)
);

CREATE TABLE travaille
(
   idEcole INT,
   idEmployé INT,
   année VARCHAR(50),
   fonction VARCHAR(50),
   PRIMARY KEY(idEcole, idEmployé, année),
   FOREIGN KEY(idEcole) REFERENCES Ecole_De_Danse(idEcole),
   FOREIGN KEY(idEmployé) REFERENCES Employé(idEmployé),
   FOREIGN KEY(année) REFERENCES Période(année)
);

CREATE TABLE delivre
(
   idEcole INT,
   idEmployé INT,
   code INT,
   PRIMARY KEY(idEcole, idEmployé, code),
   FOREIGN KEY(idEcole) REFERENCES Ecole_De_Danse(idEcole),
   FOREIGN KEY(idEmployé) REFERENCES Employé(idEmployé),
   FOREIGN KEY(code) REFERENCES Cours(code)
);

CREATE TABLE est_inscrit
(
   idEcole INT,
   numLicence INT,
   PRIMARY KEY(idEcole, numLicence),
   FOREIGN KEY(idEcole) REFERENCES Ecole_De_Danse(idEcole),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence)
);

CREATE TABLE suit
(
   code INT,
   numLicence INT,
   PRIMARY KEY(code, numLicence),
   FOREIGN KEY(code) REFERENCES Cours(code),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence)
);

CREATE TABLE a_participé
(
   numLicence INT,
   code INT,
   numSéance INT,
   PRIMARY KEY(numLicence, code, numSéance),
   FOREIGN KEY(numLicence) REFERENCES Adhérent(numLicence),
   FOREIGN KEY(code, numSéance) REFERENCES Séance(code, numSéance)
);

CREATE TABLE organise
(
   idComité INT,
   codeCompétition VARCHAR(50),
   année INT,
   PRIMARY KEY(idComité, codeCompétition, année),
   FOREIGN KEY(idComité) REFERENCES Comite(idComité),
   FOREIGN KEY(codeCompétition, année) REFERENCES Edition(codeCompétition, année)
);

CREATE TABLE participe
(
   idGroupe INT,
   codeCompétition VARCHAR(50),
   année INT,
   numéro_passage INT,
   rang_final INT,
   PRIMARY KEY(idGroupe, codeCompétition, année),
   FOREIGN KEY(idGroupe) REFERENCES Groupe_De_Danse(idGroupe),
   FOREIGN KEY(codeCompétition, année) REFERENCES Edition(codeCompétition, année)
);



CREATE TABLE utilise
(
   code INT,
   type_dance VARCHAR(50),
   PRIMARY KEY(code, type_dance),
   FOREIGN KEY(code) REFERENCES Cours_De_Danse(code),
   FOREIGN KEY(type_dance) REFERENCES Danse(type_dance)
);

CREATE TABLE influence(
   type_dance VARCHAR(50),
   type_dance_1 VARCHAR(50),
   PRIMARY KEY(type_dance, type_dance_1),
   FOREIGN KEY(type_dance) REFERENCES Danse(type_dance),
   FOREIGN KEY(type_dance_1) REFERENCES Danse(type_dance)
);



-- partie concernant le peuplage des tables -------------------------------------------------------


-- table ADRESSE --------------------

-- changer le codePostal en VARCHAR 

INSERT INTO Adresse (numVoie, nomRue, codePostal, nomVille)
SELECT DISTINCT adr_danseur_numVoie, adr_danseur_rue, adr_danseur_cp, adr_danseur_ville
FROM donnees_fournies.instances4;

INSERT INTO Adresse (numVoie, nomRue, codePostal, nomVille)
SELECT DISTINCT adr_ecole_numVoie, adr_ecole_rue, adr_ecole_cp, adr_ecole_ville
FROM donnees_fournies.instances3;

INSERT INTO Adresse (numVoie, nomRue, codePostal, nomVille)
SELECT DISTINCT adr_fede_numVoie, adr_fede_rue, adr_fede_cp, adr_fede_ville
FROM donnees_fournies.instances1; 


-- table ADHÉRENT --------------------

-- supprimer l'attribut adresseAdherent -- ALTER TABLE Adhérent DROP COLUMN adresseAdhérent;

INSERT INTO Adhérent (numLicence, nomAdhérent, prénomAdéhrent, dateNaissance, dateIncsription, idAdresse)
SELECT A4.danseur_numLicence, A4.danseur_nom, A4.danseur_prenom, A4.danseur_date_naissance, A4.annee_inscription, Adresse.idAdresse
FROM donnees_fournies.instances4 AS A4 JOIN Adresse
ON A4.adr_danseur_numVoie = Adresse.numVoie 
AND A4.adr_danseur_rue = Adresse.nomRue 
AND A4.adr_danseur_cp = Adresse.codePostal
AND A4.adr_danseur_ville = Adresse.nomVille; 



-- table FÉDÉRATION ------------------
/*
INSERT INTO Fédération (nomFédération, sigleFédération, présidentFédération)
SELECT DISTINCT fede_nom, fede_sigle, fede_dirigeant 
FROM donnees_fournies.instances3 ;
*/

INSERT INTO Fédération (nomFédération, sigleFédération, présidentFédération, idAdresse)
SELECT DISTINCT I3.fede_nom, I3.fede_sigle, I3.fede_dirigeant, A.idAdresse 
FROM donnees_fournies.instances3 I3 JOIN donnees_fournies.instances1 AS I1
ON I3.fede_nom = I1.fede_nom
AND I3.fede_sigle = I1.fede_sigle
AND I3.fede_dirigeant = I1.fede_dirigeant
JOIN Adresse AS A ON I1.adr_fede_numVoie = A.numVoie
AND I1.adr_fede_rue = A.nomRue
AND I1.adr_fede_cp = A.codePostal
AND I1.adr_fede_ville = A.nomVille ;

-- table ECOLE ----------------------

INSERT INTO Ecole_De_Danse (nomEcole, nomsFondateurs,idAdresse,idFédération)
SELECT DISTINCT A3.ecole_nom, ecole_fondateur, Adresse.idAdresse,1
FROM donnees_fournies.instances3 AS A3 JOIN Adresse
ON A3.adr_ecole_numVoie = Adresse.numVoie 
AND A3.adr_ecole_rue = Adresse.nomRue 
AND A3.adr_ecole_cp = Adresse.codePostal
AND A3.adr_ecole_ville = Adresse.nomVille; 


-- table COURS -----------------------

INSERT INTO Cours (libelléCours, categorieAge)
SELECT DISTINCT cours_libellé, cours_categorie_age 
FROM donnees_fournies.instances3 ;


-- table EMPLOYÉ --------------------

INSERT INTO Employé (nomEmployé, prénomEmployé)
SELECT DISTINCT cours_resp_nom, cours_resp_prénom 
From donnees_fournies.instances3 ;


-- table COMPÉTITION ---------------------

INSERT INTO Compétition (codeCompétition, libelléCompétition, niveauCompétition, idFédération)
SELECT DISTINCT A2.compet_code, A2.compet_libellé, A2.compet_niveau, Fédération.idFédération
FROM donnees_fournies.instances2 AS A2 JOIN Fédération
ON A2.fede_nom = Fédération.nomFédération
AND A2.fede_sigle = Fédération.sigleFédération
AND A2.fede_dirigeant = Fédération.présidentFédération ; 



-- table EDITION ------------------------


INSERT INTO Edition (codeCompétition, année, ville_organisatrice) 
SELECT DISTINCT Compétition.codeCompétition, A2.edition_année, A2.edition_ville_orga 
FROM donnees_fournies.instances2 AS A2 JOIN Compétition 
ON A2.compet_code = Compétition.codeCompétition 
AND A2.compet_libellé = Compétition.libelléCompétition
AND A2.compet_niveau = Compétition.niveauCompétition ; 


-- table Groupe_De_Danse -------------------

-- pas finit 

INSERT INTO Groupe_De_Danse (numLicence1,numLicence2)
SELECT DISTINCT I2.danseur_numLicence1,I2.danseur_numLicence2
FROM donnees_fournies.instances2 I2
;



-- table COMITE ----------------

INSERT INTO Comite (niveauComité,nomComité,idFédération)
SELECT DISTINCT(I.comite_dept_niveau),I.comite_dept_nom, F.idFédération
FROM donnees_fournies.instances1 I , Fédération F
WHERE I.comite_dept_niveau = 'reg'
;

INSERT INTO Comite (niveauComité,nomComité,idFédération,idComité_1)
SELECT DISTINCT I.comite_dept_niveau,I.comite_dept_nom,1, C.idComité
FROM donnees_fournies.instances1 I , Comite C
WHERE I.comite_dept_niveau = 'dept'
AND C.nomComité = I.comite_reg_nom
;



--  table est_inscrit ------------

INSERT INTO est_inscrit (idEcole, numLicence)
SELECT DISTINCT C.idEcole, A.numLicence
FROM Adhérent A 
JOIN donnees_fournies.instances4 I4 ON I4.danseur_numLicence = A.numLicence
JOIN Ecole_De_Danse C ON C.nomEcole = I4.ecole_nom;


--  table suit -------------------

-- fait toutes les combinaisons possible entre les cours que peux avoir un adherents (soit 8) puis apres en selectionne  avec une proba definit à 0.3
-- on insere ca dans la base de données 
INSERT INTO suit (code, numLicence)
SELECT code, numLicence
FROM (
    SELECT Adhérent.numLicence, Cours.code
    FROM Adhérent, Cours
    WHERE Adhérent.numLicence BETWEEN 2022001 AND 2022400
) AS Combinations
WHERE RAND() < 0.5;


-- table delivre --------------------------

INSERT INTO delivre (idEcole, idEmployé, code)
SELECT DISTINCT E.idEcole, TR.idEmployé, C.code
FROM Ecole_De_Danse E 
JOIN donnees_fournies.instances3 I3 ON I3.ecole_nom = E.nomEcole AND I3.ecole_fondateur = E.nomsFondateurs
JOIN Employé TR ON TR.nomEmployé = I3.cours_resp_nom AND TR.prénomEmployé = I3.cours_resp_prénom
JOIN Cours C ON C.libelléCours = I3.cours_libellé AND C.categorieAge = I3.cours_categorie_age; 



-- table organise ---------------------------                           pas d'info


-- table participe -------------------------

INSERT INTO participe (idGroupe,codeCompétition,année,rang_final)
SELECT DISTINCT G.idGroupe, E.codeCompétition, E.année, I2.rang_final
FROM Groupe_De_Danse G, Edition E , donnees_fournies.instances2 I2
WHERE G.numLicence1 = I2.danseur_numLicence1 AND G.numLicence2 = I2.danseur_numLicence2
AND E.année = I2.edition_année AND E.ville_organisatrice = I2.edition_ville_orga
AND E.codeCompétition = I2.compet_code
;


UPDATE Compétition
SET libelléCompétition = REPLACE(libelléCompétition, '  ', ' ') ;

-- à faire

-- utilise --------------------------------

-- influence ------------------------------



-- PARTIE SUR LES REQUETES ---------------
/*
SELECT COUNT(F.idFédération) AS nbFed FROM Fédération F

SELECT COUNT(C.codeComité) AS nbCR FROM ComiteRegional C

SELECT COUNT(idComitéDép) AS nbFed FROM ComiteDepartemental C 


SELECT LEFT(A.codePostal, 2) AS codeDept, COUNT(E.idEcole) AS nbEcoles
FROM Ecole_De_Danse E
JOIN Adresse A ON A.idAdresse = E.idAdresse
WHERE A.codePostal NOT LIKE '97%'
GROUP BY codeDept
UNION
SELECT LEFT(A.codePostal, 3) AS codeDept, COUNT(E.idEcole) AS nbEcoles
FROM Ecole_De_Danse E
JOIN Adresse A ON A.idAdresse = E.idAdresse
WHERE A.codePostal LIKE '97%'
GROUP BY codeDept;


SELECT nomComité
FROM ComiteRegional CR
JOIN Fédération F ON CR.idFédération = F.idFédération
WHERE F.nomFédération = 'Fédération Française de Danse'  
ORDER BY CR.nomComité DESC;


SELECT E.nomEcole, A.nomVille, COUNT(DISTINCT AD.numLicence) AS nbAdhérent
FROM Ecole_De_Danse E
JOIN Adresse A ON E.idAdresse = A.idAdresse
JOIN suit I ON I.code = E.idEcole
JOIN Adhérent AD ON I.numLicence = AD.numLicence
WHERE YEAR(AD.dateIncsription) = 2022
GROUP BY E.idEcole
ORDER BY nbAdhérent DESC
LIMIT 5;
*/
