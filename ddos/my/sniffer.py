#!/usr/bin/python
'''
Created on Jan 30, 2012

@author: jonny
'''
import socket


sock = socket.socket(socket.AF_INET,socket.SOCK_RAW,socket.IPPROTO_TCP)
sock.bind(('0.0.0.0',0))


while 1:
	print sock.recvfrom(65565)
