# -*- coding: utf-8 -*-
"""
Created on Sat Oct 30 11:26:05 2021

@author: ilhem
"""
"""
A generator function which uses a yield statement (rather than return) to return the name (the first line after ">" ) and the sequence of each fasta file 

Input : faste file
Ouput: name, sequence


 """

def read_genome(fp):
        name, seq = None, []
        for line in fp:
            line = line.rstrip()
            if line.startswith(">"):
                if name: 
                    yield (name, '')
                name = line
            else:
                seq.append(line)
        if name: 
            yield (name, ''.join(seq))
            
"""
A function which extract the accession number and the size from  the first line(=name) of each fast
 file and store them in a dictionnary 

Input : the first line of each fasta file 
Ouput: a dictionnary which containes 'numacc_gc' and 'taille' keys   and their values


 """


def parse_genome(name):
    name=name.strip(">").split()
    annot = {
        'numacc_gc': name[2].split(":")[1],
        'taille': name[2].split(":")[-2],
        }
    return annot                                

