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


import javax.swing.*;




public class run{
	public run() {
		super();
		// TODO Auto-generated constructor stub
	}
	/**
	 * 
	 */

	private static Dimension d = new Dimension(500, 300);
	private static JFrame frame;
	private static Panel main = null;
	private static Panel dbuff = null;
	private static Timer timer = null;
	private static Date glob_time = null;
	private static Date start_time = null;
	private static Date end_time = null;
	private static long diff = 0;

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
		timer = new Timer(1000, redraw());
		timer.start();
		
		
		//2. Optional: What happens when the frame closes?
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.setSize(d);
		
		frame.setVisible(true);
		
		main = new Panel();
		//main.add(new Button("Submit"));
		main.setVisible(true);
		frame.add(main);	
		/*
		try {
			InputStream a = new FileInputStream(new File("/dev/ttyACM0"));
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		*/
	}
	public static ActionListener redraw(){
		draw_time();
		return null;
	}
	

	//Time of column
	public static void add_time(Date start,Date end){
		start_time = start;
		end_time = end;
		diff = (end_time.getTime() - start_time.getTime());
		int minute,second,milis;
		second = (int)diff/1000;
		minute = (int)(diff/1000)/60;
		milis = (int)diff - (second*1000+minute*60*1000);
		
		
		
	}
	
	private static void draw_time(){
		Graphics g = main.getGraphics();
		Date now = new Date();
		main.update(g);
		g.drawString(now.toString(), 10, 10);
		
	}


	
}
