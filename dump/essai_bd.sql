-- -----------------------------------------------------------------------------
--             GEnEration d'une base de donnEes pour
--                      PROGRESS 9.1
--                        (21/6/2014 15:25:06)
-- -----------------------------------------------------------------------------
--      Nom de la base : SYGEREA
--      Projet : Accueil Win'Design version 7
--      Auteur : romuald
--      Date de dernière modification : 21/6/2014 15:23:46
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
--       TABLE : LATRINE
-- -----------------------------------------------------------------------------

CREATE TABLE LATRINE
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    TYPE_LATRINE VARCHAR(50) NOT NULL ,
    NOMBRE_DE_CABINES INTEGER NOT NULL ,
    PROFONDEUR REAL NOT NULL ,
    ETAT VARCHAR(50) NOT NULL ,
    DESCRIPTION VARCHAR(50) NOT NULL ,
    NOMBRE_DE_FOSSES INTEGER NOT NULL ,
    VOLUME VARCHAR(50) NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_LATRINE PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : FORAGES_OU_PUITS
-- -----------------------------------------------------------------------------

CREATE TABLE FORAGES_OU_PUITS
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    PROFONDEUR REAL NOT NULL ,
    HAUTEUR_D_EAU REAL NOT NULL ,
    NIVEAU_STATIQUE_DE_L_EAU VARCHAR(50) NOT NULL ,
    NIVEAU_TOP_CREPINE VARCHAR(50) NOT NULL ,
    TRANSMISSIVITE VARCHAR(50) NOT NULL ,
    COEFFICIENT_D_EMMAGASINEMENT REAL NOT NULL ,
    DIAMÈTRE_DE_PERFORATION REAL NOT NULL ,
    DEBIT_D_EXPLOITATION_DEBIT_SPECI REAL NOT NULL ,
    TYPE_DE_NAPPE VARCHAR(50) NOT NULL ,
    TYPE_DE_POROSITE VARCHAR(50) NOT NULL ,
    DEBIT REAL NOT NULL ,
    PERIMÈTRE_DE_PROTECTION REAL NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_FORAGES_OU_PUITS PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : BAILLEUR
-- -----------------------------------------------------------------------------

