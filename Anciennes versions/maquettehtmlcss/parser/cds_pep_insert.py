# -*- coding: utf-8 -*-
"""
Created on Sun Oct 31 20:01:03 2021

@author: ilhem
"""
import csv
import os
import psycopg2
from cds_pep import * 
#Here you have to change the path of your cds and peptide files 
cds = 'C:/xampp\htdocs\data\cdsfile'
peptide='C:/xampp\htdocs\data\peptidefile'
"""Parse CDS files"""

#Parse cds files:
l_cds = []
for file in os.listdir(cds):
    if file.endswith(".fa"):
        #with open(os.path.join(cds, file)) as fp:
            #for name, seq in read_fasta2(fp):
        for gene in read_fasta2(os.path.join(cds, file)):
            l_cds.append({
                "espece":file.split('_')[0],
                "souche":file.split('_')[2],
                "annot":parse_annot(gene["name"]),
                "sequence":gene["seq"],
                "taille":len(gene["seq"])
            })
#Parse peptide files: 
l_pep = []
for file in os.listdir(peptide):
    if file.endswith(".fa"):
        #with open(os.path.join(cds, file)) as fp:
            #for name, seq in read_fasta2(fp):
        for gene in read_fasta2(os.path.join(peptide, file)):
            l_pep.append({
                "espece":file.split('_')[0],
                "souche":file.split('_')[2],
                "annot":parse_annot(gene["name"]),
                "sequence":gene["seq"]
            })
# Connect to postgresdatabase:
#Be Careful please!!! # You have to change the dbname, user , host , password and port according to your own database 
mydb = psycopg2.connect(dbname='genome_annot', user='postgres', host='localhost', password='Think13', port='5432')
mycursor = mydb.cursor()
mydb.commit()
# Insert data in sequence table  : 
for cds in l_cds: 
    for pep in l_pep:
        sql = "INSERT INTO genedb.sequence (IDsequence, AccessionNb, CDS_seq, Pep_seq, CDS_start, CDS_end, Strand) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        val = (cds["annot"]["id_seq"],
           cds["annot"]["numacc_gc"],
           cds["sequence"],
           pep["sequence"],
           cds["annot"]["debut_cds"],
           cds["annot"]["fin_cds"],
           cds["annot"]["brin"],
           )
    mycursor.execute(sql, val)
    mydb.commit()

print(mycursor.rowcount, "record inserted.")
# Insert data in annotation table : 
# Here Id annot is defined as serial so it should never be mentionned in the insert query
for cds in l_cds:
        sql = "INSERT INTO genedb.annotation (Email_Annot, Date_Annot, GeneID, IDsequence, GeneBiotype, TranscriptBiotype, GeneSymbol, Description, Length, Status, Comments) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
        val = (None,None,
            cds["annot"]["gene"],
            cds["annot"]["id_seq"],
            cds["annot"]["gene_biotype"],
            cds["annot"]["transcript_biotype"],
            # If gene symbol exists insert its value, else insert null
            cds["annot"].get("gene_symbol", None),
            cds["annot"]["description"],
            cds["taille"],
            None,
            None)
        mycursor.execute(sql, val)
        mydb.commit()
        
print(mycursor.rowcount, "record inserted.")

