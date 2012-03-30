package auta;



import java.awt.*;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileDescriptor;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;


import java.util.Date;
import java.util.Timer;
import java.util.TimerTask;

import javax.swing.*;





public class run{
	public run() {
		super();
		// TODO Auto-generated constructor stub
	}
	/**
	 * 
	 */
	private static Date glob_time = null;
	private static Dimension d = new Dimension(500, 300);
	private static JFrame frame;
	private static Panel panelMain = null;
	private static Panel dbuff = null;
	private static Timer timer = null;


	public static void main(String[] args){
		try{
			
			window();
			(new serial()).connect("ttyACM0");
			
			glob_time = new Date();
			//System.out.print(glob_time.getTime()); //1327352096253
	        
		}
		catch (Exception e) {
			// TODO: handle exception
			e.printStackTrace();
		}
		
		/*
		SwingCapture a = new SwingCapture();
		a.main(args);
		 * 
		 */
	}
	
	public static void window(){
		//1. Create the frame.
		JFrame.setDefaultLookAndFeelDecorated(true);
		frame = new JFrame("Stopky");
		timer = new Timer();
		TimerTask MyTask = new MyTask();
		timer.schedule(MyTask, 100);
		
		
		//2. Optional: What happens when the frame closes?
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.setSize(d);
		
		frame.setVisible(true);
		
		panelMain = new Panel();
		//panelMain.add(new Button("Submit"));
		panelMain.setVisible(true);
		
		frame.add(panelMain);	
		/*
		try {
			InputStream a = new FileInputStream(new File("/dev/ttyACM0"));
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		*/
	}
	public static Panel getPanel(){
		return panelMain;
	}

	

	//Time of column



	
}


