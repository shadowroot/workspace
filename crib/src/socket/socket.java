
package socket;
//@Author jonnyATroot

import java.net.*;
import java.util.Date;
import java.io.*;



public class socket{
	
	public static Date time = new Date();
	
	public static void handle() {
		// TODO Auto-generated constructor stub
		
		
		
	}
	public String getTime(){
		
		String now = time.toString();
		return now;
	}
	
	public void main(){
		try{
			
			System.out.println("Server wake up at "+getTime());
			ServerSocket sock = new ServerSocket();
			SocketAddress addr = new InetSocketAddress("0.0.0.0",8889);
			
			sock.bind(addr);
			
			while (true) {
				Socket client = sock.accept();
				Thread threads = new Thread();
				threads.start();
				System.out.println("Thread started");
				InetAddress address = client.getInetAddress();
				int port = client.getPort();
				
				PrintStream stream = new PrintStream(client.getOutputStream());
				stream.println("ADDRESS "+address.getHostAddress()+"\r\nPORT "+port+"\r\n");
				stream.close();
				client.close();
		
				threads.destroy();
				System.out.println("Thread killed");
				
			}
			
		}
		catch (IOException e) {
			// TODO: handle exception
			
		}
	}
}
=======
package socket;
//@Author jonnyATroot

import java.net.*;
import java.util.Date;
import java.io.*;



public class socket{
	
	public static Date time = new Date();
	
	public static void handle() {
		// TODO Auto-generated constructor stub
		
		
		
	}
	public String getTime(){
		
		String now = time.toString();
		return now;
	}
	
	public void main(){
		try{
			
			System.out.println("Server wake up at "+getTime());
			ServerSocket sock = new ServerSocket();
			SocketAddress addr = new InetSocketAddress("0.0.0.0",8889);
			
			sock.bind(addr);
			
			while (true) {
				Socket client = sock.accept();
				Thread threads = new Thread();
				threads.start();
				System.out.println("Thread started");
				InetAddress address = client.getInetAddress();
				int port = client.getPort();
				
				PrintStream stream = new PrintStream(client.getOutputStream());
				stream.println("ADDRESS "+address.getHostAddress()+"\r\nPORT "+port+"\r\n");
				stream.close();
				client.close();
		
				threads.destroy();
				System.out.println("Thread killed");
				
			}
			
		}
		catch (IOException e) {
			// TODO: handle exception
			
		}
	}
}
>>>>>>> ab09edaaba59a3e337c0735bdc0bd0224ad31e90
