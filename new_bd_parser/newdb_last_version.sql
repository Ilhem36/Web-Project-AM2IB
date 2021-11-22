-- #Création du schéma de tables
CREATE SCHEMA web_gene;
--#SET SCHEMA 'web_gene';
SET search_path TO web_gene; 

--#Fixe la zone pour la date et l'heure
SET timezone = 'CET';

-- #Création des types : TypeRole et Etat Annotation
CREATE TYPE TypeRole AS ENUM ('reader', 'annotator', 'validator','admin');
CREATE TYPE Typebrin AS ENUM ('1', '-1');

-- #Création de la relation Utilisateur
CREATE TABLE Users (
Email VARCHAR(320),
Surname VARCHAR(50),
Name VARCHAR(50),
Phone INTEGER,
Role TypeRole,
Date TIMESTAMPTZ,
Password VARCHAR(200) NOT NULL,
PRIMARY KEY (Email)); 

-- #Création de la relation Génome
CREATE TABLE Genome (
AccessionNb VARCHAR(20),
Species VARCHAR(100),
Strain VARCHAR(100),
Seq_length INTEGER NOT NULL, 
Seq_nt TEXT NOT NULL, 
PRIMARY KEY (AccessionNb));

-- #Création de la relation Sequence 
CREATE TABLE Sequence (
IDsequence VARCHAR(20),
AccessionNb VARCHAR(20),
DNA_type VARCHAR(50) CHECK (DNA_type='chromosome' or DNA_type='plasmid'),
CDS_start INTEGER,
CDS_end INTEGER,
Strand Typebrin,
Annot  INTEGER NOT NULL, /* 0 not affected ,1 annotation exists, 2 affected */
CDS_seq TEXT NOT NULL,
CDS_size INTEGER NOT NULL,
Pep_seq TEXT NOT NULL,
pep_size INTEGER NOT NULL,
PRIMARY KEY (IDsequence),
FOREIGN KEY (AccessionNb) REFERENCES Genome(AccessionNb));

-- #Création de la relation Gènes/Protéines
CREATE TABLE Annotation (
AnnotID SERIAL,
Email_Annot VARCHAR(320), 
Date_Annot TIMESTAMPTZ,
GeneID VARCHAR(20),
IDsequence VARCHAR(20),
GeneBiotype VARCHAR(100),
TranscriptBiotype VARCHAR(100),
GeneSymbol VARCHAR(20), --#si ya pas null, si non le rempli, dans le parser
Description VARCHAR(500),
Status int NOT NULL, /* 0 In progress , 1 validated , 2 rejected */
Comments VARCHAR(500),
unique(IDsequence,Date_Annot,Email_Annot),
PRIMARY KEY(AnnotID), 
FOREIGN KEY (IDsequence) REFERENCES Sequence(IDsequence),
FOREIGN KEY (Email_Annot) REFERENCES Users(Email));
--#UNIQUE = pour pas que la même annotation soit faite par deux personnes différentes 










