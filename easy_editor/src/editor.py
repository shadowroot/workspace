'''
Created on 20.11.2011

@author: Jonny
'''
import sys,os
class cteni:
    array=""
    i=0
    n=0
    r=0
    def rutina(self):
        while self.n <= 25:
            while self.r <= 78:
                print self.array.index(self.i)
                self.r+=1
                self.i+=1
            self.r=0
            print "\r\n"
            self.check()
            
    def main(self,name):
        desc = os.open(name, os.R_OK)
        #enter 10
        #escape 27
        # 80x25
        data = desc.read()
        self.array=data.split("")
        self.rutina()
        
    def check(self):
        keys = sys.stdin
        key = keys.read()
        if key == "\n":
            self.rutina()
        
        if key == "q":
            sys.exit()
    
        
    
    
