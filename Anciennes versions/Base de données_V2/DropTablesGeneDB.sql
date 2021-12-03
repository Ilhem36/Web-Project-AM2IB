--#Suppression des tables une par une dans l’ordre inverse de création
DROP TABLE Annotation;
DROP TABLE Sequence;
DROP TABLE Genome;
DROP TABLE Users;

--# Suppression des types nouvellement créés
DROP TYPE TypeStrand;
DROP TYPE TypeAnnot;
DROP TYPE TypeRole;

--# Suppression du schéma
DROP SCHEMA GeneDB;
