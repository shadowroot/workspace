package socket;

import java.net.InetAddress;


public class table {
	private int i=0;
	private InetAddress[] host;
	private int[] port;
	public void update(InetAddress hos,int por) {
		if(this.check( hos, por)){
			host[i] = hos;
			port[i] = por;
			i++;
		}
		
		
	}
	
	public int getLimit(){
		return i;
	}
	
	
	public InetAddress getHost(int q){
		return host[q];
	}
	
	public int getPort(int q){
		return port[q];
	}
	
	private Boolean check(InetAddress hos,int por){
		Boolean notExist = true;
		for(int u=0;u<=i;u++){
			if(host[u] == hos && port[u] == por){
				notExist = false;
			}
		}
		return notExist;
	}
	
}