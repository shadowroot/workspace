package auta;



import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Date;


import javax.swing.*;


public class run implements ActionListener {
	private static Dimension d = new Dimension(500, 300);
	private static JFrame frame;
	private static Graphics first;
	private static Timer timer = null;
	
	public static void main(String[] args){
		run runing = new run();
		runing.window();
		
		
		/*
		SwingCapture a = new SwingCapture();
		a.main(args);
		 * 
		 */
	}
	
	public void window(){
		//1. Create the frame.
		JFrame.setDefaultLookAndFeelDecorated(true);
		frame = new JFrame("Stopky");
		timer = new Timer(1000, this);
		timer.start();

		//2. Optional: What happens when the frame closes?
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.setSize(d);
		
		frame.setVisible(true);
		first = frame.getGraphics();
			
	}
	
	public void actionPerformed(ActionEvent e){
		draw_time();
	}
	
	private static void draw_time(){
		Graphics g = first;
		Date now = new Date();
		frame.update(g);
		g.drawString(now.toString(), 100, 100);
		
	}
	

	
}