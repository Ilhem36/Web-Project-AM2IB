# -*- coding: utf-8 -*-
"""
Created on Sun Oct 31 20:01:03 2021

@author: ilhem
"""
import csv
import os
import psycopg2
from parse_newcoli import * 
cds='C:/xampp\htdocs\projetweb\data\genomeaannoté'
pep='C:/xampp\htdocs\projetweb\data\pepàannoté'

"""Parse CDS files"""

#ilhem  = read_fasta2(os.path.join(cds, os.listdir(cds)[0]))  
l_cds = []
for file in os.listdir(cds):
    if file.endswith(".fa"):
        #with open(os.path.join(cds, file)) as fp:
            #for name, seq in read_fasta2(fp):
        for gene in read_fasta2(os.path.join(cds, file)):
            l_cds.append({
                #"espece":file.split('_')[0],
                #"souche":file.split('_')[2],
                "annot":parse_new(gene["name"]),
                "sequence":gene["seq"],
                "taille":len(gene["seq"])
            })
l_pep = []
for file in os.listdir(pep):
    if file.endswith(".fa"):
        #with open(os.path.join(cds, file)) as fp:
            #for name, seq in read_fasta2(fp):
        for gene in read_fasta2(os.path.join(pep, file)):
            l_pep.append({
                "espece":file.split('_')[0],
                "souche":file.split('_')[2],
                "annot":parse_new(gene["name"]),
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
    #Connection to the database 
mydb = psycopg2.connect(dbname='web_gene', user='postgres', host='localhost', password='Think13', port='5432')
mycursor = mydb.cursor()
mydb.commit()

#Insert cds information in sequence table 
for gene in cds_pep: 
    sql = "INSERT INTO web_gene.sequence (IDsequence, AccessionNb,DNA_type,CDS_start, CDS_end, Strand,annot,CDS_seq,cds_size, Pep_seq,pep_size) VALUES (%s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s)"
    val = (
        gene,
       cds_pep[gene]["annot"]["numacc_gc"],
       cds_pep[gene]["annot"]["DNA_type"],
       cds_pep[gene]["annot"]["debut_cds"],
       cds_pep[gene]["annot"]["fin_cds"],
       None,
       0,
       cds_pep[gene]["seq_cds"],
       cds_pep[gene]["taille_cds"],
       cds_pep[gene]["seq_pep"],
       cds_pep[gene]["taille_pep"])
    mycursor.execute(sql, val)
    mydb.commit()

print(mycursor.rowcount, "record inserted.")

#Insert cds information in annotation table 
for cds in cds_pep:
        sql = "INSERT INTO web_gene.annotation (Email_Annot, Date_Annot, GeneID, IDsequence, GeneBiotype, TranscriptBiotype, GeneSymbol, Description,Status, Comments) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
        val = (None,None,
            cds_pep[cds]["annot"].get("gene",None),
            cds,
            cds_pep[cds]["annot"].get("gene_biotype",None),
            cds_pep[cds]["annot"].get("transcript_biotype",None),
            cds_pep[cds]["annot"].get("gene_symbol", None),
            cds_pep[cds]["annot"].get("description",None),
            0,
            None)
        mycursor.execute(sql, val)
        mydb.commit()
        
print(mycursor.rowcount, "record inserted.")