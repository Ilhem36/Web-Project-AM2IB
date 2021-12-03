# -*- coding: utf-8 -*-
"""
Created on Sat Nov  6 14:04:58 2021

@author: ilhem
"""
import os 
import psycopg2
genome= "Write the path of genome files in your computer "

from parse_gc import *

l_genome = []
for file in os.listdir(genome):
    if file.endswith(".fa"):
        with open(os.path.join(genome, file)) as fp:
            for name, seq in read_genome(fp):
                l_genome.append({
                    "annot":parse_genome(name),
                     "seq": seq
                })

#Connection to the database: 
    
mydb = psycopg2.connect(dbname='web_gene', user='postgres', host='localhost', password='Think13', port='5432')
mycursor = mydb.cursor()
mydb.commit ()

#Insert genome in genome table

for gc  in l_genome:
    sql = """ INSERT INTO web_gene.genome (AccessionNb, Species, Strain, Seq_length, Seq_nt) VALUES (%s, %s, %s, %s, %s) """
    val=[gc['annot']['numacc_gc'],None,None,gc['annot']['taille'],gc['seq']]
    mycursor.execute(sql, val)
    mydb.commit()

print(mycursor.rowcount, "record inserted.")


mycursor.close()
mydb.close()
