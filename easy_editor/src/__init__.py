"""
@author: Jonny

"""

import os,sys,re,subprocess,editor

class handler:
    desc=None
    dir = 'D:\x5c+PDF+\x5cRFC'
    index = '\rfc-index.txt'
    ids = list()
    help = list()
    dec=list()
    #main - editor
    def main(self,name):
        c = editor.cteni()
        c.main(name)
        while 1==1:
            c.check()
        
    def find(self,name):
        where = os.open(self.dir+self.index, os.R_OK)
        data = where.read()
        splited = data.split("\r\n\r\n")
        for split in splited:
            result = re.match(".*?"+name+"?.*", split, "gi")  
            if result != None:
                dat = result.split("\x20")  
                self.ids.add(dat.index(0))
                self.help.add(result)
        self.search()
        
    def search(self):
        os.chdir(self.dir)
        a=0
        for sid in self.ids:
            print "(%s) %s %s" % (a,help.index(a),sid)
        inp = raw_input()
        if inp != None:
            self.main(self.dir+"\rfc"+self.ids.index(a))
        
print "Zadejte co hledate:\r\n"
inpu = ""
inpu = raw_input()
handle = handler()
handle.find(inpu)
        

