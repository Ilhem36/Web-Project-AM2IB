# Read Me Projet Web M2 AMI2B
### RIAHI Ilhem, MAUPAS Arnaud, WENG Lorraine, CHERIFI Sanâ

Pour mener à bien ce projet, il sera nécessaire de télécharger postgresql, python, php. Plusieurs langages de programmation sont ainsi utilisés : PHP, CSS2, Python, Hack, HTML et Javascript.

## I- Implémentation et chargement des données
Le script the_last_DB.sql permet de créer notre schéma sur Postgresql. La relation users est ensuite remplie avec des utilisateurs fictifs à l’aide du script Insertion_users.sql.
chargement des données dans la database grâce à Postgresql :

## II- Lien avec la base de données

Il est ensuite possible de se connecter avec la base de donnée en renseignant dans db_info.ini le nom du serveur (‘host’), le port (‘port’), le nom de la base de donnée (‘dbname’), le nom d’utilisateur (‘user’) et le mot de passe (‘password')

chargement des données dans la database grâce à Postgresql :

```
psql
\i the_last_DB.sql
\i Insertion_users.sql 
```

Pour insérer des utilisateurs fictifs et mettre à jour les noms des espèces et les noms des souches il est nécessaire de passer par le parser en python :

```
insérer insert_gc.py
insert_cds_pep.py
insert_new_coli.py
```

## Pages Php

Nous avons au total 7 pages web organisées dans l'ordre, de la manière suivante :

```
1-  Page d'accueil : Elle comprend le fichier Home_page.php contenant le code en php et 
    "home_page.css" qui réalise le design en CSS
```

```
2 -  La page d'inscription comprend les pages signup.php et inscription.css
```

```
3 -  Pour la page d'inscription nous avons codé les pages signIn.php et seconnecter.css
```

```
4 - La page dédiée à l'administrateur est codée dans le fichier adminpage2.php, 
    puis nous y avons ajouté des modifications dans le code adminmodif2.php 
    et enfin le design a été crée en css dans la page admin.css
```

```
5 - Pour la page Validateur :
   Le fichier Menu.php permet d'adapter le menu de recherche en fonction
   du rôle de l'utilisateur connecté. Elle est liée à reader_menu.css
   On a ensuite assign_annot.php (et assign.css) qui est lié à affect_valid.php 
   et permet d'assigner des séquences aux annotateurs. alid_annot.php.
   Le fichier validation_space.php est lié à valid_annot.php (et annot_seq.css)
   et ils permettent de gérer l'acceptation ou le rejet des annotations.
```

```
6 - Annot_Menu.php + reader_menu.css  + annot_seq.php + annot_seq.css + anno_fun.php + annot_design2.php + reader.cs + historique.php + annot_seq.css 
 ```    

```   
7 - La page reader est la plus complexe et est basée sur plusieurs scripts: 
    
    Les pages reader_Menu.php et reader_menu.css, correspondent au menu de la page Lecteur.
    On a ensuite les scripts Form_genome.php et Form_cds.php contenant le codage des 
    formulaires de recherches de génomes et de gènes/protéines.
    Puis ‘Search_genome.php’ et son fichier css  ‘search.css’ codent les requêtes sql 
    après une recherche par l’utilisateur et les stockent dans un tableau.
    Un lien est fait avec la page d’affichage des résultats Result_genome2.php 
    (et reader2.css) par le biais du numéro d’accession cliquable.
    Ensuite, Search_cds.php (et son css associé search_cds.css) contient les requêtes sql 
    après une recherche de cds (ou de protéine), le fait de cliquer l’ID de séquence renvoie 
    directement à la page résultat (Results_cds.php +  reader.css).
    Les annotations en cours de validation sont visualisables depuis la page  annotat_in_progress.php 
    et il est possible de télécharger toutes les données de la base de données, 
    en fonctiant des attributs que l’utilisateur veut extraire à partir de “extraction.php”. 

    
```

