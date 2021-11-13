-- #Création du schéma de tables
CREATE SCHEMA IF NOT EXISTS GeneDB;
--#SET SCHEMA 'GeneDB';
SET search_path TO genedb; 

--#Fixe la zone pour la date et l'heure
SET timezone = 'CET';

-- #Création des types : TypeRole et Etat Annotation
CREATE TYPE TypeRole AS ENUM ('reader', 'annotator', 'validator');
CREATE TYPE TypeAnnot AS ENUM ('non annotated', 'annotated and non validated', 'annotated and validated');
CREATE TYPE Typebrin AS ENUM ('1', '-1'); 

-- #Création de la relation Utilisateur
CREATE TABLE Users (
Email VARCHAR(20),
Surname VARCHAR(50),
Name VARCHAR(50),
Phone INTEGER,
Role TypeRole,
Date TIMESTAMPTZ,
Password VARCHAR(200),
PRIMARY KEY (Email)); 

-- #Création de la relation Génome
CREATE TABLE Genome (
AccessionNb VARCHAR(20),
Species VARCHAR(100),
Strain VARCHAR(100),
Seq_length INTEGER, 
Seq_nt TEXT, 
PRIMARY KEY (AccessionNb));

-- #Création de la relation Séquence 
CREATE TABLE Sequence (
IDsequence VARCHAR(20),
AccessionNb VARCHAR(20),
CDS_seq TEXT,
Pep_seq TEXT,
CDS_start INTEGER,
CDS_end INTEGER,
Strand Typebrin, 
PRIMARY KEY (IDsequence),
FOREIGN KEY (AccessionNb) REFERENCES Genome(AccessionNb));

-- #Création de la relation Gènes/Protéines
CREATE TABLE Annotation (
AnnotID SERIAL, --#Auto-incrémentable, n'existe pas dans les fichiers .fa
Email_Annot VARCHAR(20) UNIQUE, 
Date_Annot TIMESTAMPTZ,
GeneID VARCHAR(20) UNIQUE,
IDsequence VARCHAR(20),
GeneBiotype VARCHAR(100),
TranscriptBiotype VARCHAR(100),
GeneSymbol VARCHAR(20),
Description VARCHAR(500),
Length INTEGER,
Status TypeAnnot,
Comments VARCHAR(500),
PRIMARY KEY(AnnotID), 
FOREIGN KEY (IDsequence) REFERENCES Sequence(IDsequence),
FOREIGN KEY (Email_Annot) REFERENCES Users(Email));

--#UNIQUE = empêche que la même annotation soit faite par deux personnes différentes 











