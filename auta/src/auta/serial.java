package auta;

import gnu.io.*;
import java.io.*;
import java.util.Date;



public class serial
{
	public static SerialReader rdr = null;
    public serial()
    {
        super();
    }
    
    void connect ( String portName ) throws Exception
    {
        CommPortIdentifier portIdentifier = CommPortIdentifier.getPortIdentifier(portName);
        if ( portIdentifier.isCurrentlyOwned() )
        {
            System.out.println("Error: Port is currently in use");
            
        }
        else
        {
            CommPort commPort = portIdentifier.open(this.getClass().getName(),2000);
            
            if ( commPort instanceof SerialPort )
            {
                SerialPort serialPort = (SerialPort) commPort;
                serialPort.setSerialPortParams(9600,SerialPort.DATABITS_8,SerialPort.STOPBITS_1,SerialPort.PARITY_NONE);
                
                InputStream in = serialPort.getInputStream();
                //OutputStream out = serialPort.getOutputStream();
                rdr = new SerialReader(in);
                (new Thread(rdr)).start();
                
                //(new Thread(new SerialWriter(out))).start();

            }
           
            
            else
            {
                System.out.println("Error: Only serial ports are handled by this example.");
            }
        } 

    }
    
    /** */
    public static class SerialReader implements Runnable 
    {
        InputStream in;
        Date start=null;
        Date end=null;
        public SerialReader ( InputStream in )
        {
            this.in = in;
        }
        
        public void run ()
        {
            byte[] buffer = new byte[1];
            try
            {
                while ( this.in.read(buffer) > -1 )
                {
                    if(buffer[0] == 0x01 && start == null){
                    	start = new Date();
                    }
                    if(buffer[0] == 0x00 && start != null){
                    	end = new Date();
                    	run.add_time(start,end);
                    	start= null;
                    }
                }
            }
            catch ( IOException e )
            {
                e.printStackTrace();
            }            
        }
    }
}

    /** 
    public static class SerialWriter implements Runnable 
    {
        OutputStream out;
        
        public SerialWriter ( OutputStream out )
        {
            this.out = out;
        }
        
        public void run ()
        {
            try
            {                
                int c = 0;
                while ( ( c = System.in.read()) > -1 )
                {
                    this.out.write(c);
                }                
            }
            catch ( IOException e )
            {
                e.printStackTrace();
            }            
        }
    }
    */
    