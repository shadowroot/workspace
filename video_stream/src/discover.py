'''
Created on 1.11.2011

@author: Jonny
'''
import socket
buff = ""
sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM,socket.SOL_TCP)
sock.bind("0.0.0.0","9998")
sock.listen()
if sock.accept():
    while buff != "\r\r\n\r":
        buff = sock.recv(4)
    