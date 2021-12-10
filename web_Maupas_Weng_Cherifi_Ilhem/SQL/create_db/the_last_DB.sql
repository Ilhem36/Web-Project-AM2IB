-----Database script-----

-- # Creating  the schema 
CREATE SCHEMA w_gene;

--#SET SCHEMA 'w_gene';
SET search_path TO w_gene; 

--#SET the zone for the date and time
SET timezone = 'CET';

-- #Creating  the type of TypeRole and TypeStrand attributes

CREATE TYPE TypeRole AS ENUM ('reader', 'annotator', 'validator','admin');
CREATE TYPE TypeStrand AS ENUM ('1', '-1');

-- #Creating Users relation

CREATE TABLE Users (
Email VARCHAR(320) CHECK (Email ~* '[a-z0-9]*@[a-z0-9.]*'), /* Check the email format*/
Name VARCHAR(50),
Family_Name VARCHAR(50),
Phone VARCHAR(15),
Role TypeRole,
Date TIMESTAMPTZ,
Password VARCHAR(200) NOT NULL CHECK (length(Password) > 5), /* Check the length of the password */
PRIMARY KEY (Email)); 

-- #Creating Genome relation

CREATE TABLE Genome (
AccessionNb VARCHAR(20),
Species VARCHAR(100),
Strain VARCHAR(100),
Seq_length INTEGER NOT NULL, 
Seq_nt TEXT NOT NULL, 
PRIMARY KEY (AccessionNb));

-- #Creating sequence relation

CREATE TABLE Sequence (
IDsequence VARCHAR(20),
Email_annot VARCHAR(320),
AccessionNb VARCHAR(20) NOT NULL,
DNA_type VARCHAR(50) CHECK (DNA_type='chromosome' or DNA_type='plasmid') NOT NULL,
CDS_start INTEGER NOT NULL,
CDS_end INTEGER NOT NULL,
Strand TypeStrand,
Annot  INTEGER NOT NULL, /* 0 for  not assigned sequence    1 for  annotated sequence  and  2  for assigned sequence but not already annotated   */
CDS_seq TEXT NOT NULL,
CDS_size INTEGER NOT NULL,
Pep_seq TEXT NOT NULL,
Pep_size INTEGER NOT NULL,
PRIMARY KEY (IDsequence),
FOREIGN KEY (Email_Annot) REFERENCES Users(Email),
FOREIGN KEY (AccessionNb) REFERENCES Genome(AccessionNb));

-- #Creating annotation relation

CREATE TABLE Annotation (
AnnotID SERIAL, /* SERIAL to generate a sequences of integers to be used as a primary key */
Email_Annot VARCHAR(320), 
Date_Annot TIMESTAMPTZ, /* SERIAL to generate a sequences of integers to be used as a primary key */
GeneID VARCHAR(20)  NOT NULL,
IDsequence VARCHAR(20)  NOT NULL,
GeneBiotype VARCHAR(100)  NOT NULL,
TranscriptBiotype VARCHAR(100)  NOT NULL,
GeneSymbol VARCHAR(20), --#si ya pas null, si non le rempli, dans le parser
Description VARCHAR(500)  NOT NULL,
Status int NOT NULL, /* 0 for  Being validated,  1 for valided  or 2 for rejected annotation */
Comments VARCHAR(500),
unique(IDsequence,Date_Annot,Email_Annot), /* prevents the same sequence from being annotated by 2 different annotators */
PRIMARY KEY(AnnotID), 
FOREIGN KEY (IDsequence) REFERENCES Sequence(IDsequence),
FOREIGN KEY (Email_Annot) REFERENCES Users(Email));











