import java.io.InputStreamReader;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.*;
import java.util.Random;
import java.security.*;

public class server {
	private static ServerSocket s = null;
	private static int port = 1234;
	private static Socket connection = null;
	private static ObjectInputStream in = null;
	private static ObjectOutputStream out = null;
	private static String[] tmp;
	private static String data;
	private static String last;
	private static String[] requests;
	private static String ssid;
	private static int index;
	private static Connection sqlCon;
	private static Statement stmtQuery;
	private static ResultSet sqlResult;

	public String generate_ssid() {
		String md5 = null;
		try {
			Random rand = new Random();
			MessageDigest m = MessageDigest.getInstance("MD5");
			m.reset();
			byte[] r = null;
			rand.nextBytes(r = new byte[1024]);
			m.update(r);
			byte[] digest = m.digest();
			md5 = digest.toString();

		} catch (Exception e) {
			// TODO: handle exception
		}
		return md5;
	}

	public int array_search(String wanted, String[] StrArray) {
		int is = -1;
		for (int i = 0; i < StrArray.length; i++) {
			if (StrArray[i] == wanted) {
				is = i;
			}
		}
		return is;
	}
	
	public Runnable process(){
		try{
		in = new ObjectInputStream(connection.getInputStream());
		out = new ObjectOutputStream(connection.getOutputStream());
		data = new String();
		String request = (String) in.readObject();
		System.out.println(request);
		requests = request.split("\r\n");
		for (int i = 0; i < requests.length; i++) {
			String[] req = requests[i].split(":");
			if (req.length == 1) {
				last = requests[i];
			} else {
				if (req[0] == "Cookie") {
					tmp = req[1].split("=");
					if (tmp[0] == "PHPSESSID") {
						ssid = tmp[1];
					} else {
						generate_ssid();
					}
				}
			}
		}
		if(ssid != ""){
			
			stmtQuery.executeQuery("select id from ssid where ssid='"+ssid+"'");
			sqlResult = stmtQuery.getResultSet();
			index=(int)sqlResult.getInt("id");
			
		}
		data = push(last);
		String[] obj = last.split("&");
			for (int i = 0; i < obj.length; i++) {

			}
		}
		catch (Exception e) {
			// TODO: handle exception
			return null;
		}
		return null;
	}
	
	public void run() {
		try {
			sqlCon = DriverManager.getConnection("jdbc:mysql://localhost:3306", "root", "jonny555");
			stmtQuery = sqlCon.createStatement();
			stmtQuery.executeQuery("use curve");
			
			s = new ServerSocket(port, 10);
			connection = s.accept();
			if(connection != null){
				new Thread(process()).start();
			}
			
			

		} catch (Exception e) {
			System.out.println(e.toString());
			// TODO: handle exception
		}
	}

	public String[] push(String val) {
		int i = data.length;
		String[] ptr = new String[data.length + 1];
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
