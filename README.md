# Read Me Projet Web M2 AMI2B
### RIAHI Ilhem, MAUPAS Arnaud, WENG Lorraine, CHERIFI Sanâ

Pour mener à bien ce projet, il sera nécessaire de télécharger postgresql, python, php. Plusieurs langages de programmation sont ainsi utilisés : PHP, CSS2, Python, HTML et Javascript.

## I- Implémentation et chargement des données :

   1- Le script the_last_DB.sql dans le dossier(SQL/create_db) permet de créer le schéma w_gene sur Postgresql

   2- Les 2 scripts (parser_files.py et Insert_data.py)  dans le dossier SQL/ Insert_data permettent 
      de parser les fichiers fasta et  d’insérer  les données dans la base crée à l’étape précédente. 
      Ainsi Insertion_users.sql permet d’insérer les utilisateurs et mettre à jour la table génome afin d’insérer les espèces et les souches. 

   Ordre d’éxécution des scripts : 
   
   1 - Créer le schéma avec le script the_last_DB.sql via la commande : 
     
       psql
       \i the_last_DB.sql
       
2 - Parser  les fichiers fasta  avec le script parser_files.py 

3 - Insérer les données génomiques  avec le script Insert_data.py

4- Insérer les utilisateurs et mettre à jour la table genome avec le script Insertion_users.sql  via la commande 
\i the_last_DB.sql  
via la commande :

       psql
       \i Insertion_users.sql 

```
NB: il faut renseigner dans le script  Insert_data.py le chemin vers les fichiers fasta et les propriétées 
de la base au sein de cette ligne mydb = psycopg2.connect(dbname='', user='', host='', password='', port='')
```


## II- Lien avec la base de données

Il est ensuite possible de se connecter avec la base de donnée en renseignant dans db_info.ini le nom du serveur (‘host’), le port (‘port’), le nom de la base de donnée (‘dbname’), le nom d’utilisateur (‘user’) et le mot de passe (‘password’).

## Pages Php


Nous avons au total 8 pages web organisées dans l'ordre, de la manière suivante :

```
0 - fichier “db_info.ini” appelé à l’aide de “db_utils.php”
   db_utils.php contient les fonctions de la connexion à la base de données
   db_info.ini contient les paramètres de connexion de la base
```

```
1 -  Home_page.php est la page d'accueil , elle comprend le fichier contenant 
    le code en php/HTML et "home_page.css" qui réalise le design en CSS

```

```
2 -  Menu.php  est la page php qui gère la barre de navigation du site en fonction du role de l’utilisateur
    (Admin, validateur, annotateur, ou reader). 

```

```
3 -  signup.php et inscription.css correspondent à la page d’inscription
```

```
4 - signIn.php et seconnecter.css correspondent à la page de connexion du site en tant qu'utilisateur.
```

```
5 - adminpage2.php, adminmodif2.php , admin.css correspondent  à la page administrateur
```

```
6 - reader_Menu.php correspond au menu de la page Reader.  
    - Form_genome.php, Form_cds.php, reader.css permettent d’accéder aux formulaires de recherches sur les données 
      de génomes et de CDS et peptides
    - Search_genome.php + search_cds.css ainsi que Search_cds.php + search.css correspondent aux résultats 
      des recherches sous forme de tableaux cliquables qui renvoient vers les pages de résultats  
    - Results_genome2.php, reader2.css et Results_cds.php, reader.css
      et extraction.php + reader_menu.css sont utilisés pour l’extraction des données de la base 
    - annot_in_progress.php + annot_seq.css, pour voir les annotations en cours de validation
    
    NB: Il est recommandé de ne pas dépasser une longueur de 5000 paires de base pour garantir un résultat optimal.

 ```    

```   
7 -  Annot_Menu.php /reader_menu.css correspond  à la page d'accueil de l’annotateur
     - annot_seq.php + annot_seq.css + anno_fun.php correspondent aux pages où l’annotateur peut choisir 
       les séquences  à annoter 
     - annot_design2.php + reader.css correspond à la page où l’annotateur peut remplir le formulaire 
       pour annoter ses séquences. 
     - historique.php + annot_seq.css  correspond à la page ou l’annotateur peut visualiser ce qu’il a annoté 
       juste aprés l’annotation (il s’agit d’un lien cliquable sur le formulaire pour l’annotation)  
```

```
8 - Validator_Menu.php + reader_menu.css correspond à la page d'accueil du validateur
     - assign_annot.php + assign.css  correspondent à la page où le validateur peut assigner des séquences 
       à annoter aux annotateurs( ou validateurs ou admin).
     - validation_space.php, annot_seq.css + (valid_annot.php + annot_seq.css) correspondent à la page où 
       le validateur peut valider ou rejeter les annotations.
     
```






