# -*- coding: utf-8 -*-
"""
Created on Mon Nov 15 16:56:34 2021

@author: Asus
"""

#Parser for cds and peptide newcoli files:        
def read_fasta2(fp):
    genes = []
    fichier = open(fp).read()
    for gene in fichier.split("\n>"):
        g = gene.split("\n")

        obj = {
            "name": g[0],
            "seq": "".join(g[1:])
                }
        if obj["name"]:
            genes.append(obj)
    return genes
  
def parse_new(new):
    new=new.strip(">").split()
    annot_new = {
        'id_seq': new[0],
        'numacc_gc': new[2].split(":")[1],
        'debut_cds': new[2].split(":")[-2],
        'fin_cds': new[2].split(":")[-1],
        }
    return annot_new