CREATE TABLE BAILLEUR
   (
    CODE_BAILLEUR SERIAL NOT NULL ,
    DENOMINATION VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_BAILLEUR PRIMARY KEY (CODE_BAILLEUR) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : OUVRAGE
-- -----------------------------------------------------------------------------

CREATE TABLE OUVRAGE
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    CODE_ENTREPRISE INTEGER NOT NULL ,
    CODE_PROJET INTEGER NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_OUVRAGE PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE OUVRAGE
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_OUVRAGE_ENTREPRISE
     ON OUVRAGE (CODE_ENTREPRISE ASC)
     ;

CREATE  INDEX I_FK_OUVRAGE_PROJET
     ON OUVRAGE (CODE_PROJET ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : SOURCE_AMENAGEES
-- -----------------------------------------------------------------------------

CREATE TABLE SOURCE_AMENAGEES
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    PROFONDEUR REAL NOT NULL ,
    HAUTEUR_D_EAU REAL NOT NULL ,
    NIVEAU_STATIQUE_DE_L_EAU REAL NOT NULL ,
    NIVEAU_TOP_CREPINE REAL NOT NULL ,
    TRANSMISSIVITE REAL NOT NULL ,
    COEFFICIENT_D_EMMAGASINEMENT REAL NOT NULL ,
    DIAMÈTRE_DE_PERFORATION REAL NOT NULL ,
    DEBIT_D_EXPLOITATION_DEBIT_SPECI REAL NOT NULL ,
    TYPE_DE_NAPPE VARCHAR(50) NOT NULL ,
    TYPE_DE_POROSITE VARCHAR(50) NOT NULL ,
    DEBIT REAL NOT NULL ,
    PERIMÈTRE_DE_PROTECTION REAL NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_SOURCE_AMENAGEES PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : REGION
-- -----------------------------------------------------------------------------

CREATE TABLE REGION
   (
    CODE_REGION SERIAL NOT NULL ,
    LIBELLE_REGION VARCHAR(50) NOT NULL ,
    SUPERFICIE REAL NOT NULL ,
    POPULATION INTEGER NOT NULL ,
    TAUX_D_ACROISSEMENT REAL NOT NULL 
,   CONSTRAINT PK_REGION PRIMARY KEY (CODE_REGION) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : BORNES_FONTAINES
-- -----------------------------------------------------------------------------

CREATE TABLE BORNES_FONTAINES
   (
    DEBIT REAL NOT NULL ,
    CODE_BORNE_FONTAINE INTEGER NOT NULL 
,   CONSTRAINT PK_BORNES_FONTAINES PRIMARY KEY (CODE_BORNE_FONTAINE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : ARRONDISSEMENTS
-- -----------------------------------------------------------------------------

CREATE TABLE ARRONDISSEMENTS
   (
    CODE_ARRONDISSEMENT SERIAL NOT NULL ,
    CODE_DEPARTEMENT INTEGER NOT NULL ,
    LIBELLE_ARRONDISSEMENT VARCHAR(50) NOT NULL ,
    SUPERFICIE REAL NOT NULL ,
    POPULATION INTEGER NOT NULL ,
    TAUX_D_ACROISEMENT_POP REAL NOT NULL 
,   CONSTRAINT PK_ARRONDISSEMENTS PRIMARY KEY (CODE_ARRONDISSEMENT) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE ARRONDISSEMENTS
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_ARRONDISSEMENTS_DEPARTEMENT
     ON ARRONDISSEMENTS (CODE_DEPARTEMENT ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : STATION_D_EPURATION
-- -----------------------------------------------------------------------------

CREATE TABLE STATION_D_EPURATION
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    TYPE_STATION VARCHAR(50) NOT NULL ,
    NOMBRE_DE_BASINS_DE_DECANTATION INTEGER NOT NULL ,
    PROFONDEUR INTEGER NOT NULL ,
    ETAT VARCHAR(50) NOT NULL ,
    DESCRIPTION VARCHAR(50) NOT NULL ,
    LONGUEUR REAL NOT NULL ,
    LARGEUR REAL NOT NULL ,
    VOLUME VARCHAR(50) NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_STATION_D_EPURATION PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : CARATERISTIQUES_EAU
-- -----------------------------------------------------------------------------

CREATE TABLE CARATERISTIQUES_EAU
   (
    CODE_CARACTERISTIQUE SERIAL NOT NULL ,
    CODE_DE_L_OUVRAGE INTEGER NOT NULL ,
    TURBIDITE VARCHAR(50) NOT NULL ,
    TEMPERATURE REAL NOT NULL ,
    CONDUCTIVITE REAL NOT NULL ,
    MATIÈRES_ORGANIQUES VARCHAR(50) NOT NULL ,
    MINERALISATION VARCHAR(50) NOT NULL ,
    PH REAL NOT NULL ,
    EAU_TRAITEE VARCHAR(50) NOT NULL ,
    DATE_DE_PRELÈVEMENT DATE NOT NULL ,
    DATE_D_ANALYSE DATE NOT NULL ,
    SAVEUR VARCHAR(50) NOT NULL ,
    LIMPIDITE VARCHAR(50) NOT NULL ,
    K REAL NOT NULL ,
    NH4 REAL NOT NULL ,
    FE REAL NOT NULL ,
    MN REAL NOT NULL ,
    CO3 REAL NOT NULL ,
    SO4 REAL NOT NULL ,
    F REAL NOT NULL ,
    HCO3 REAL NOT NULL ,
    CO2_DISSOUS REAL NOT NULL ,
    O2_DISSOUS REAL NOT NULL ,
    SILICE REAL NOT NULL 
,   CONSTRAINT PK_CARATERISTIQUES_EAU PRIMARY KEY (CODE_CARACTERISTIQUE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE CARATERISTIQUES_EAU
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_CARATERISTIQUES_EAU_HYDRAUL
     ON CARATERISTIQUES_EAU (CODE_DE_L_OUVRAGE ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : DEPARTEMENTS
-- -----------------------------------------------------------------------------

CREATE TABLE DEPARTEMENTS
   (
    CODE_DEPARTEMENT SERIAL NOT NULL ,
    CODE_REGION INTEGER NOT NULL ,
    LIBELLE_DEPARTEMENT VARCHAR(50) NOT NULL ,
    SUPERFICIE REAL NOT NULL ,
    POPULATION INTEGER NOT NULL ,
    TAUX_D_ACROISSEMENT_POP REAL NOT NULL 
,   CONSTRAINT PK_DEPARTEMENTS PRIMARY KEY (CODE_DEPARTEMENT) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE DEPARTEMENTS
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_DEPARTEMENTS_REGION
     ON DEPARTEMENTS (CODE_REGION ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : USAGE
-- -----------------------------------------------------------------------------

CREATE TABLE USAGE
   (
    USAGE_EAU SERIAL NOT NULL 
,   CONSTRAINT PK_USAGE PRIMARY KEY (USAGE_EAU) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : ASSAINISSEMENT
-- -----------------------------------------------------------------------------

CREATE TABLE ASSAINISSEMENT
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    VOLUME VARCHAR(50) NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_ASSAINISSEMENT PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : PUISARD
-- -----------------------------------------------------------------------------

CREATE TABLE PUISARD
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    TYPE_PUISARD VARCHAR(50) NOT NULL ,
    LONGUEUR REAL NOT NULL ,
    PROFONDEUR REAL NOT NULL ,
    ETAT VARCHAR(50) NOT NULL ,
    DESCRIPTION VARCHAR(50) NOT NULL ,
    NOMBRE_DE_FOSSES INTEGER NOT NULL ,
    VOLUME VARCHAR(50) NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_PUISARD PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : SOURCES
-- -----------------------------------------------------------------------------

CREATE TABLE SOURCES
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    DEBIT REAL NOT NULL ,
    PERIMÈTRE_DE_PROTECTION REAL NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_SOURCES PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : LOCALITES
-- -----------------------------------------------------------------------------

CREATE TABLE LOCALITES
   (
    CODE_DE_LA_LOCALITE SERIAL NOT NULL ,
    CODE_ARRONDISSEMENT INTEGER NOT NULL ,
    NOM VARCHAR(50) NOT NULL ,
    LIEUDIT VARCHAR(50) NOT NULL ,
    POPULATION_RECENSEE VARCHAR(50) NOT NULL ,
    ANNEE_RECENSEMENT_POPULATION VARCHAR(50) NOT NULL ,
    TAUX_DE_CROISSANCE_DE_LA_POPULAT REAL NOT NULL ,
    NBRE_DE_MENAGES INTEGER NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONNEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    NBRE_D_ECOLE INTEGER NOT NULL ,
    NBRE_DE_CENTRE_DE_SANTE INTEGER NOT NULL ,
    NBRE_D_HOPITAUX INTEGER NOT NULL ,
    NBRE_DE_LIEUX_DE_CULTE INTEGER NOT NULL 
,   CONSTRAINT PK_LOCALITES PRIMARY KEY (CODE_DE_LA_LOCALITE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE LOCALITES
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_LOCALITES_ARRONDISSEMENTS
     ON LOCALITES (CODE_ARRONDISSEMENT ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : BAILLEUR_1
-- -----------------------------------------------------------------------------

CREATE TABLE BAILLEUR_1
   (
    CODE_BAILLEUR SERIAL NOT NULL ,
    DENOMINATION VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_BAILLEUR_1 PRIMARY KEY (CODE_BAILLEUR) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : PROJET
-- -----------------------------------------------------------------------------

CREATE TABLE PROJET
   (
    CODE_PROJET SERIAL NOT NULL ,
    LIBELLE_DU_PROJET VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_PROJET PRIMARY KEY (CODE_PROJET) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : ENTREPRISE
-- -----------------------------------------------------------------------------

CREATE TABLE ENTREPRISE
   (
    CODE_ENTREPRISE SERIAL NOT NULL ,
    NOM_DE_L_ENTREPRISE VARCHAR(50) NOT NULL ,
    TEL VARCHAR(50) NOT NULL ,
    CODE_POTAL VARCHAR(50) NOT NULL ,
    VILLE VARCHAR(50) NOT NULL ,
    EMAIL VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_ENTREPRISE PRIMARY KEY (CODE_ENTREPRISE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : STOCKAGES
-- -----------------------------------------------------------------------------

CREATE TABLE STOCKAGES
   (
    CODE_STOCKAGE SERIAL NOT NULL ,
    VOLUME_STOCKE REAL NOT NULL ,
    FORME VARCHAR(50) NOT NULL ,
    ETAT VARCHAR(50) NOT NULL ,
    COTE_RADIER VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_STOCKAGES PRIMARY KEY (CODE_STOCKAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : DISTRIBUTIONS
-- -----------------------------------------------------------------------------

CREATE TABLE DISTRIBUTIONS
   (
    CODE_DISTRIBUTION SERIAL NOT NULL ,
    LONGUEUR_DU_RESEAU REAL NOT NULL ,
    ETAT_DU_RESEAU_DE_DISTRIBUTION VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_DISTRIBUTIONS PRIMARY KEY (CODE_DISTRIBUTION) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : AEP
-- -----------------------------------------------------------------------------

CREATE TABLE AEP
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    PROFONDEUR REAL NOT NULL ,
    HAUTEUR_D_EAU REAL NOT NULL ,
    NIVEAU_STATIQUE_DE_L_EAU VARCHAR(50) NOT NULL ,
    NIVEAU_TOP_CREPINE VARCHAR(50) NOT NULL ,
    TRANSMISSIVITE VARCHAR(50) NOT NULL ,
    COEFFICIENT_D_EMMAGASINEMENT REAL NOT NULL ,
    DIAMÈTRE REAL NOT NULL ,
    DEBIT_D_EXPLOITATION_DEBIT_SPECI REAL NOT NULL ,
    TYPE_D_AEP VARCHAR(50) NOT NULL ,
    DEBIT REAL NOT NULL ,
    PERIMÈTRE_DE_PROTECTION REAL NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_AEP PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : HYDRAULIQUE
-- -----------------------------------------------------------------------------

CREATE TABLE HYDRAULIQUE
   (
    CODE_DE_L_OUVRAGE SERIAL NOT NULL ,
    DEBIT REAL NOT NULL ,
    PERIMÈTRE_DE_PROTECTION REAL NOT NULL ,
    POPULATION_DESSERVIE INTEGER NOT NULL ,
    DATE_DE_REALISATION DATE NOT NULL ,
    COORDONNEES_EN_X REAL NOT NULL ,
    COORDONEES_EN_Y REAL NOT NULL ,
    COORDONNEES_EN_Z REAL NOT NULL ,
    ETAT_DE_L_OUVRAGE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_HYDRAULIQUE PRIMARY KEY (CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       TABLE : POMPES
-- -----------------------------------------------------------------------------

CREATE TABLE POMPES
   (
    CODE_POMPE SERIAL NOT NULL ,
    CODE_DE_L_OUVRAGE INTEGER NOT NULL ,
    MARQUE_DE_LA_POMPE VARCHAR(50) NOT NULL ,
    TYPE_DE_POMPE VARCHAR(50) NOT NULL ,
    DIAMÈTRE REAL NOT NULL ,
    PROFONDEUR REAL NOT NULL ,
    DATE_D_INSTALLATION DATE NOT NULL ,
    DEBIT_NOMINAL_DE_LA_POMPE REAL NOT NULL ,
    DEBIT_MAXIMAL_DE_LA_POMPE REAL NOT NULL ,
    PUISSANCE_DE_LA_POMPE REAL NOT NULL ,
    CONSOMMATION_DE_LA_POMPE REAL NOT NULL ,
    ETAT_DE_LA_POMPE VARCHAR(50) NOT NULL 
,   CONSTRAINT PK_POMPES PRIMARY KEY (CODE_POMPE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE POMPES
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_POMPES_FORAGES_OU_PUITS
     ON POMPES (CODE_DE_L_OUVRAGE ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : PANNES
-- -----------------------------------------------------------------------------

CREATE TABLE PANNES
   (
    CODE_PANNE SERIAL NOT NULL ,
    CODE_DE_L_OUVRAGE INTEGER NOT NULL ,
    LIBELLE_PANNE VARCHAR(50) NOT NULL ,
    DATE_MISE_HORS_USAGE DATE NOT NULL 
,   CONSTRAINT PK_PANNES PRIMARY KEY (CODE_PANNE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE PANNES
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_PANNES_OUVRAGE
     ON PANNES (CODE_DE_L_OUVRAGE ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : FINANCER
-- -----------------------------------------------------------------------------

CREATE TABLE FINANCER
   (
    CODE_BAILLEUR SERIAL NOT NULL ,
    CODE_PROJET INTEGER NOT NULL ,
    ANNEE_FINANCEMENT INTEGER NOT NULL ,
    MONTANT_FINANCEMENT INTEGER NOT NULL 
,   CONSTRAINT PK_FINANCER PRIMARY KEY (CODE_BAILLEUR, CODE_PROJET) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE FINANCER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_FINANCER_BAILLEUR
     ON FINANCER (CODE_BAILLEUR ASC)
     ;

CREATE  INDEX I_FK_FINANCER_PROJET
     ON FINANCER (CODE_PROJET ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : APPARTENIR
-- -----------------------------------------------------------------------------

CREATE TABLE APPARTENIR
   (
    CODE_DE_L_OUVRAGE INTEGER NOT NULL ,
    CODE_DE_LA_LOCALITE INTEGER NOT NULL 
,   CONSTRAINT PK_APPARTENIR PRIMARY KEY (CODE_DE_L_OUVRAGE, CODE_DE_LA_LOCALITE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE APPARTENIR
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_APPARTENIR_OUVRAGE
     ON APPARTENIR (CODE_DE_L_OUVRAGE ASC)
     ;

CREATE  INDEX I_FK_APPARTENIR_LOCALITES
     ON APPARTENIR (CODE_DE_LA_LOCALITE ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : AVOIR
-- -----------------------------------------------------------------------------

CREATE TABLE AVOIR
   (
    USAGE_EAU VARCHAR(50) NOT NULL ,
    CODE_DE_L_OUVRAGE INTEGER NOT NULL 
,   CONSTRAINT PK_AVOIR PRIMARY KEY (USAGE_EAU, CODE_DE_L_OUVRAGE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE AVOIR
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_AVOIR_USAGE
     ON AVOIR (USAGE_EAU ASC)
     ;

CREATE  INDEX I_FK_AVOIR_HYDRAULIQUE
     ON AVOIR (CODE_DE_L_OUVRAGE ASC)
     ;

-- -----------------------------------------------------------------------------
--       TABLE : REHABILITER
-- -----------------------------------------------------------------------------

CREATE TABLE REHABILITER
   (
    CODE_DE_L_OUVRAGE INTEGER NOT NULL ,
    CODE_ENTREPRISE INTEGER NOT NULL ,
    DATE_DE_REHABILITATION VARCHAR(50) NOT NULL ,
    DURREE_DE_REHABILITATION REAL NOT NULL ,
    COUT_REHABILITATION REAL NOT NULL 
,   CONSTRAINT PK_REHABILITER PRIMARY KEY (CODE_DE_L_OUVRAGE, CODE_ENTREPRISE) 
   );
-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE REHABILITER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_REHABILITER_OUVRAGE
     ON REHABILITER (CODE_DE_L_OUVRAGE ASC)
     ;

CREATE  INDEX I_FK_REHABILITER_ENTREPRISE
     ON REHABILITER (CODE_ENTREPRISE ASC)
     ;



-- -----------------------------------------------------------------------------
--                FIN DE GENERATION
-- -----------------------------------------------------------------------------