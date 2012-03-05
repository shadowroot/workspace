
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.*;
import java.util.Random;
import java.security.*;

public class server {
	private static ServerSocket s = null;
	private static int port=1234;
	private static Socket connection = null;
	private static ObjectInputStream in=null;
	private static ObjectOutputStream out=null;
	private static String[] tmp;
	private static String[] data;
	private static String last;
	private static String[] requests;
	private static String ssid;
	private static int index;
	
	public String generate_ssid() {
		Random rand = new Random();
		MessageDigest m = MessageDigest.getInstance("MD5");
		m.reset();
		byte[] r = null;
		rand.nextBytes(r = new byte[1024]);
		m.update(r);
		byte[] digest = m.digest();
		String md5 = digest.toString();
		return md5;
		
	}
	
	public int array_search(String wanted,String[] StrArray) {
		int is = -1;
		for (int i = 0; i < StrArray.length; i++) {
			if(StrArray[i] == wanted){
				is = i;
			}
		}
		return is;
	}
	
	public void run(){
		try{
			data = new String[1000];
			 s = new ServerSocket(port,10);
			 connection = s.accept();
			 out = new ObjectOutputStream(connection.getOutputStream());
			 in = new ObjectInputStream(connection.getInputStream());
			 String request = (String)in.readObject();
			 requests = request.split("\r\n");
			 for (int i = 0; i < requests.length; i++) {
				String[] req = requests[i].split(":");
				if(req.length==1){
					last=requests[i];
				}
				else{
					if(req[0] == "Cookie"){
						tmp = req[1].split("=");
						if(tmp[0] == "PHPSESSID"){
							ssid = tmp[1];
						}
						else{
							
						}
					}
				}
			 }
			 
			 
			 data = push(last);
			 String[] obj = last.split("&");
			 for (int i = 0; i < obj.length; i++) {
				
			}
			 
		}
		catch (Exception e) {
				// TODO: handle exception
		}
	}
	public String[] push(String val){
		int i = data.length;
		String[] ptr = new String[data.length+1];
		ptr = data;
		ptr[i] = val;
		return ptr;
	}
	public server() {
		// TODO Auto-generated constructor stub
		super();
	}
	
	public static void main(String[] args) {
		server serv = new server();
		serv.run();
		 
	}
}
