--#Suppression des tables une par une dans l’ordre inverse de création
DROP TABLE Gene_Prot;
DROP TABLE Genome;
DROP TABLE Utilisateur;

--# Suppression des types nouvellement créés
DROP TYPE TypeAnnot;
DROP TYPE TypeRole;

--# Suppression du schéma
DROP SCHEMA GeneDB;
