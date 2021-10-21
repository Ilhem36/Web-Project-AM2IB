-- #Création du schéma de tables
-- #CREATE SCHEMA GeneDB;
SET SCHEMA 'GeneDB';
--#SET search_path TO genedb; 

-- #Création des types : TypeRole et Etat Annotation
CREATE TYPE TypeRole AS ENUM ('lecteur', 'annotateur', 'validateur');
CREATE TYPE TypeAnnot AS ENUM ('non annoté', 'non validé', 'annoté et validé');

-- #Création de la relation Utilisateur
CREATE TABLE Utilisateur (
Email VARCHAR(500) UNIQUE,
Mdp VARCHAR(500),
Nom VARCHAR(500),
Prenom VARCHAR(500),
NumTel VARCHAR(20),
Role TypeRole,
Date Date,
Heure VARCHAR(10),
PRIMARY KEY (Email, Mdp));

-- #Création de la relation Génome
CREATE TABLE Genome (
NomGenome VARCHAR(500) UNIQUE,
Serotype VARCHAR(500),
Espece VARCHAR(500),
SeqNucl VARCHAR,
Souche VARCHAR(500),
NbChromosome INTEGER,
TailleSeq INTEGER,
Reference INTEGER, 
EmailAnnot VARCHAR(500),
EtatAnnot TypeAnnot,
Commentaires VARCHAR(500),
PRIMARY KEY (NomGenome, EmailAnnot, EtatAnnot, Commentaires), 
FOREIGN KEY (EmailAnnot) REFERENCES Utilisateur(Email));

-- #Création de la relation Gènes/Protéines
CREATE TABLE Gene_Prot (
NumeroAccession VARCHAR(500),
SeqGen VARCHAR,
SeqProt VARCHAR,
ChromosomePosition VARCHAR(500),
NbChrPosition VARCHAR(500),
IDGene VARCHAR(500),
GeneBiotype VARCHAR(500),
TranscriptBiotype VARCHAR(500),
GeneSymbol VARCHAR(500),
Description VARCHAR(500),
NomGenome VARCHAR(500),
EmailAnnot VARCHAR(500), 
EtatAnnot TypeAnnot,
Commentaires VARCHAR(500),
PRIMARY KEY (NumeroAccession, NomGenome, EmailAnnot, EtatAnnot, Commentaires),
FOREIGN KEY (NomGenome, EmailAnnot, EtatAnnot, Commentaires) REFERENCES Genome(NomGenome, EmailAnnot, EtatAnnot, Commentaires));



