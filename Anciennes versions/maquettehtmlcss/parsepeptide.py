# -*- coding: utf-8 -*-
"""
Created on Sun Oct 31 19:56:44 2021

@author: Asus
"""
import os
from parsefunction import *
peptide='C:/Users/Asus/Desktop/code web project/data/peptide'
"""Parse peptide files """
for file in os.listdir(peptide):
    printfile
    with open(file) as fp:
        for name, seq in read_fasta(fp):
            name=name.strip(">").split()
            name[8 : ]=['_'.join(name[8 : ])]
            for item in name:
                if ':' in item:
                    item.split(':')
        print(name,seq)