# -*- coding: utf-8 -*-
"""
Created on Sun Oct 31 20:01:03 2021

@author: Asus
"""
import csv
import os
from parsefunction import *
cds='C:/xampp\htdocs\data\cdsfile'

"""Parse CDS files"""
l_cds=[]
for file in os.listdir(cds):
    with open(file) as fp:
        for name, seq in read_fasta(fp):
            name=name.strip(">").split()
            name[7 : ]=['_'.join(name[7 : ])]
            new_set = [x.replace('gene:', '').replace('gene_biotype:', '').replace('transcript_biotype:','').replace('gene_symbol:','').replace ('description:','')for x in name]
            cds_li=[file.replace('.fa','').replace('Escherichia_coli_',''),len(seq),new_set,seq]
            l_cds.append(cds_li)
for i in l_cds:
    list = [["espéce", "taille", "numacc","ID_gene","gene_biotype","transcript_biotype","gene_symbol","description"],
    [l_cds[i], l_cds[i],l_cds[i][0],l_cds[i][3],l_cds[i][4],l_cds[i][5],l_cds[i][6],l_cds[i][7]]]
with open('cds.csv', 'w', newline='') as file:
    writer = csv.writer(file, quoting=csv.QUOTE_ALL,delimiter=';')
    writer.writerows(list)