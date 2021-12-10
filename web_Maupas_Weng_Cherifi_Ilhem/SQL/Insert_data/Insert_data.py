

# -*- coding: utf-8 -*-
"""
Created on Sun Oct 31 20:01:03 2021

@author: ilhem riahi 
"""

import os
import psycopg2
from parser_files import * 


""" Please write the correct path for your files according to your computer"""
""" Path for files"""
genome= "..../data/completegenome"
cds = '..../data/cdsfile'
pep='...../data/peptidefile'
cds_new='..../data/cds_aannoté'
pep_new='.../data/pep_nonannoté'

l_genome = []
for file in os.listdir(genome):
    if file.endswith(".fa"):
        with open(os.path.join(genome, file)) as fp:
            for name, seq in read_genome(fp):
                l_genome.append({
                    "annot":parse_genome(name),
                     "seq": seq
                })

"""Parse CDS files"""

l_cds = []
for file in os.listdir(cds):
    if file.endswith(".fa"):
        for gene in read_fasta(os.path.join(cds, file)):
            l_cds.append({
                "annot":parse_annot(gene["name"]),
                "sequence":gene["seq"],
                "taille":len(gene["seq"])
            })
l_pep = []
for file in os.listdir(pep):
    if file.endswith(".fa"):
        for gene in read_fasta(os.path.join(pep, file)):
            l_pep.append({
                "espece":file.split('_')[0],
                "souche":file.split('_')[2],
                "annot":parse_annot(gene["name"]),
                "sequence":gene["seq"]
            })
#Create new dictionnary which contains cds and peptide information:
pepdict = {pep['annot']["id_seq"] : pep for pep in l_pep }
cds_pep = {cds["annot"]["id_seq"]:cds for cds in l_cds.copy()}
for obj in cds_pep:
    cds_pep[obj]["annot"].pop('id_seq')
    cds_pep[obj]["seq_cds"] = cds_pep[obj]["sequence"]
    cds_pep[obj]["seq_pep"] = pepdict[obj]["sequence"]
    cds_pep[obj]["taille_pep"] = len(cds_pep[obj]["seq_pep"])
    cds_pep[obj]["taille_cds"] = len(cds_pep[obj]["seq_cds"])
    cds_pep[obj].pop("sequence")
    cds_pep[obj].pop("taille")
    
all(pepdict[gene]["sequence"] == cds_pep[gene]["seq_pep"] for gene in cds_pep)

"""Parse CDS/Pep new files  and insert in database """

l_cds_new = []
for file in os.listdir(cds_new):
    if file.endswith(".fa"):
        for gene in read_fasta(os.path.join(cds_new, file)):
            l_cds_new.append({
                "annot":parse_new(gene["name"]),
                "sequence":gene["seq"],
                "taille":len(gene["seq"])
            })
l_pep_new = []
for file in os.listdir(pep_new):
    if file.endswith(".fa"):
        for gene in read_fasta(os.path.join(pep_new, file)):
            l_pep_new.append({
                "espece":file.split('_')[0],
                "souche":file.split('_')[2],
                "annot":parse_new(gene["name"]),
                "sequence":gene["seq"]
            })
#Create new dictionnary which contains cds and peptide information:
pepdict = {pep_new['annot']["id_seq"] : pep_new for pep_new in l_pep_new }
cds_pep_new = {cds_new["annot"]["id_seq"]:cds_new for cds_new in l_cds_new.copy()}
for obj in cds_pep_new:
    cds_pep_new[obj]["annot"].pop('id_seq')
    cds_pep_new[obj]["seq_cds"] = cds_pep_new[obj]["sequence"]
    cds_pep_new[obj]["seq_pep"] = pepdict[obj]["sequence"]
    cds_pep_new[obj]["taille_pep"] = len(cds_pep_new[obj]["seq_pep"])
    cds_pep_new[obj]["taille_cds"] = len(cds_pep_new[obj]["seq_cds"])
    cds_pep_new[obj].pop("sequence")
    cds_pep_new[obj].pop("taille")
    
