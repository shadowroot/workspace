package auta;

import javax.comm.*;

public class serial {
	
	public void main(){
		CommPortIdentifier.addPortName("COM3", CommPortIdentifier.PORT_SERIAL, null);
		
	}
	
}