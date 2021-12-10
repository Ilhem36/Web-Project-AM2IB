# -*- coding: utf-8 -*-
"""
Created on Sat Oct 30 11:26:05 2021

@author: Asus
"""
import os
# gc='C:/Users\Asus\Desktop\code web project\data\genomecomplet'

def read_fasta(fp):
        name, seq = None, []
        for line in fp:
            line = line.rstrip()
            if line.startswith(">"):
                if name: yield (name, ''.join(seq))
                name, seq = line, []
            else:
                seq.append(line)
        if name: yield (name, ''.join(seq))
"""Parse the complete genome files """
# for file in os.listdir(gc):
#     with open(file) as fp:
#         for name, seq in read_fasta(fp):
#             name=name.strip(">").split()
#             print(name,[seq])


                                

