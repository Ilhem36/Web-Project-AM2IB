-----Insert some users in the database-----


INSERT INTO w_gene.users (Email, Name, Family_Name, Phone, Role, Date, Password) VALUES ('arnaud@psud.fr', 'Arnaud', 'Maupas', 58745785, 'validator', current_timestamp, 222378),
('Ines@psud.fr', 'Ines', 'Strosin', 150002, 'validator', current_timestamp, 167941);

INSERT INTO w_gene.users (Email, Name, Family_Name, Phone, Role, Date, Password) VALUES ('ilhem@psud.fr','Ilhem', 'Riahi',  54745784, 'annotator', current_timestamp, 123589),
('Christophe@psud.fr','Christophe', 'Gomes',  062304, 'annotator', current_timestamp, 435193);

INSERT INTO w_gene.users (Email, Name, Family_Name, Phone, Role, Date, Password) VALUES ('lorraine@psud.fr','Lorraine', 'Weng', 58745784, 'reader', current_timestamp, 123788),
('Benjamin@psud.fr','Benjamin', 'Teixeira', 242537, 'reader', current_timestamp, 228858);

INSERT INTO w_gene.users (Email, Name, Family_Name, Phone, Role, Date, Password) VALUES ('sana@psud.fr', 'Sana', 'Cherifi', 52369874, 'admin', current_timestamp, 256378),
('GenA@psud.fr', 'Gen', 'Annot', 185121, 'admin', current_timestamp, 677349);

------Update genome table to insert species and strain-------

UPDATE w_gene.genome SET species = 'Escherichia_coli' WHERE accessionnb = 'ASM584v2'; 
UPDATE w_gene.genome SET strain = 'k12' WHERE accessionnb = 'ASM584v2'; 
UPDATE w_gene.genome SET species = 'Escherichia_coli' WHERE accessionnb = 'ASM744v1';
UPDATE w_gene.genome SET strain = 'cft073' WHERE accessionnb = 'ASM744v1'; 
UPDATE w_gene.genome SET species = 'Escherichia_coli' WHERE accessionnb = 'ASM666v1'; 
UPDATE w_gene.genome SET strain = 'o157h7' WHERE accessionnb = 'ASM666v1'; 
UPDATE w_gene.genome SET species = 'new_coli' WHERE accessionnb = 'ASM1330v1'; 



