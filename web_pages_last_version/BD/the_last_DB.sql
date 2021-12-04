-- #Création du schéma de tables
CREATE SCHEMA w_gene;
--#SET SCHEMA 'w_gene';
SET search_path TO w_gene; 

--#Fixe la zone pour la date et l'heure
SET timezone = 'CET';

-- #Création des types : TypeRole et Etat Annotation
CREATE TYPE TypeRole AS ENUM ('reader', 'annotator', 'validator','admin');
CREATE TYPE TypeStrand AS ENUM ('1', '-1');

-- #Création de la relation Utilisateur
CREATE TABLE Users (
Email VARCHAR(320) CHECK (Email ~* '[a-z0-9]*@[a-z0-9.]*'),
Name VARCHAR(50),
Family_Name VARCHAR(50),
Phone INTEGER,
Role TypeRole,
Date TIMESTAMPTZ,
Password VARCHAR(200) NOT NULL CHECK (length(Password) > 5),
PRIMARY KEY (Email)); 

-- #Création de la relation Génome
CREATE TABLE Genome (
AccessionNb VARCHAR(20),
Species VARCHAR(100) NOT NULL,
Strain VARCHAR(100),
Seq_length INTEGER NOT NULL, 
Seq_nt TEXT NOT NULL, 
PRIMARY KEY (AccessionNb));

-- #Création de la relation Sequence 
CREATE TABLE Sequence (
IDsequence VARCHAR(20),
Email_annot VARCHAR(320),
AccessionNb VARCHAR(20) NOT NULL,
DNA_type VARCHAR(50) CHECK (DNA_type='chromosome' or DNA_type='plasmid') NOT NULL,
CDS_start INTEGER NOT NULL,
CDS_end INTEGER NOT NULL,
Strand TypeStrand,
Annot  INTEGER NOT NULL, /* 0 non assigné 1 un annotation qui existe et 2 assigné mais non annoté   */
CDS_seq TEXT NOT NULL,
CDS_size INTEGER NOT NULL,
Pep_seq TEXT NOT NULL,
Pep_size INTEGER NOT NULL,
PRIMARY KEY (IDsequence),
FOREIGN KEY (Email_Annot) REFERENCES Users(Email),
FOREIGN KEY (AccessionNb) REFERENCES Genome(AccessionNb));

-- #Création de la relation Gènes/Protéines
CREATE TABLE Annotation (
AnnotID SERIAL,
Email_Annot VARCHAR(320) NOT NULL, 
Date_Annot TIMESTAMPTZ  NOT NULL,
GeneID VARCHAR(20)  NOT NULL,
IDsequence VARCHAR(20)  NOT NULL,
GeneBiotype VARCHAR(100)  NOT NULL,
TranscriptBiotype VARCHAR(100)  NOT NULL,
GeneSymbol VARCHAR(20), --#si ya pas null, si non le rempli, dans le parser
Description VARCHAR(500)  NOT NULL,
Status int NOT NULL, /* 0  en cours de validation 1 validé ou 2 rejeté    */
Comments VARCHAR(500),
unique(IDsequence,Date_Annot,Email_Annot),
PRIMARY KEY(AnnotID), 
FOREIGN KEY (IDsequence) REFERENCES Sequence(IDsequence),
FOREIGN KEY (Email_Annot) REFERENCES Users(Email));
--#UNIQUE = pour pas que la même annotation soit faite par deux personnes différentes 