all(pepdict[gene]["sequence"] == cds_pep_new[gene]["seq_pep"] for gene in cds_pep_new)

################## Insertion data in data base ############# 
    
#Connection to the database 

""" Please write the correct  information of your own database to insert data"""
mydb = psycopg2.connect(dbname=' ', user=' ', host=' ', password=' ', port=' ')
mycursor = mydb.cursor()
mydb.commit()

#Insert genome in genome table

for gc  in l_genome:
    sql_genome = """ INSERT INTO w_gene.genome (AccessionNb, Species, Strain, Seq_length, Seq_nt) VALUES (%s, %s, %s, %s, %s) """
    val_genome=[gc['annot']['numacc_gc'],None,None,gc['annot']['taille'],gc['seq']]
    mycursor.execute(sql_genome, val_genome)
    mydb.commit()

print(mycursor.rowcount, "record inserted genome.")


#Insert cds information in sequence table 
for gene in cds_pep: 
    sql_cds = "INSERT INTO w_gene.sequence (IDsequence, AccessionNb,DNA_type,CDS_start, CDS_end, Strand,annot,CDS_seq,cds_size, Pep_seq,pep_size) VALUES (%s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s)"
    val_cds = (
        gene,
       cds_pep[gene]["annot"]["numacc_gc"],
       cds_pep[gene]["annot"]["DNA_type"],
       cds_pep[gene]["annot"]["debut_cds"],
       cds_pep[gene]["annot"]["fin_cds"],
       cds_pep[gene]["annot"]["brin"],
       1, # 1 because an annotation exits 
       cds_pep[gene]["seq_cds"],
       cds_pep[gene]["taille_cds"],
       cds_pep[gene]["seq_pep"],
       cds_pep[gene]["taille_pep"])
    mycursor.execute(sql_cds, val_cds)
    mydb.commit()

print(mycursor.rowcount, "record inserted cds.")

#Insert cds information in annotation table 

for cds in cds_pep:
        sql_pep = "INSERT INTO w_gene.annotation (Email_Annot, Date_Annot, GeneID, IDsequence, GeneBiotype, TranscriptBiotype, GeneSymbol, Description,Status, Comments) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
        val_pep = (None,None,
            cds_pep[cds]["annot"].get("gene",None),
            cds,
            cds_pep[cds]["annot"].get("gene_biotype",None),
            cds_pep[cds]["annot"].get("transcript_biotype",None),
            cds_pep[cds]["annot"].get("gene_symbol", None),
            cds_pep[cds]["annot"].get("description",None),
            1, # 1 because  it's is already validated  (annotated from the begining)
            None)
        mycursor.execute(sql_pep, val_pep)
        mydb.commit()
        
print(mycursor.rowcount, "record inserted pep.")

#Insert cds_new information in sequence table 

for gene in cds_pep_new: 
    sql_new = "INSERT INTO w_gene.sequence (IDsequence, AccessionNb,DNA_type,CDS_start, CDS_end, annot,CDS_seq,cds_size, Pep_seq,pep_size) VALUES ( %s, %s,%s, %s, %s, %s, %s, %s, %s, %s)"
    val_new = (
        gene,
       cds_pep_new[gene]["annot"]["numacc_gc"],
       cds_pep_new[gene]["annot"]["DNA_type"],
       cds_pep_new[gene]["annot"]["debut_cds"],
       cds_pep_new[gene]["annot"]["fin_cds"],
       0, # because these sequences are not affected to any annotator 
       cds_pep_new[gene]["seq_cds"],
       cds_pep_new[gene]["taille_cds"],
       cds_pep_new[gene]["seq_pep"],
       cds_pep_new[gene]["taille_pep"])
    mycursor.execute(sql_new, val_new)
    mydb.commit()

print(mycursor.rowcount, "record inserted new.")
#### Here we  don't need to insert anything in annotation table for the new_coli files because we will use just sequence table 
#### Close tha database after data insertions
mycursor.close()
mydb.close()
