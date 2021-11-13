# -*- coding: utf-8 -*-
"""
Created on Fri Nov  5 21:36:00 2021

@author: Ilhem
"""
"""
This function Parse cds and peptide files. 
Input : Fasta file 
Output: A dictionnary in a list which contains the first line after > symbol and the sequence 
"""
        
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
        
"""
This function Parse the first line after > symbol to extract features of each gene in fasta files. 
Input : The first line of fasta files (after > symbol) 
Output: A dictionnary in a list which contains the features of genes.
"""        
def parse_annot(name):
    name=name.strip(">").split()
    
    annot = {
        'id_seq': name[0],
        'numacc_gc': name[2].split(":")[1],
        'debut_cds': name[2].split(":")[-3],
        'fin_cds': name[2].split(":")[-2],
        'brin': name[2].split(":")[-1],
        }
    dsc = []
    for pair in name[3:]:
        if ":" in pair:
            info = pair.split(":")
            if len(info) == 2:
                annot[info[0]] = info[1]
            else:
                annot[info[0]] = "_".join(info[1:])
        else:
            dsc.append(pair)
    if dsc:
        annot['description'] = annot['description'] + "_" + "_".join(dsc)
    return annot
    