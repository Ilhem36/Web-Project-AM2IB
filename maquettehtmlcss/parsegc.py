# -*- coding: utf-8 -*-
"""
Created on Sun Oct 31 20:38:21 2021

@author: Asus
"""
import os
from parsefunction import *
gc='C:/xampp\htdocs\data\completegenome'
"""Parse the complete genome files """
for file in os.listdir(gc):
    with open(file) as fp:
        for name, seq in read_fasta(fp):
            name=name.strip(">").split()
            print(name,[seq])
