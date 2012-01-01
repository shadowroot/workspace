'''
Created on 1.1.2012

@author: Jonny
'''
"""

You have 30 seconds time to send the solution.
    
    
List of scrambled words:        
boocsy
    
leaplcmb
    
ndiarle
    
aktemr
    
ahrdow
    
ndamaa
    
yfrejfe
    
udsteay
    
alsolni
    
dscacae







erxdte
    
eogiod
    
bylapyo
    
bzeatlei
    
6iu9bb
    
ridztz
    
cfaiicp
    
dbanry
    
odatak
    
grtrtae
"""

import os

f = "wordlist.txt"
fp = os.open(f, os.R_OK)
data = os.read(fp, os.path.getsize(f))
data = data.split("\r\n")
print "[+]hello CRYPTO"


#print ''.join(data)