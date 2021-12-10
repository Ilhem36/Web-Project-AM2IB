# -*- coding: utf-8 -*-
"""
Created on Sat Oct 30 11:26:05 2021

@author: Asus
"""
import os

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